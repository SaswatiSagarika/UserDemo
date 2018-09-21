<?php 
namespace Symfony\Component\HttpFoundation\Session\Storage
{
use Symfony\Component\HttpFoundation\Session\SessionBagInterface;
interface SessionStorageInterface
{
public function start();
public function isStarted();
public function getId();
public function setId($id);
public function getName();
public function setName($name);
public function regenerate($destroy = false, $lifetime = null);
public function save();
public function clear();
public function getBag($name);
public function registerBag(SessionBagInterface $bag);
public function getMetadataBag();
}
}
namespace Symfony\Component\HttpFoundation\Session\Storage
{
use Symfony\Component\HttpFoundation\Session\SessionBagInterface;
use Symfony\Component\HttpFoundation\Session\Storage\Handler\NativeSessionHandler;
use Symfony\Component\HttpFoundation\Session\Storage\Proxy\AbstractProxy;
use Symfony\Component\HttpFoundation\Session\Storage\Proxy\NativeProxy;
use Symfony\Component\HttpFoundation\Session\Storage\Proxy\SessionHandlerProxy;
class NativeSessionStorage implements SessionStorageInterface
{
protected $bags;
protected $started = false;
protected $closed = false;
protected $saveHandler;
protected $metadataBag;
public function __construct(array $options = array(), $handler = null, MetadataBag $metaBag = null)
{
$options += array('cache_limiter'=>'','use_cookies'=> 1,
);
if (\PHP_VERSION_ID >= 50400) {
session_register_shutdown();
} else {
register_shutdown_function('session_write_close');
}
$this->setMetadataBag($metaBag);
$this->setOptions($options);
$this->setSaveHandler($handler);
}
public function getSaveHandler()
{
return $this->saveHandler;
}
public function start()
{
if ($this->started) {
return true;
}
if (\PHP_VERSION_ID >= 50400 && \PHP_SESSION_ACTIVE === session_status()) {
throw new \RuntimeException('Failed to start the session: already started by PHP.');
}
if (\PHP_VERSION_ID < 50400 && !$this->closed && isset($_SESSION) && session_id()) {
throw new \RuntimeException('Failed to start the session: already started by PHP ($_SESSION is set).');
}
if (ini_get('session.use_cookies') && headers_sent($file, $line)) {
throw new \RuntimeException(sprintf('Failed to start the session because headers have already been sent by "%s" at line %d.', $file, $line));
}
if (!session_start()) {
throw new \RuntimeException('Failed to start the session');
}
$this->loadSession();
if (!$this->saveHandler->isWrapper() && !$this->saveHandler->isSessionHandlerInterface()) {
$this->saveHandler->setActive(true);
}
return true;
}
public function getId()
{
return $this->saveHandler->getId();
}
public function setId($id)
{
$this->saveHandler->setId($id);
}
public function getName()
{
return $this->saveHandler->getName();
}
public function setName($name)
{
$this->saveHandler->setName($name);
}
public function regenerate($destroy = false, $lifetime = null)
{
if (\PHP_VERSION_ID >= 50400 && \PHP_SESSION_ACTIVE !== session_status()) {
return false;
}
if (\PHP_VERSION_ID < 50400 &&''=== session_id()) {
return false;
}
if (headers_sent()) {
return false;
}
if (null !== $lifetime) {
ini_set('session.cookie_lifetime', $lifetime);
}
if ($destroy) {
$this->metadataBag->stampNew();
}
$isRegenerated = session_regenerate_id($destroy);
$this->loadSession();
return $isRegenerated;
}
public function save()
{
session_write_close();
if (!$this->saveHandler->isWrapper() && !$this->saveHandler->isSessionHandlerInterface()) {
$this->saveHandler->setActive(false);
}
$this->closed = true;
$this->started = false;
}
public function clear()
{
foreach ($this->bags as $bag) {
$bag->clear();
}
$_SESSION = array();
$this->loadSession();
}
public function registerBag(SessionBagInterface $bag)
{
if ($this->started) {
throw new \LogicException('Cannot register a bag when the session is already started.');
}
$this->bags[$bag->getName()] = $bag;
}
public function getBag($name)
{
if (!isset($this->bags[$name])) {
throw new \InvalidArgumentException(sprintf('The SessionBagInterface %s is not registered.', $name));
}
if (!$this->started && $this->saveHandler->isActive()) {
$this->loadSession();
} elseif (!$this->started) {
$this->start();
}
return $this->bags[$name];
}
public function setMetadataBag(MetadataBag $metaBag = null)
{
if (null === $metaBag) {
$metaBag = new MetadataBag();
}
$this->metadataBag = $metaBag;
}
public function getMetadataBag()
{
return $this->metadataBag;
}
public function isStarted()
{
return $this->started;
}
public function setOptions(array $options)
{
if (headers_sent() || (\PHP_VERSION_ID >= 50400 && \PHP_SESSION_ACTIVE === session_status())) {
return;
}
$validOptions = array_flip(array('cache_expire','cache_limiter','cookie_domain','cookie_httponly','cookie_lifetime','cookie_path','cookie_secure','entropy_file','entropy_length','gc_divisor','gc_maxlifetime','gc_probability','hash_bits_per_character','hash_function','lazy_write','name','referer_check','serialize_handler','use_strict_mode','use_cookies','use_only_cookies','use_trans_sid','upload_progress.enabled','upload_progress.cleanup','upload_progress.prefix','upload_progress.name','upload_progress.freq','upload_progress.min_freq','url_rewriter.tags','sid_length','sid_bits_per_character','trans_sid_hosts','trans_sid_tags',
));
foreach ($options as $key => $value) {
if (isset($validOptions[$key])) {
ini_set('url_rewriter.tags'!== $key ?'session.'.$key : $key, $value);
}
}
}
public function setSaveHandler($saveHandler = null)
{
if (!$saveHandler instanceof AbstractProxy &&
!$saveHandler instanceof NativeSessionHandler &&
!$saveHandler instanceof \SessionHandlerInterface &&
null !== $saveHandler) {
throw new \InvalidArgumentException('Must be instance of AbstractProxy or NativeSessionHandler; implement \SessionHandlerInterface; or be null.');
}
if (!$saveHandler instanceof AbstractProxy && $saveHandler instanceof \SessionHandlerInterface) {
$saveHandler = new SessionHandlerProxy($saveHandler);
} elseif (!$saveHandler instanceof AbstractProxy) {
$saveHandler = \PHP_VERSION_ID >= 50400 ?
new SessionHandlerProxy(new \SessionHandler()) : new NativeProxy();
}
$this->saveHandler = $saveHandler;
if (headers_sent() || (\PHP_VERSION_ID >= 50400 && \PHP_SESSION_ACTIVE === session_status())) {
return;
}
if ($this->saveHandler instanceof \SessionHandlerInterface) {
if (\PHP_VERSION_ID >= 50400) {
session_set_save_handler($this->saveHandler, false);
} else {
session_set_save_handler(
array($this->saveHandler,'open'),
array($this->saveHandler,'close'),
array($this->saveHandler,'read'),
array($this->saveHandler,'write'),
array($this->saveHandler,'destroy'),
array($this->saveHandler,'gc')
);
}
}
}
protected function loadSession(array &$session = null)
{
if (null === $session) {
$session = &$_SESSION;
}
$bags = array_merge($this->bags, array($this->metadataBag));
foreach ($bags as $bag) {
$key = $bag->getStorageKey();
$session[$key] = isset($session[$key]) ? $session[$key] : array();
$bag->initialize($session[$key]);
}
$this->started = true;
$this->closed = false;
}
}
}
namespace Symfony\Component\HttpFoundation\Session\Storage
{
use Symfony\Component\HttpFoundation\Session\Storage\Handler\NativeSessionHandler;
use Symfony\Component\HttpFoundation\Session\Storage\Proxy\AbstractProxy;
class PhpBridgeSessionStorage extends NativeSessionStorage
{
public function __construct($handler = null, MetadataBag $metaBag = null)
{
$this->setMetadataBag($metaBag);
$this->setSaveHandler($handler);
}
public function start()
{
if ($this->started) {
return true;
}
$this->loadSession();
if (!$this->saveHandler->isWrapper() && !$this->saveHandler->isSessionHandlerInterface()) {
$this->saveHandler->setActive(true);
}
return true;
}
public function clear()
{
foreach ($this->bags as $bag) {
$bag->clear();
}
$this->loadSession();
}
}
}
namespace Symfony\Component\HttpFoundation\Session\Storage\Handler
{
if (\PHP_VERSION_ID >= 50400) {
class NativeSessionHandler extends \SessionHandler
{
}
} else {
class NativeSessionHandler
{
}
}
}
namespace Symfony\Component\HttpFoundation\Session\Storage\Handler
{
class NativeFileSessionHandler extends NativeSessionHandler
{
public function __construct($savePath = null)
{
if (null === $savePath) {
$savePath = ini_get('session.save_path');
}
$baseDir = $savePath;
if ($count = substr_count($savePath,';')) {
if ($count > 2) {
throw new \InvalidArgumentException(sprintf('Invalid argument $savePath \'%s\'', $savePath));
}
$baseDir = ltrim(strrchr($savePath,';'),';');
}
if ($baseDir && !is_dir($baseDir) && !@mkdir($baseDir, 0777, true) && !is_dir($baseDir)) {
throw new \RuntimeException(sprintf('Session Storage was not able to create directory "%s"', $baseDir));
}
ini_set('session.save_path', $savePath);
ini_set('session.save_handler','files');
}
}
}
namespace Symfony\Component\HttpFoundation\Session\Storage\Proxy
{
abstract class AbstractProxy
{
protected $wrapper = false;
protected $active = false;
protected $saveHandlerName;
public function getSaveHandlerName()
{
return $this->saveHandlerName;
}
public function isSessionHandlerInterface()
{
return $this instanceof \SessionHandlerInterface;
}
public function isWrapper()
{
return $this->wrapper;
}
public function isActive()
{
if (\PHP_VERSION_ID >= 50400) {
return $this->active = \PHP_SESSION_ACTIVE === session_status();
}
return $this->active;
}
public function setActive($flag)
{
if (\PHP_VERSION_ID >= 50400) {
throw new \LogicException('This method is disabled in PHP 5.4.0+');
}
$this->active = (bool) $flag;
}
public function getId()
{
return session_id();
}
public function setId($id)
{
if ($this->isActive()) {
throw new \LogicException('Cannot change the ID of an active session');
}
session_id($id);
}
public function getName()
{
return session_name();
}
public function setName($name)
{
if ($this->isActive()) {
throw new \LogicException('Cannot change the name of an active session');
}
session_name($name);
}
}
}
namespace Symfony\Component\HttpFoundation\Session\Storage\Proxy
{
class SessionHandlerProxy extends AbstractProxy implements \SessionHandlerInterface
{
protected $handler;
public function __construct(\SessionHandlerInterface $handler)
{
$this->handler = $handler;
$this->wrapper = ($handler instanceof \SessionHandler);
$this->saveHandlerName = $this->wrapper ? ini_get('session.save_handler') :'user';
}
public function open($savePath, $sessionName)
{
$return = (bool) $this->handler->open($savePath, $sessionName);
if (true === $return) {
$this->active = true;
}
return $return;
}
public function close()
{
$this->active = false;
return (bool) $this->handler->close();
}
public function read($sessionId)
{
return (string) $this->handler->read($sessionId);
}
public function write($sessionId, $data)
{
return (bool) $this->handler->write($sessionId, $data);
}
public function destroy($sessionId)
{
return (bool) $this->handler->destroy($sessionId);
}
public function gc($maxlifetime)
{
return (bool) $this->handler->gc($maxlifetime);
}
}
}
namespace Symfony\Component\HttpFoundation\Session
{
use Symfony\Component\HttpFoundation\Session\Storage\MetadataBag;
interface SessionInterface
{
public function start();
public function getId();
public function setId($id);
public function getName();
public function setName($name);
public function invalidate($lifetime = null);
public function migrate($destroy = false, $lifetime = null);
public function save();
public function has($name);
public function get($name, $default = null);
public function set($name, $value);
public function all();
public function replace(array $attributes);
public function remove($name);
public function clear();
public function isStarted();
public function registerBag(SessionBagInterface $bag);
public function getBag($name);
public function getMetadataBag();
}
}
namespace Symfony\Component\HttpFoundation\Session
{
use Symfony\Component\HttpFoundation\Session\Attribute\AttributeBag;
use Symfony\Component\HttpFoundation\Session\Attribute\AttributeBagInterface;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBag;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;
use Symfony\Component\HttpFoundation\Session\Storage\SessionStorageInterface;
class Session implements SessionInterface, \IteratorAggregate, \Countable
{
protected $storage;
private $flashName;
private $attributeName;
public function __construct(SessionStorageInterface $storage = null, AttributeBagInterface $attributes = null, FlashBagInterface $flashes = null)
{
$this->storage = $storage ?: new NativeSessionStorage();
$attributes = $attributes ?: new AttributeBag();
$this->attributeName = $attributes->getName();
$this->registerBag($attributes);
$flashes = $flashes ?: new FlashBag();
$this->flashName = $flashes->getName();
$this->registerBag($flashes);
}
public function start()
{
return $this->storage->start();
}
public function has($name)
{
return $this->storage->getBag($this->attributeName)->has($name);
}
public function get($name, $default = null)
{
return $this->storage->getBag($this->attributeName)->get($name, $default);
}
public function set($name, $value)
{
$this->storage->getBag($this->attributeName)->set($name, $value);
}
public function all()
{
return $this->storage->getBag($this->attributeName)->all();
}
public function replace(array $attributes)
{
$this->storage->getBag($this->attributeName)->replace($attributes);
}
public function remove($name)
{
return $this->storage->getBag($this->attributeName)->remove($name);
}
public function clear()
{
$this->storage->getBag($this->attributeName)->clear();
}
public function isStarted()
{
return $this->storage->isStarted();
}
public function getIterator()
{
return new \ArrayIterator($this->storage->getBag($this->attributeName)->all());
}
public function count()
{
return \count($this->storage->getBag($this->attributeName)->all());
}
public function invalidate($lifetime = null)
{
$this->storage->clear();
return $this->migrate(true, $lifetime);
}
public function migrate($destroy = false, $lifetime = null)
{
return $this->storage->regenerate($destroy, $lifetime);
}
public function save()
{
$this->storage->save();
}
public function getId()
{
return $this->storage->getId();
}
public function setId($id)
{
$this->storage->setId($id);
}
public function getName()
{
return $this->storage->getName();
}
public function setName($name)
{
$this->storage->setName($name);
}
public function getMetadataBag()
{
return $this->storage->getMetadataBag();
}
public function registerBag(SessionBagInterface $bag)
{
$this->storage->registerBag($bag);
}
public function getBag($name)
{
return $this->storage->getBag($name);
}
public function getFlashBag()
{
return $this->getBag($this->flashName);
}
}
}
namespace Symfony\Bundle\FrameworkBundle\Templating
{
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\SecurityContext;
class GlobalVariables
{
protected $container;
public function __construct(ContainerInterface $container)
{
$this->container = $container;
}
public function getSecurity()
{
@trigger_error('The '.__METHOD__.' method is deprecated since Symfony 2.6 and will be removed in 3.0.', E_USER_DEPRECATED);
if ($this->container->has('security.context')) {
return $this->container->get('security.context');
}
}
public function getUser()
{
if (!$this->container->has('security.token_storage')) {
return;
}
$tokenStorage = $this->container->get('security.token_storage');
if (!$token = $tokenStorage->getToken()) {
return;
}
$user = $token->getUser();
if (!\is_object($user)) {
return;
}
return $user;
}
public function getRequest()
{
if ($this->container->has('request_stack')) {
return $this->container->get('request_stack')->getCurrentRequest();
}
}
public function getSession()
{
if ($request = $this->getRequest()) {
return $request->getSession();
}
}
public function getEnvironment()
{
return $this->container->getParameter('kernel.environment');
}
public function getDebug()
{
return (bool) $this->container->getParameter('kernel.debug');
}
}
}
namespace Symfony\Component\Templating
{
class TemplateNameParser implements TemplateNameParserInterface
{
public function parse($name)
{
if ($name instanceof TemplateReferenceInterface) {
return $name;
}
$engine = null;
if (false !== $pos = strrpos($name,'.')) {
$engine = substr($name, $pos + 1);
}
return new TemplateReference($name, $engine);
}
}
}
namespace Symfony\Bundle\FrameworkBundle\Templating
{
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Templating\TemplateNameParser as BaseTemplateNameParser;
use Symfony\Component\Templating\TemplateReferenceInterface;
class TemplateNameParser extends BaseTemplateNameParser
{
protected $kernel;
protected $cache = array();
public function __construct(KernelInterface $kernel)
{
$this->kernel = $kernel;
}
public function parse($name)
{
if ($name instanceof TemplateReferenceInterface) {
return $name;
} elseif (isset($this->cache[$name])) {
return $this->cache[$name];
}
$name = str_replace(':/',':', preg_replace('#/{2,}#','/', str_replace('\\','/', $name)));
if (false !== strpos($name,'..')) {
throw new \RuntimeException(sprintf('Template name "%s" contains invalid characters.', $name));
}
if (!preg_match('/^(?:([^:]*):([^:]*):)?(.+)\.([^\.]+)\.([^\.]+)$/', $name, $matches) || $this->isAbsolutePath($name) || 0 === strpos($name,'@')) {
return parent::parse($name);
}
$template = new TemplateReference($matches[1], $matches[2], $matches[3], $matches[4], $matches[5]);
if ($template->get('bundle')) {
try {
$this->kernel->getBundle($template->get('bundle'));
} catch (\Exception $e) {
throw new \InvalidArgumentException(sprintf('Template name "%s" is not valid.', $name), 0, $e);
}
}
return $this->cache[$name] = $template;
}
private function isAbsolutePath($file)
{
return (bool) preg_match('#^(?:/|[a-zA-Z]:)#', $file);
}
}
}
namespace Symfony\Component\Routing\Generator
{
interface ConfigurableRequirementsInterface
{
public function setStrictRequirements($enabled);
public function isStrictRequirements();
}
}
namespace Symfony\Component\Routing\Generator
{
use Psr\Log\LoggerInterface;
use Symfony\Component\Routing\Exception\InvalidParameterException;
use Symfony\Component\Routing\Exception\MissingMandatoryParametersException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;
class UrlGenerator implements UrlGeneratorInterface, ConfigurableRequirementsInterface
{
protected $routes;
protected $context;
protected $strictRequirements = true;
protected $logger;
protected $decodedChars = array('%2F'=>'/','%40'=>'@','%3A'=>':','%3B'=>';','%2C'=>',','%3D'=>'=','%2B'=>'+','%21'=>'!','%2A'=>'*','%7C'=>'|',
);
public function __construct(RouteCollection $routes, RequestContext $context, LoggerInterface $logger = null)
{
$this->routes = $routes;
$this->context = $context;
$this->logger = $logger;
}
public function setContext(RequestContext $context)
{
$this->context = $context;
}
public function getContext()
{
return $this->context;
}
public function setStrictRequirements($enabled)
{
$this->strictRequirements = null === $enabled ? null : (bool) $enabled;
}
public function isStrictRequirements()
{
return $this->strictRequirements;
}
public function generate($name, $parameters = array(), $referenceType = self::ABSOLUTE_PATH)
{
if (null === $route = $this->routes->get($name)) {
throw new RouteNotFoundException(sprintf('Unable to generate a URL for the named route "%s" as such route does not exist.', $name));
}
$compiledRoute = $route->compile();
return $this->doGenerate($compiledRoute->getVariables(), $route->getDefaults(), $route->getRequirements(), $compiledRoute->getTokens(), $parameters, $name, $referenceType, $compiledRoute->getHostTokens(), $route->getSchemes());
}
protected function doGenerate($variables, $defaults, $requirements, $tokens, $parameters, $name, $referenceType, $hostTokens, array $requiredSchemes = array())
{
if (\is_bool($referenceType) || \is_string($referenceType)) {
@trigger_error('The hardcoded value you are using for the $referenceType argument of the '.__CLASS__.'::generate method is deprecated since Symfony 2.8 and will not be supported anymore in 3.0. Use the constants defined in the UrlGeneratorInterface instead.', E_USER_DEPRECATED);
if (true === $referenceType) {
$referenceType = self::ABSOLUTE_URL;
} elseif (false === $referenceType) {
$referenceType = self::ABSOLUTE_PATH;
} elseif ('relative'=== $referenceType) {
$referenceType = self::RELATIVE_PATH;
} elseif ('network'=== $referenceType) {
$referenceType = self::NETWORK_PATH;
}
}
$variables = array_flip($variables);
$mergedParams = array_replace($defaults, $this->context->getParameters(), $parameters);
if ($diff = array_diff_key($variables, $mergedParams)) {
throw new MissingMandatoryParametersException(sprintf('Some mandatory parameters are missing ("%s") to generate a URL for route "%s".', implode('", "', array_keys($diff)), $name));
}
$url ='';
$optional = true;
foreach ($tokens as $token) {
if ('variable'=== $token[0]) {
if (!$optional || !array_key_exists($token[3], $defaults) || null !== $mergedParams[$token[3]] && (string) $mergedParams[$token[3]] !== (string) $defaults[$token[3]]) {
if (null !== $this->strictRequirements && !preg_match('#^'.$token[2].'$#', $mergedParams[$token[3]])) {
$message = sprintf('Parameter "%s" for route "%s" must match "%s" ("%s" given) to generate a corresponding URL.', $token[3], $name, $token[2], $mergedParams[$token[3]]);
if ($this->strictRequirements) {
throw new InvalidParameterException($message);
}
if ($this->logger) {
$this->logger->error($message);
}
return;
}
$url = $token[1].$mergedParams[$token[3]].$url;
$optional = false;
}
} else {
$url = $token[1].$url;
$optional = false;
}
}
if (''=== $url) {
$url ='/';
}
$url = strtr(rawurlencode($url), $this->decodedChars);
$url = strtr($url, array('/../'=>'/%2E%2E/','/./'=>'/%2E/'));
if ('/..'=== substr($url, -3)) {
$url = substr($url, 0, -2).'%2E%2E';
} elseif ('/.'=== substr($url, -2)) {
$url = substr($url, 0, -1).'%2E';
}
$schemeAuthority ='';
$host = $this->context->getHost();
$scheme = $this->context->getScheme();
if ($requiredSchemes) {
if (!\in_array($scheme, $requiredSchemes, true)) {
$referenceType = self::ABSOLUTE_URL;
$scheme = current($requiredSchemes);
}
} elseif (isset($requirements['_scheme']) && ($req = strtolower($requirements['_scheme'])) && $scheme !== $req) {
$referenceType = self::ABSOLUTE_URL;
$scheme = $req;
}
if ($hostTokens) {
$routeHost ='';
foreach ($hostTokens as $token) {
if ('variable'=== $token[0]) {
if (null !== $this->strictRequirements && !preg_match('#^'.$token[2].'$#i', $mergedParams[$token[3]])) {
$message = sprintf('Parameter "%s" for route "%s" must match "%s" ("%s" given) to generate a corresponding URL.', $token[3], $name, $token[2], $mergedParams[$token[3]]);
if ($this->strictRequirements) {
throw new InvalidParameterException($message);
}
if ($this->logger) {
$this->logger->error($message);
}
return;
}
$routeHost = $token[1].$mergedParams[$token[3]].$routeHost;
} else {
$routeHost = $token[1].$routeHost;
}
}
if ($routeHost !== $host) {
$host = $routeHost;
if (self::ABSOLUTE_URL !== $referenceType) {
$referenceType = self::NETWORK_PATH;
}
}
}
if ((self::ABSOLUTE_URL === $referenceType || self::NETWORK_PATH === $referenceType) && !empty($host)) {
$port ='';
if ('http'=== $scheme && 80 != $this->context->getHttpPort()) {
$port =':'.$this->context->getHttpPort();
} elseif ('https'=== $scheme && 443 != $this->context->getHttpsPort()) {
$port =':'.$this->context->getHttpsPort();
}
$schemeAuthority = self::NETWORK_PATH === $referenceType ?'//': "$scheme://";
$schemeAuthority .= $host.$port;
}
if (self::RELATIVE_PATH === $referenceType) {
$url = self::getRelativePath($this->context->getPathInfo(), $url);
} else {
$url = $schemeAuthority.$this->context->getBaseUrl().$url;
}
$extra = array_udiff_assoc(array_diff_key($parameters, $variables), $defaults, function ($a, $b) {
return $a == $b ? 0 : 1;
});
if ($extra && $query = http_build_query($extra,'','&')) {
$url .='?'.strtr($query, array('%2F'=>'/'));
}
return $url;
}
public static function getRelativePath($basePath, $targetPath)
{
if ($basePath === $targetPath) {
return'';
}
$sourceDirs = explode('/', isset($basePath[0]) &&'/'=== $basePath[0] ? substr($basePath, 1) : $basePath);
$targetDirs = explode('/', isset($targetPath[0]) &&'/'=== $targetPath[0] ? substr($targetPath, 1) : $targetPath);
array_pop($sourceDirs);
$targetFile = array_pop($targetDirs);
foreach ($sourceDirs as $i => $dir) {
if (isset($targetDirs[$i]) && $dir === $targetDirs[$i]) {
unset($sourceDirs[$i], $targetDirs[$i]);
} else {
break;
}
}
$targetDirs[] = $targetFile;
$path = str_repeat('../', \count($sourceDirs)).implode('/', $targetDirs);
return''=== $path ||'/'=== $path[0]
|| false !== ($colonPos = strpos($path,':')) && ($colonPos < ($slashPos = strpos($path,'/')) || false === $slashPos)
? "./$path" : $path;
}
}
}
namespace Symfony\Component\Routing\Matcher
{
interface RedirectableUrlMatcherInterface
{
public function redirect($path, $route, $scheme = null);
}
}
namespace Symfony\Component\Routing\Matcher
{
use Symfony\Component\ExpressionLanguage\ExpressionFunctionProviderInterface;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;
class UrlMatcher implements UrlMatcherInterface, RequestMatcherInterface
{
const REQUIREMENT_MATCH = 0;
const REQUIREMENT_MISMATCH = 1;
const ROUTE_MATCH = 2;
protected $context;
protected $allow = array();
protected $routes;
protected $request;
protected $expressionLanguage;
protected $expressionLanguageProviders = array();
public function __construct(RouteCollection $routes, RequestContext $context)
{
$this->routes = $routes;
$this->context = $context;
}
public function setContext(RequestContext $context)
{
$this->context = $context;
}
public function getContext()
{
return $this->context;
}
public function match($pathinfo)
{
$this->allow = array();
if ($ret = $this->matchCollection(rawurldecode($pathinfo), $this->routes)) {
return $ret;
}
throw 0 < \count($this->allow)
? new MethodNotAllowedException(array_unique($this->allow))
: new ResourceNotFoundException(sprintf('No routes found for "%s".', $pathinfo));
}
public function matchRequest(Request $request)
{
$this->request = $request;
$ret = $this->match($request->getPathInfo());
$this->request = null;
return $ret;
}
public function addExpressionLanguageProvider(ExpressionFunctionProviderInterface $provider)
{
$this->expressionLanguageProviders[] = $provider;
}
protected function matchCollection($pathinfo, RouteCollection $routes)
{
foreach ($routes as $name => $route) {
$compiledRoute = $route->compile();
if (''!== $compiledRoute->getStaticPrefix() && 0 !== strpos($pathinfo, $compiledRoute->getStaticPrefix())) {
continue;
}
if (!preg_match($compiledRoute->getRegex(), $pathinfo, $matches)) {
continue;
}
$hostMatches = array();
if ($compiledRoute->getHostRegex() && !preg_match($compiledRoute->getHostRegex(), $this->context->getHost(), $hostMatches)) {
continue;
}
$status = $this->handleRouteRequirements($pathinfo, $name, $route);
if (self::REQUIREMENT_MISMATCH === $status[0]) {
continue;
}
if ($requiredMethods = $route->getMethods()) {
if ('HEAD'=== $method = $this->context->getMethod()) {
$method ='GET';
}
if (!\in_array($method, $requiredMethods)) {
if (self::REQUIREMENT_MATCH === $status[0]) {
$this->allow = array_merge($this->allow, $requiredMethods);
}
continue;
}
}
if (self::ROUTE_MATCH === $status[0]) {
return $status[1];
}
return $this->getAttributes($route, $name, array_replace($matches, $hostMatches));
}
}
protected function getAttributes(Route $route, $name, array $attributes)
{
$attributes['_route'] = $name;
return $this->mergeDefaults($attributes, $route->getDefaults());
}
protected function handleRouteRequirements($pathinfo, $name, Route $route)
{
if ($route->getCondition() && !$this->getExpressionLanguage()->evaluate($route->getCondition(), array('context'=> $this->context,'request'=> $this->request ?: $this->createRequest($pathinfo)))) {
return array(self::REQUIREMENT_MISMATCH, null);
}
$scheme = $this->context->getScheme();
$status = $route->getSchemes() && !$route->hasScheme($scheme) ? self::REQUIREMENT_MISMATCH : self::REQUIREMENT_MATCH;
return array($status, null);
}
protected function mergeDefaults($params, $defaults)
{
foreach ($params as $key => $value) {
if (!\is_int($key)) {
$defaults[$key] = $value;
}
}
return $defaults;
}
protected function getExpressionLanguage()
{
if (null === $this->expressionLanguage) {
if (!class_exists('Symfony\Component\ExpressionLanguage\ExpressionLanguage')) {
throw new \RuntimeException('Unable to use expressions as the Symfony ExpressionLanguage component is not installed.');
}
$this->expressionLanguage = new ExpressionLanguage(null, $this->expressionLanguageProviders);
}
return $this->expressionLanguage;
}
protected function createRequest($pathinfo)
{
if (!class_exists('Symfony\Component\HttpFoundation\Request')) {
return null;
}
return Request::create($this->context->getScheme().'://'.$this->context->getHost().$this->context->getBaseUrl().$pathinfo, $this->context->getMethod(), $this->context->getParameters(), array(), array(), array('SCRIPT_FILENAME'=> $this->context->getBaseUrl(),'SCRIPT_NAME'=> $this->context->getBaseUrl(),
));
}
}
}
namespace Symfony\Component\Routing\Matcher
{
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Route;
abstract class RedirectableUrlMatcher extends UrlMatcher implements RedirectableUrlMatcherInterface
{
public function match($pathinfo)
{
try {
$parameters = parent::match($pathinfo);
} catch (ResourceNotFoundException $e) {
if ('/'=== substr($pathinfo, -1) || !\in_array($this->context->getMethod(), array('HEAD','GET'))) {
throw $e;
}
try {
parent::match($pathinfo.'/');
return $this->redirect($pathinfo.'/', null);
} catch (ResourceNotFoundException $e2) {
throw $e;
}
}
return $parameters;
}
protected function handleRouteRequirements($pathinfo, $name, Route $route)
{
if ($route->getCondition() && !$this->getExpressionLanguage()->evaluate($route->getCondition(), array('context'=> $this->context,'request'=> $this->request ?: $this->createRequest($pathinfo)))) {
return array(self::REQUIREMENT_MISMATCH, null);
}
$scheme = $this->context->getScheme();
$schemes = $route->getSchemes();
if ($schemes && !$route->hasScheme($scheme)) {
return array(self::ROUTE_MATCH, $this->redirect($pathinfo, $name, current($schemes)));
}
return array(self::REQUIREMENT_MATCH, null);
}
}
}
namespace Symfony\Bundle\FrameworkBundle\Routing
{
use Symfony\Component\Routing\Matcher\RedirectableUrlMatcher as BaseMatcher;
class RedirectableUrlMatcher extends BaseMatcher
{
public function redirect($path, $route, $scheme = null)
{
return array('_controller'=>'Symfony\\Bundle\\FrameworkBundle\\Controller\\RedirectController::urlRedirectAction','path'=> $path,'permanent'=> true,'scheme'=> $scheme,'httpPort'=> $this->context->getHttpPort(),'httpsPort'=> $this->context->getHttpsPort(),'_route'=> $route,
);
}
}
}
namespace Symfony\Component\HttpKernel\Controller
{
use Symfony\Component\HttpFoundation\Request;
interface ControllerResolverInterface
{
public function getController(Request $request);
public function getArguments(Request $request, $controller);
}
}
namespace Symfony\Component\HttpKernel\Controller
{
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
class ControllerResolver implements ControllerResolverInterface
{
private $logger;
private $supportsVariadic;
private $supportsScalarTypes;
public function __construct(LoggerInterface $logger = null)
{
$this->logger = $logger;
$this->supportsVariadic = method_exists('ReflectionParameter','isVariadic');
$this->supportsScalarTypes = method_exists('ReflectionParameter','getType');
}
public function getController(Request $request)
{
if (!$controller = $request->attributes->get('_controller')) {
if (null !== $this->logger) {
$this->logger->warning('Unable to look for the controller as the "_controller" parameter is missing.');
}
return false;
}
if (\is_array($controller)) {
return $controller;
}
if (\is_object($controller)) {
if (method_exists($controller,'__invoke')) {
return $controller;
}
throw new \InvalidArgumentException(sprintf('Controller "%s" for URI "%s" is not callable.', \get_class($controller), $request->getPathInfo()));
}
if (false === strpos($controller,':')) {
if (method_exists($controller,'__invoke')) {
return $this->instantiateController($controller);
} elseif (\function_exists($controller)) {
return $controller;
}
}
$callable = $this->createController($controller);
if (!\is_callable($callable)) {
throw new \InvalidArgumentException(sprintf('Controller "%s" for URI "%s" is not callable.', $controller, $request->getPathInfo()));
}
return $callable;
}
public function getArguments(Request $request, $controller)
{
if (\is_array($controller)) {
$r = new \ReflectionMethod($controller[0], $controller[1]);
} elseif (\is_object($controller) && !$controller instanceof \Closure) {
$r = new \ReflectionObject($controller);
$r = $r->getMethod('__invoke');
} else {
$r = new \ReflectionFunction($controller);
}
return $this->doGetArguments($request, $controller, $r->getParameters());
}
protected function doGetArguments(Request $request, $controller, array $parameters)
{
$attributes = $request->attributes->all();
$arguments = array();
foreach ($parameters as $param) {
if (array_key_exists($param->name, $attributes)) {
if ($this->supportsVariadic && $param->isVariadic() && \is_array($attributes[$param->name])) {
$arguments = array_merge($arguments, array_values($attributes[$param->name]));
} else {
$arguments[] = $attributes[$param->name];
}
} elseif ($param->getClass() && $param->getClass()->isInstance($request)) {
$arguments[] = $request;
} elseif ($param->isDefaultValueAvailable()) {
$arguments[] = $param->getDefaultValue();
} elseif ($this->supportsScalarTypes && $param->hasType() && $param->allowsNull()) {
$arguments[] = null;
} else {
if (\is_array($controller)) {
$repr = sprintf('%s::%s()', \get_class($controller[0]), $controller[1]);
} elseif (\is_object($controller)) {
$repr = \get_class($controller);
} else {
$repr = $controller;
}
throw new \RuntimeException(sprintf('Controller "%s" requires that you provide a value for the "$%s" argument (because there is no default value or because there is a non optional argument after this one).', $repr, $param->name));
}
}
return $arguments;
}
protected function createController($controller)
{
if (false === strpos($controller,'::')) {
throw new \InvalidArgumentException(sprintf('Unable to find controller "%s".', $controller));
}
list($class, $method) = explode('::', $controller, 2);
if (!class_exists($class)) {
throw new \InvalidArgumentException(sprintf('Class "%s" does not exist.', $class));
}
return array($this->instantiateController($class), $method);
}
protected function instantiateController($class)
{
return new $class();
}
}
}
namespace Symfony\Component\HttpKernel\Event
{
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\HttpKernelInterface;
class KernelEvent extends Event
{
private $kernel;
private $request;
private $requestType;
public function __construct(HttpKernelInterface $kernel, Request $request, $requestType)
{
$this->kernel = $kernel;
$this->request = $request;
$this->requestType = $requestType;
}
public function getKernel()
{
return $this->kernel;
}
public function getRequest()
{
return $this->request;
}
public function getRequestType()
{
return $this->requestType;
}
public function isMasterRequest()
{
return HttpKernelInterface::MASTER_REQUEST === $this->requestType;
}
}
}
namespace Symfony\Component\HttpKernel\Event
{
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\HttpKernelInterface;
class FilterControllerEvent extends KernelEvent
{
private $controller;
public function __construct(HttpKernelInterface $kernel, $controller, Request $request, $requestType)
{
parent::__construct($kernel, $request, $requestType);
$this->setController($controller);
}
public function getController()
{
return $this->controller;
}
public function setController($controller)
{
if (!\is_callable($controller)) {
throw new \LogicException(sprintf('The controller must be a callable (%s given).', $this->varToString($controller)));
}
$this->controller = $controller;
}
private function varToString($var)
{
if (\is_object($var)) {
return sprintf('Object(%s)', \get_class($var));
}
if (\is_array($var)) {
$a = array();
foreach ($var as $k => $v) {
$a[] = sprintf('%s => %s', $k, $this->varToString($v));
}
return sprintf('Array(%s)', implode(', ', $a));
}
if (\is_resource($var)) {
return sprintf('Resource(%s)', get_resource_type($var));
}
if (null === $var) {
return'null';
}
if (false === $var) {
return'false';
}
if (true === $var) {
return'true';
}
return (string) $var;
}
}
}
namespace Symfony\Component\HttpKernel\Event
{
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernelInterface;
class FilterResponseEvent extends KernelEvent
{
private $response;
public function __construct(HttpKernelInterface $kernel, Request $request, $requestType, Response $response)
{
parent::__construct($kernel, $request, $requestType);
$this->setResponse($response);
}
public function getResponse()
{
return $this->response;
}
public function setResponse(Response $response)
{
$this->response = $response;
}
}
}
namespace Symfony\Component\HttpKernel\Event
{
use Symfony\Component\HttpFoundation\Response;
class GetResponseEvent extends KernelEvent
{
private $response;
public function getResponse()
{
return $this->response;
}
public function setResponse(Response $response)
{
$this->response = $response;
$this->stopPropagation();
}
public function hasResponse()
{
return null !== $this->response;
}
}
}
namespace Symfony\Component\HttpKernel\Event
{
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\HttpKernelInterface;
class GetResponseForControllerResultEvent extends GetResponseEvent
{
private $controllerResult;
public function __construct(HttpKernelInterface $kernel, Request $request, $requestType, $controllerResult)
{
parent::__construct($kernel, $request, $requestType);
$this->controllerResult = $controllerResult;
}
public function getControllerResult()
{
return $this->controllerResult;
}
public function setControllerResult($controllerResult)
{
$this->controllerResult = $controllerResult;
}
}
}
namespace Symfony\Component\HttpKernel\Event
{
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\HttpKernelInterface;
class GetResponseForExceptionEvent extends GetResponseEvent
{
private $exception;
public function __construct(HttpKernelInterface $kernel, Request $request, $requestType, \Exception $e)
{
parent::__construct($kernel, $request, $requestType);
$this->setException($e);
}
public function getException()
{
return $this->exception;
}
public function setException(\Exception $exception)
{
$this->exception = $exception;
}
}
}
namespace Symfony\Bundle\FrameworkBundle\Controller
{
use Symfony\Component\HttpKernel\KernelInterface;
class ControllerNameParser
{
protected $kernel;
public function __construct(KernelInterface $kernel)
{
$this->kernel = $kernel;
}
public function parse($controller)
{
$parts = explode(':', $controller);
if (3 !== \count($parts) || \in_array('', $parts, true)) {
throw new \InvalidArgumentException(sprintf('The "%s" controller is not a valid "a:b:c" controller string.', $controller));
}
$originalController = $controller;
list($bundle, $controller, $action) = $parts;
$controller = str_replace('/','\\', $controller);
$bundles = array();
try {
$allBundles = $this->kernel->getBundle($bundle, false);
} catch (\InvalidArgumentException $e) {
$message = sprintf('The "%s" (from the _controller value "%s") does not exist or is not enabled in your kernel!',
$bundle,
$originalController
);
if ($alternative = $this->findAlternative($bundle)) {
$message .= sprintf(' Did you mean "%s:%s:%s"?', $alternative, $controller, $action);
}
throw new \InvalidArgumentException($message, 0, $e);
}
foreach ($allBundles as $b) {
$try = $b->getNamespace().'\\Controller\\'.$controller.'Controller';
if (class_exists($try)) {
return $try.'::'.$action.'Action';
}
$bundles[] = $b->getName();
$msg = sprintf('The _controller value "%s:%s:%s" maps to a "%s" class, but this class was not found. Create this class or check the spelling of the class and its namespace.', $bundle, $controller, $action, $try);
}
if (\count($bundles) > 1) {
$msg = sprintf('Unable to find controller "%s:%s" in bundles %s.', $bundle, $controller, implode(', ', $bundles));
}
throw new \InvalidArgumentException($msg);
}
public function build($controller)
{
if (0 === preg_match('#^(.*?\\\\Controller\\\\(.+)Controller)::(.+)Action$#', $controller, $match)) {
throw new \InvalidArgumentException(sprintf('The "%s" controller is not a valid "class::method" string.', $controller));
}
$className = $match[1];
$controllerName = $match[2];
$actionName = $match[3];
foreach ($this->kernel->getBundles() as $name => $bundle) {
if (0 !== strpos($className, $bundle->getNamespace())) {
continue;
}
return sprintf('%s:%s:%s', $name, $controllerName, $actionName);
}
throw new \InvalidArgumentException(sprintf('Unable to find a bundle that defines controller "%s".', $controller));
}
private function findAlternative($nonExistentBundleName)
{
$bundleNames = array_map(function ($b) {
return $b->getName();
}, $this->kernel->getBundles());
$alternative = null;
$shortest = null;
foreach ($bundleNames as $bundleName) {
if (false !== strpos($bundleName, $nonExistentBundleName)) {
return $bundleName;
}
$lev = levenshtein($nonExistentBundleName, $bundleName);
if ($lev <= \strlen($nonExistentBundleName) / 3 && (null === $alternative || $lev < $shortest)) {
$alternative = $bundleName;
$shortest = $lev;
}
}
return $alternative;
}
}
}
namespace Symfony\Bundle\FrameworkBundle\Controller
{
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Controller\ControllerResolver as BaseControllerResolver;
class ControllerResolver extends BaseControllerResolver
{
protected $container;
protected $parser;
public function __construct(ContainerInterface $container, ControllerNameParser $parser, LoggerInterface $logger = null)
{
$this->container = $container;
$this->parser = $parser;
parent::__construct($logger);
}
protected function createController($controller)
{
if (false === strpos($controller,'::')) {
$count = substr_count($controller,':');
if (2 == $count) {
$controller = $this->parser->parse($controller);
} elseif (1 == $count) {
list($service, $method) = explode(':', $controller, 2);
return array($this->container->get($service), $method);
} elseif ($this->container->has($controller) && method_exists($service = $this->container->get($controller),'__invoke')) {
return $service;
} else {
throw new \LogicException(sprintf('Unable to parse the controller name "%s".', $controller));
}
}
return parent::createController($controller);
}
protected function instantiateController($class)
{
if ($this->container->has($class)) {
return $this->container->get($class);
}
$controller = parent::instantiateController($class);
if ($controller instanceof ContainerAwareInterface) {
$controller->setContainer($this->container);
}
return $controller;
}
}
}
namespace Symfony\Component\Security\Core\User
{
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
interface UserProviderInterface
{
public function loadUserByUsername($username);
public function refreshUser(UserInterface $user);
public function supportsClass($class);
}
}
namespace Symfony\Component\Security\Core\Authentication
{
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
interface AuthenticationManagerInterface
{
public function authenticate(TokenInterface $token);
}
}
namespace Symfony\Component\Security\Core\Authentication
{
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Security\Core\Authentication\Provider\AuthenticationProviderInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\AuthenticationEvents;
use Symfony\Component\Security\Core\Event\AuthenticationEvent;
use Symfony\Component\Security\Core\Event\AuthenticationFailureEvent;
use Symfony\Component\Security\Core\Exception\AccountStatusException;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\ProviderNotFoundException;
class AuthenticationProviderManager implements AuthenticationManagerInterface
{
private $providers;
private $eraseCredentials;
private $eventDispatcher;
public function __construct(array $providers, $eraseCredentials = true)
{
if (!$providers) {
throw new \InvalidArgumentException('You must at least add one authentication provider.');
}
foreach ($providers as $provider) {
if (!$provider instanceof AuthenticationProviderInterface) {
throw new \InvalidArgumentException(sprintf('Provider "%s" must implement the AuthenticationProviderInterface.', \get_class($provider)));
}
}
$this->providers = $providers;
$this->eraseCredentials = (bool) $eraseCredentials;
}
public function setEventDispatcher(EventDispatcherInterface $dispatcher)
{
$this->eventDispatcher = $dispatcher;
}
public function authenticate(TokenInterface $token)
{
$lastException = null;
$result = null;
foreach ($this->providers as $provider) {
if (!$provider->supports($token)) {
continue;
}
try {
$result = $provider->authenticate($token);
if (null !== $result) {
break;
}
} catch (AccountStatusException $e) {
$lastException = $e;
break;
} catch (AuthenticationException $e) {
$lastException = $e;
}
}
if (null !== $result) {
if (true === $this->eraseCredentials) {
$result->eraseCredentials();
}
if (null !== $this->eventDispatcher) {
$this->eventDispatcher->dispatch(AuthenticationEvents::AUTHENTICATION_SUCCESS, new AuthenticationEvent($result));
}
return $result;
}
if (null === $lastException) {
$lastException = new ProviderNotFoundException(sprintf('No Authentication Provider found for token of class "%s".', \get_class($token)));
}
if (null !== $this->eventDispatcher) {
$this->eventDispatcher->dispatch(AuthenticationEvents::AUTHENTICATION_FAILURE, new AuthenticationFailureEvent($token, $lastException));
}
$lastException->setToken($token);
throw $lastException;
}
}
}
namespace Symfony\Component\Security\Core\Authentication\Token\Storage
{
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
class TokenStorage implements TokenStorageInterface
{
private $token;
public function getToken()
{
return $this->token;
}
public function setToken(TokenInterface $token = null)
{
$this->token = $token;
}
}
}
namespace Symfony\Component\Security\Core\Authorization
{
interface AuthorizationCheckerInterface
{
public function isGranted($attributes, $object = null);
}
}
namespace Symfony\Component\Security\Core\Authorization
{
use Symfony\Component\Security\Core\Authentication\AuthenticationManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationCredentialsNotFoundException;
class AuthorizationChecker implements AuthorizationCheckerInterface
{
private $tokenStorage;
private $accessDecisionManager;
private $authenticationManager;
private $alwaysAuthenticate;
public function __construct(TokenStorageInterface $tokenStorage, AuthenticationManagerInterface $authenticationManager, AccessDecisionManagerInterface $accessDecisionManager, $alwaysAuthenticate = false)
{
$this->tokenStorage = $tokenStorage;
$this->authenticationManager = $authenticationManager;
$this->accessDecisionManager = $accessDecisionManager;
$this->alwaysAuthenticate = $alwaysAuthenticate;
}
final public function isGranted($attributes, $object = null)
{
if (null === ($token = $this->tokenStorage->getToken())) {
throw new AuthenticationCredentialsNotFoundException('The token storage contains no authentication token. One possible reason may be that there is no firewall configured for this URL.');
}
if ($this->alwaysAuthenticate || !$token->isAuthenticated()) {
$this->tokenStorage->setToken($token = $this->authenticationManager->authenticate($token));
}
if (!\is_array($attributes)) {
$attributes = array($attributes);
}
return $this->accessDecisionManager->decide($token, $attributes, $object);
}
}
}
namespace Symfony\Component\Security\Core\Authorization\Voter
{
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
interface VoterInterface
{
const ACCESS_GRANTED = 1;
const ACCESS_ABSTAIN = 0;
const ACCESS_DENIED = -1;
public function supportsAttribute($attribute);
public function supportsClass($class);
public function vote(TokenInterface $token, $object, array $attributes);
}
}
namespace Symfony\Component\Security\Http
{
use Symfony\Component\HttpFoundation\Request;
interface FirewallMapInterface
{
public function getListeners(Request $request);
}
}
namespace Symfony\Bundle\SecurityBundle\Security
{
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\FirewallMapInterface;
class FirewallMap implements FirewallMapInterface
{
protected $container;
protected $map;
public function __construct(ContainerInterface $container, array $map)
{
$this->container = $container;
$this->map = $map;
}
public function getListeners(Request $request)
{
foreach ($this->map as $contextId => $requestMatcher) {
if (null === $requestMatcher || $requestMatcher->matches($request)) {
return $this->container->get($contextId)->getContext();
}
}
return array(array(), null, null);
}
}
}
namespace Symfony\Bundle\SecurityBundle\Security
{
use Symfony\Component\Security\Http\Firewall\ExceptionListener;
use Symfony\Component\Security\Http\Firewall\LogoutListener;
class FirewallContext
{
private $listeners;
private $exceptionListener;
private $logoutListener;
public function __construct(array $listeners, ExceptionListener $exceptionListener = null, LogoutListener $logoutListener = null)
{
$this->listeners = $listeners;
$this->exceptionListener = $exceptionListener;
$this->logoutListener = $logoutListener;
}
public function getContext()
{
return array($this->listeners, $this->exceptionListener, $this->logoutListener);
}
}
}
namespace Symfony\Component\HttpFoundation
{
interface RequestMatcherInterface
{
public function matches(Request $request);
}
}
namespace Symfony\Component\HttpFoundation
{
class RequestMatcher implements RequestMatcherInterface
{
private $path;
private $host;
private $methods = array();
private $ips = array();
private $attributes = array();
private $schemes = array();
public function __construct($path = null, $host = null, $methods = null, $ips = null, array $attributes = array(), $schemes = null)
{
$this->matchPath($path);
$this->matchHost($host);
$this->matchMethod($methods);
$this->matchIps($ips);
$this->matchScheme($schemes);
foreach ($attributes as $k => $v) {
$this->matchAttribute($k, $v);
}
}
public function matchScheme($scheme)
{
$this->schemes = null !== $scheme ? array_map('strtolower', (array) $scheme) : array();
}
public function matchHost($regexp)
{
$this->host = $regexp;
}
public function matchPath($regexp)
{
$this->path = $regexp;
}
public function matchIp($ip)
{
$this->matchIps($ip);
}
public function matchIps($ips)
{
$this->ips = null !== $ips ? (array) $ips : array();
}
public function matchMethod($method)
{
$this->methods = null !== $method ? array_map('strtoupper', (array) $method) : array();
}
public function matchAttribute($key, $regexp)
{
$this->attributes[$key] = $regexp;
}
public function matches(Request $request)
{
if ($this->schemes && !\in_array($request->getScheme(), $this->schemes, true)) {
return false;
}
if ($this->methods && !\in_array($request->getMethod(), $this->methods, true)) {
return false;
}
foreach ($this->attributes as $key => $pattern) {
if (!preg_match('{'.$pattern.'}', $request->attributes->get($key))) {
return false;
}
}
if (null !== $this->path && !preg_match('{'.$this->path.'}', rawurldecode($request->getPathInfo()))) {
return false;
}
if (null !== $this->host && !preg_match('{'.$this->host.'}i', $request->getHost())) {
return false;
}
if (IpUtils::checkIp($request->getClientIp(), $this->ips)) {
return true;
}
return 0 === \count($this->ips);
}
}
}
namespace
{
if (!defined('ENT_SUBSTITUTE')) {
define('ENT_SUBSTITUTE', 8);
}
class Twig_Extension_Core extends Twig_Extension
{
protected $dateFormats = array('F j, Y H:i','%d days');
protected $numberFormat = array(0,'.',',');
protected $timezone = null;
protected $escapers = array();
public function setEscaper($strategy, $callable)
{
$this->escapers[$strategy] = $callable;
}
public function getEscapers()
{
return $this->escapers;
}
public function setDateFormat($format = null, $dateIntervalFormat = null)
{
if (null !== $format) {
$this->dateFormats[0] = $format;
}
if (null !== $dateIntervalFormat) {
$this->dateFormats[1] = $dateIntervalFormat;
}
}
public function getDateFormat()
{
return $this->dateFormats;
}
public function setTimezone($timezone)
{
$this->timezone = $timezone instanceof DateTimeZone ? $timezone : new DateTimeZone($timezone);
}
public function getTimezone()
{
if (null === $this->timezone) {
$this->timezone = new DateTimeZone(date_default_timezone_get());
}
return $this->timezone;
}
public function setNumberFormat($decimal, $decimalPoint, $thousandSep)
{
$this->numberFormat = array($decimal, $decimalPoint, $thousandSep);
}
public function getNumberFormat()
{
return $this->numberFormat;
}
public function getTokenParsers()
{
return array(
new Twig_TokenParser_For(),
new Twig_TokenParser_If(),
new Twig_TokenParser_Extends(),
new Twig_TokenParser_Include(),
new Twig_TokenParser_Block(),
new Twig_TokenParser_Use(),
new Twig_TokenParser_Filter(),
new Twig_TokenParser_Macro(),
new Twig_TokenParser_Import(),
new Twig_TokenParser_From(),
new Twig_TokenParser_Set(),
new Twig_TokenParser_Spaceless(),
new Twig_TokenParser_Flush(),
new Twig_TokenParser_Do(),
new Twig_TokenParser_Embed(),
new Twig_TokenParser_With(),
);
}
public function getFilters()
{
$filters = array(
new Twig_SimpleFilter('date','twig_date_format_filter', array('needs_environment'=> true)),
new Twig_SimpleFilter('date_modify','twig_date_modify_filter', array('needs_environment'=> true)),
new Twig_SimpleFilter('format','sprintf'),
new Twig_SimpleFilter('replace','twig_replace_filter'),
new Twig_SimpleFilter('number_format','twig_number_format_filter', array('needs_environment'=> true)),
new Twig_SimpleFilter('abs','abs'),
new Twig_SimpleFilter('round','twig_round'),
new Twig_SimpleFilter('url_encode','twig_urlencode_filter'),
new Twig_SimpleFilter('json_encode','twig_jsonencode_filter'),
new Twig_SimpleFilter('convert_encoding','twig_convert_encoding'),
new Twig_SimpleFilter('title','twig_title_string_filter', array('needs_environment'=> true)),
new Twig_SimpleFilter('capitalize','twig_capitalize_string_filter', array('needs_environment'=> true)),
new Twig_SimpleFilter('upper','strtoupper'),
new Twig_SimpleFilter('lower','strtolower'),
new Twig_SimpleFilter('striptags','strip_tags'),
new Twig_SimpleFilter('trim','twig_trim_filter'),
new Twig_SimpleFilter('nl2br','nl2br', array('pre_escape'=>'html','is_safe'=> array('html'))),
new Twig_SimpleFilter('join','twig_join_filter'),
new Twig_SimpleFilter('split','twig_split_filter', array('needs_environment'=> true)),
new Twig_SimpleFilter('sort','twig_sort_filter'),
new Twig_SimpleFilter('merge','twig_array_merge'),
new Twig_SimpleFilter('batch','twig_array_batch'),
new Twig_SimpleFilter('reverse','twig_reverse_filter', array('needs_environment'=> true)),
new Twig_SimpleFilter('length','twig_length_filter', array('needs_environment'=> true)),
new Twig_SimpleFilter('slice','twig_slice', array('needs_environment'=> true)),
new Twig_SimpleFilter('first','twig_first', array('needs_environment'=> true)),
new Twig_SimpleFilter('last','twig_last', array('needs_environment'=> true)),
new Twig_SimpleFilter('default','_twig_default_filter', array('node_class'=>'Twig_Node_Expression_Filter_Default')),
new Twig_SimpleFilter('keys','twig_get_array_keys_filter'),
new Twig_SimpleFilter('escape','twig_escape_filter', array('needs_environment'=> true,'is_safe_callback'=>'twig_escape_filter_is_safe')),
new Twig_SimpleFilter('e','twig_escape_filter', array('needs_environment'=> true,'is_safe_callback'=>'twig_escape_filter_is_safe')),
);
if (function_exists('mb_get_info')) {
$filters[] = new Twig_SimpleFilter('upper','twig_upper_filter', array('needs_environment'=> true));
$filters[] = new Twig_SimpleFilter('lower','twig_lower_filter', array('needs_environment'=> true));
}
return $filters;
}
public function getFunctions()
{
return array(
new Twig_SimpleFunction('max','max'),
new Twig_SimpleFunction('min','min'),
new Twig_SimpleFunction('range','range'),
new Twig_SimpleFunction('constant','twig_constant'),
new Twig_SimpleFunction('cycle','twig_cycle'),
new Twig_SimpleFunction('random','twig_random', array('needs_environment'=> true)),
new Twig_SimpleFunction('date','twig_date_converter', array('needs_environment'=> true)),
new Twig_SimpleFunction('include','twig_include', array('needs_environment'=> true,'needs_context'=> true,'is_safe'=> array('all'))),
new Twig_SimpleFunction('source','twig_source', array('needs_environment'=> true,'is_safe'=> array('all'))),
);
}
public function getTests()
{
return array(
new Twig_SimpleTest('even', null, array('node_class'=>'Twig_Node_Expression_Test_Even')),
new Twig_SimpleTest('odd', null, array('node_class'=>'Twig_Node_Expression_Test_Odd')),
new Twig_SimpleTest('defined', null, array('node_class'=>'Twig_Node_Expression_Test_Defined')),
new Twig_SimpleTest('sameas', null, array('node_class'=>'Twig_Node_Expression_Test_Sameas','deprecated'=>'1.21','alternative'=>'same as')),
new Twig_SimpleTest('same as', null, array('node_class'=>'Twig_Node_Expression_Test_Sameas')),
new Twig_SimpleTest('none', null, array('node_class'=>'Twig_Node_Expression_Test_Null')),
new Twig_SimpleTest('null', null, array('node_class'=>'Twig_Node_Expression_Test_Null')),
new Twig_SimpleTest('divisibleby', null, array('node_class'=>'Twig_Node_Expression_Test_Divisibleby','deprecated'=>'1.21','alternative'=>'divisible by')),
new Twig_SimpleTest('divisible by', null, array('node_class'=>'Twig_Node_Expression_Test_Divisibleby')),
new Twig_SimpleTest('constant', null, array('node_class'=>'Twig_Node_Expression_Test_Constant')),
new Twig_SimpleTest('empty','twig_test_empty'),
new Twig_SimpleTest('iterable','twig_test_iterable'),
);
}
public function getOperators()
{
return array(
array('not'=> array('precedence'=> 50,'class'=>'Twig_Node_Expression_Unary_Not'),'-'=> array('precedence'=> 500,'class'=>'Twig_Node_Expression_Unary_Neg'),'+'=> array('precedence'=> 500,'class'=>'Twig_Node_Expression_Unary_Pos'),
),
array('or'=> array('precedence'=> 10,'class'=>'Twig_Node_Expression_Binary_Or','associativity'=> Twig_ExpressionParser::OPERATOR_LEFT),'and'=> array('precedence'=> 15,'class'=>'Twig_Node_Expression_Binary_And','associativity'=> Twig_ExpressionParser::OPERATOR_LEFT),'b-or'=> array('precedence'=> 16,'class'=>'Twig_Node_Expression_Binary_BitwiseOr','associativity'=> Twig_ExpressionParser::OPERATOR_LEFT),'b-xor'=> array('precedence'=> 17,'class'=>'Twig_Node_Expression_Binary_BitwiseXor','associativity'=> Twig_ExpressionParser::OPERATOR_LEFT),'b-and'=> array('precedence'=> 18,'class'=>'Twig_Node_Expression_Binary_BitwiseAnd','associativity'=> Twig_ExpressionParser::OPERATOR_LEFT),'=='=> array('precedence'=> 20,'class'=>'Twig_Node_Expression_Binary_Equal','associativity'=> Twig_ExpressionParser::OPERATOR_LEFT),'!='=> array('precedence'=> 20,'class'=>'Twig_Node_Expression_Binary_NotEqual','associativity'=> Twig_ExpressionParser::OPERATOR_LEFT),'<'=> array('precedence'=> 20,'class'=>'Twig_Node_Expression_Binary_Less','associativity'=> Twig_ExpressionParser::OPERATOR_LEFT),'>'=> array('precedence'=> 20,'class'=>'Twig_Node_Expression_Binary_Greater','associativity'=> Twig_ExpressionParser::OPERATOR_LEFT),'>='=> array('precedence'=> 20,'class'=>'Twig_Node_Expression_Binary_GreaterEqual','associativity'=> Twig_ExpressionParser::OPERATOR_LEFT),'<='=> array('precedence'=> 20,'class'=>'Twig_Node_Expression_Binary_LessEqual','associativity'=> Twig_ExpressionParser::OPERATOR_LEFT),'not in'=> array('precedence'=> 20,'class'=>'Twig_Node_Expression_Binary_NotIn','associativity'=> Twig_ExpressionParser::OPERATOR_LEFT),'in'=> array('precedence'=> 20,'class'=>'Twig_Node_Expression_Binary_In','associativity'=> Twig_ExpressionParser::OPERATOR_LEFT),'matches'=> array('precedence'=> 20,'class'=>'Twig_Node_Expression_Binary_Matches','associativity'=> Twig_ExpressionParser::OPERATOR_LEFT),'starts with'=> array('precedence'=> 20,'class'=>'Twig_Node_Expression_Binary_StartsWith','associativity'=> Twig_ExpressionParser::OPERATOR_LEFT),'ends with'=> array('precedence'=> 20,'class'=>'Twig_Node_Expression_Binary_EndsWith','associativity'=> Twig_ExpressionParser::OPERATOR_LEFT),'..'=> array('precedence'=> 25,'class'=>'Twig_Node_Expression_Binary_Range','associativity'=> Twig_ExpressionParser::OPERATOR_LEFT),'+'=> array('precedence'=> 30,'class'=>'Twig_Node_Expression_Binary_Add','associativity'=> Twig_ExpressionParser::OPERATOR_LEFT),'-'=> array('precedence'=> 30,'class'=>'Twig_Node_Expression_Binary_Sub','associativity'=> Twig_ExpressionParser::OPERATOR_LEFT),'~'=> array('precedence'=> 40,'class'=>'Twig_Node_Expression_Binary_Concat','associativity'=> Twig_ExpressionParser::OPERATOR_LEFT),'*'=> array('precedence'=> 60,'class'=>'Twig_Node_Expression_Binary_Mul','associativity'=> Twig_ExpressionParser::OPERATOR_LEFT),'/'=> array('precedence'=> 60,'class'=>'Twig_Node_Expression_Binary_Div','associativity'=> Twig_ExpressionParser::OPERATOR_LEFT),'//'=> array('precedence'=> 60,'class'=>'Twig_Node_Expression_Binary_FloorDiv','associativity'=> Twig_ExpressionParser::OPERATOR_LEFT),'%'=> array('precedence'=> 60,'class'=>'Twig_Node_Expression_Binary_Mod','associativity'=> Twig_ExpressionParser::OPERATOR_LEFT),'is'=> array('precedence'=> 100,'associativity'=> Twig_ExpressionParser::OPERATOR_LEFT),'is not'=> array('precedence'=> 100,'associativity'=> Twig_ExpressionParser::OPERATOR_LEFT),'**'=> array('precedence'=> 200,'class'=>'Twig_Node_Expression_Binary_Power','associativity'=> Twig_ExpressionParser::OPERATOR_RIGHT),'??'=> array('precedence'=> 300,'class'=>'Twig_Node_Expression_NullCoalesce','associativity'=> Twig_ExpressionParser::OPERATOR_RIGHT),
),
);
}
public function getName()
{
return'core';
}
}
function twig_cycle($values, $position)
{
if (!is_array($values) && !$values instanceof ArrayAccess) {
return $values;
}
return $values[$position % count($values)];
}
function twig_random(Twig_Environment $env, $values = null)
{
if (null === $values) {
return mt_rand();
}
if (is_int($values) || is_float($values)) {
return $values < 0 ? mt_rand($values, 0) : mt_rand(0, $values);
}
if ($values instanceof Traversable) {
$values = iterator_to_array($values);
} elseif (is_string($values)) {
if (''=== $values) {
return'';
}
if (null !== $charset = $env->getCharset()) {
if ('UTF-8'!== $charset) {
$values = twig_convert_encoding($values,'UTF-8', $charset);
}
$values = preg_split('/(?<!^)(?!$)/u', $values);
if ('UTF-8'!== $charset) {
foreach ($values as $i => $value) {
$values[$i] = twig_convert_encoding($value, $charset,'UTF-8');
}
}
} else {
return $values[mt_rand(0, strlen($values) - 1)];
}
}
if (!is_array($values)) {
return $values;
}
if (0 === count($values)) {
throw new Twig_Error_Runtime('The random function cannot pick from an empty array.');
}
return $values[array_rand($values, 1)];
}
function twig_date_format_filter(Twig_Environment $env, $date, $format = null, $timezone = null)
{
if (null === $format) {
$formats = $env->getExtension('Twig_Extension_Core')->getDateFormat();
$format = $date instanceof DateInterval ? $formats[1] : $formats[0];
}
if ($date instanceof DateInterval) {
return $date->format($format);
}
return twig_date_converter($env, $date, $timezone)->format($format);
}
function twig_date_modify_filter(Twig_Environment $env, $date, $modifier)
{
$date = twig_date_converter($env, $date, false);
$resultDate = $date->modify($modifier);
return null === $resultDate ? $date : $resultDate;
}
function twig_date_converter(Twig_Environment $env, $date = null, $timezone = null)
{
if (false !== $timezone) {
if (null === $timezone) {
$timezone = $env->getExtension('Twig_Extension_Core')->getTimezone();
} elseif (!$timezone instanceof DateTimeZone) {
$timezone = new DateTimeZone($timezone);
}
}
if ($date instanceof DateTimeImmutable) {
return false !== $timezone ? $date->setTimezone($timezone) : $date;
}
if ($date instanceof DateTime || $date instanceof DateTimeInterface) {
$date = clone $date;
if (false !== $timezone) {
$date->setTimezone($timezone);
}
return $date;
}
if (null === $date ||'now'=== $date) {
return new DateTime($date, false !== $timezone ? $timezone : $env->getExtension('Twig_Extension_Core')->getTimezone());
}
$asString = (string) $date;
if (ctype_digit($asString) || (!empty($asString) &&'-'=== $asString[0] && ctype_digit(substr($asString, 1)))) {
$date = new DateTime('@'.$date);
} else {
$date = new DateTime($date, $env->getExtension('Twig_Extension_Core')->getTimezone());
}
if (false !== $timezone) {
$date->setTimezone($timezone);
}
return $date;
}
function twig_replace_filter($str, $from, $to = null)
{
if ($from instanceof Traversable) {
$from = iterator_to_array($from);
} elseif (is_string($from) && is_string($to)) {
@trigger_error('Using "replace" with character by character replacement is deprecated since version 1.22 and will be removed in Twig 2.0', E_USER_DEPRECATED);
return strtr($str, $from, $to);
} elseif (!is_array($from)) {
throw new Twig_Error_Runtime(sprintf('The "replace" filter expects an array or "Traversable" as replace values, got "%s".', is_object($from) ? get_class($from) : gettype($from)));
}
return strtr($str, $from);
}
function twig_round($value, $precision = 0, $method ='common')
{
if ('common'== $method) {
return round($value, $precision);
}
if ('ceil'!= $method &&'floor'!= $method) {
throw new Twig_Error_Runtime('The round filter only supports the "common", "ceil", and "floor" methods.');
}
return $method($value * pow(10, $precision)) / pow(10, $precision);
}
function twig_number_format_filter(Twig_Environment $env, $number, $decimal = null, $decimalPoint = null, $thousandSep = null)
{
$defaults = $env->getExtension('Twig_Extension_Core')->getNumberFormat();
if (null === $decimal) {
$decimal = $defaults[0];
}
if (null === $decimalPoint) {
$decimalPoint = $defaults[1];
}
if (null === $thousandSep) {
$thousandSep = $defaults[2];
}
return number_format((float) $number, $decimal, $decimalPoint, $thousandSep);
}
function twig_urlencode_filter($url)
{
if (is_array($url)) {
if (defined('PHP_QUERY_RFC3986')) {
return http_build_query($url,'','&', PHP_QUERY_RFC3986);
}
return http_build_query($url,'','&');
}
return rawurlencode($url);
}
if (PHP_VERSION_ID < 50300) {
function twig_jsonencode_filter($value, $options = 0)
{
if ($value instanceof Twig_Markup) {
$value = (string) $value;
} elseif (is_array($value)) {
array_walk_recursive($value,'_twig_markup2string');
}
return json_encode($value);
}
} else {
function twig_jsonencode_filter($value, $options = 0)
{
if ($value instanceof Twig_Markup) {
$value = (string) $value;
} elseif (is_array($value)) {
array_walk_recursive($value,'_twig_markup2string');
}
return json_encode($value, $options);
}
}
function _twig_markup2string(&$value)
{
if ($value instanceof Twig_Markup) {
$value = (string) $value;
}
}
function twig_array_merge($arr1, $arr2)
{
if ($arr1 instanceof Traversable) {
$arr1 = iterator_to_array($arr1);
} elseif (!is_array($arr1)) {
throw new Twig_Error_Runtime(sprintf('The merge filter only works with arrays or "Traversable", got "%s" as first argument.', gettype($arr1)));
}
if ($arr2 instanceof Traversable) {
$arr2 = iterator_to_array($arr2);
} elseif (!is_array($arr2)) {
throw new Twig_Error_Runtime(sprintf('The merge filter only works with arrays or "Traversable", got "%s" as second argument.', gettype($arr2)));
}
return array_merge($arr1, $arr2);
}
function twig_slice(Twig_Environment $env, $item, $start, $length = null, $preserveKeys = false)
{
if ($item instanceof Traversable) {
while ($item instanceof IteratorAggregate) {
$item = $item->getIterator();
}
if ($start >= 0 && $length >= 0 && $item instanceof Iterator) {
try {
return iterator_to_array(new LimitIterator($item, $start, null === $length ? -1 : $length), $preserveKeys);
} catch (OutOfBoundsException $exception) {
return array();
}
}
$item = iterator_to_array($item, $preserveKeys);
}
if (is_array($item)) {
return array_slice($item, $start, $length, $preserveKeys);
}
$item = (string) $item;
if (function_exists('mb_get_info') && null !== $charset = $env->getCharset()) {
return (string) mb_substr($item, $start, null === $length ? mb_strlen($item, $charset) - $start : $length, $charset);
}
return (string) (null === $length ? substr($item, $start) : substr($item, $start, $length));
}
function twig_first(Twig_Environment $env, $item)
{
$elements = twig_slice($env, $item, 0, 1, false);
return is_string($elements) ? $elements : current($elements);
}
function twig_last(Twig_Environment $env, $item)
{
$elements = twig_slice($env, $item, -1, 1, false);
return is_string($elements) ? $elements : current($elements);
}
function twig_join_filter($value, $glue ='')
{
if ($value instanceof Traversable) {
$value = iterator_to_array($value, false);
}
return implode($glue, (array) $value);
}
function twig_split_filter(Twig_Environment $env, $value, $delimiter, $limit = null)
{
if (!empty($delimiter)) {
return null === $limit ? explode($delimiter, $value) : explode($delimiter, $value, $limit);
}
if (!function_exists('mb_get_info') || null === $charset = $env->getCharset()) {
return str_split($value, null === $limit ? 1 : $limit);
}
if ($limit <= 1) {
return preg_split('/(?<!^)(?!$)/u', $value);
}
$length = mb_strlen($value, $charset);
if ($length < $limit) {
return array($value);
}
$r = array();
for ($i = 0; $i < $length; $i += $limit) {
$r[] = mb_substr($value, $i, $limit, $charset);
}
return $r;
}
function _twig_default_filter($value, $default ='')
{
if (twig_test_empty($value)) {
return $default;
}
return $value;
}
function twig_get_array_keys_filter($array)
{
if ($array instanceof Traversable) {
while ($array instanceof IteratorAggregate) {
$array = $array->getIterator();
}
if ($array instanceof Iterator) {
$keys = array();
$array->rewind();
while ($array->valid()) {
$keys[] = $array->key();
$array->next();
}
return $keys;
}
$keys = array();
foreach ($array as $key => $item) {
$keys[] = $key;
}
return $keys;
}
if (!is_array($array)) {
return array();
}
return array_keys($array);
}
function twig_reverse_filter(Twig_Environment $env, $item, $preserveKeys = false)
{
if ($item instanceof Traversable) {
return array_reverse(iterator_to_array($item), $preserveKeys);
}
if (is_array($item)) {
return array_reverse($item, $preserveKeys);
}
if (null !== $charset = $env->getCharset()) {
$string = (string) $item;
if ('UTF-8'!== $charset) {
$item = twig_convert_encoding($string,'UTF-8', $charset);
}
preg_match_all('/./us', $item, $matches);
$string = implode('', array_reverse($matches[0]));
if ('UTF-8'!== $charset) {
$string = twig_convert_encoding($string, $charset,'UTF-8');
}
return $string;
}
return strrev((string) $item);
}
function twig_sort_filter($array)
{
if ($array instanceof Traversable) {
$array = iterator_to_array($array);
} elseif (!is_array($array)) {
throw new Twig_Error_Runtime(sprintf('The sort filter only works with arrays or "Traversable", got "%s".', gettype($array)));
}
asort($array);
return $array;
}
function twig_in_filter($value, $compare)
{
if (is_array($compare)) {
return in_array($value, $compare, is_object($value) || is_resource($value));
} elseif (is_string($compare) && (is_string($value) || is_int($value) || is_float($value))) {
return''=== $value || false !== strpos($compare, (string) $value);
} elseif ($compare instanceof Traversable) {
if (is_object($value) || is_resource($value)) {
foreach ($compare as $item) {
if ($item === $value) {
return true;
}
}
} else {
foreach ($compare as $item) {
if ($item == $value) {
return true;
}
}
}
return false;
}
return false;
}
function twig_trim_filter($string, $characterMask = null, $side ='both')
{
if (null === $characterMask) {
$characterMask =" \t\n\r\0\x0B";
}
switch ($side) {
case'both':
return trim($string, $characterMask);
case'left':
return ltrim($string, $characterMask);
case'right':
return rtrim($string, $characterMask);
default:
throw new Twig_Error_Runtime('Trimming side must be "left", "right" or "both".');
}
}
function twig_escape_filter(Twig_Environment $env, $string, $strategy ='html', $charset = null, $autoescape = false)
{
if ($autoescape && $string instanceof Twig_Markup) {
return $string;
}
if (!is_string($string)) {
if (is_object($string) && method_exists($string,'__toString')) {
$string = (string) $string;
} elseif (in_array($strategy, array('html','js','css','html_attr','url'))) {
return $string;
}
}
if (null === $charset) {
$charset = $env->getCharset();
}
switch ($strategy) {
case'html':
static $htmlspecialcharsCharsets = array('ISO-8859-1'=> true,'ISO8859-1'=> true,'ISO-8859-15'=> true,'ISO8859-15'=> true,'utf-8'=> true,'UTF-8'=> true,'CP866'=> true,'IBM866'=> true,'866'=> true,'CP1251'=> true,'WINDOWS-1251'=> true,'WIN-1251'=> true,'1251'=> true,'CP1252'=> true,'WINDOWS-1252'=> true,'1252'=> true,'KOI8-R'=> true,'KOI8-RU'=> true,'KOI8R'=> true,'BIG5'=> true,'950'=> true,'GB2312'=> true,'936'=> true,'BIG5-HKSCS'=> true,'SHIFT_JIS'=> true,'SJIS'=> true,'932'=> true,'EUC-JP'=> true,'EUCJP'=> true,'ISO8859-5'=> true,'ISO-8859-5'=> true,'MACROMAN'=> true,
);
if (isset($htmlspecialcharsCharsets[$charset])) {
return htmlspecialchars($string, ENT_QUOTES | ENT_SUBSTITUTE, $charset);
}
if (isset($htmlspecialcharsCharsets[strtoupper($charset)])) {
$htmlspecialcharsCharsets[$charset] = true;
return htmlspecialchars($string, ENT_QUOTES | ENT_SUBSTITUTE, $charset);
}
$string = twig_convert_encoding($string,'UTF-8', $charset);
$string = htmlspecialchars($string, ENT_QUOTES | ENT_SUBSTITUTE,'UTF-8');
return twig_convert_encoding($string, $charset,'UTF-8');
case'js':
if ('UTF-8'!== $charset) {
$string = twig_convert_encoding($string,'UTF-8', $charset);
}
if (0 == strlen($string) ? false : 1 !== preg_match('/^./su', $string)) {
throw new Twig_Error_Runtime('The string to escape is not a valid UTF-8 string.');
}
$string = preg_replace_callback('#[^a-zA-Z0-9,\._]#Su','_twig_escape_js_callback', $string);
if ('UTF-8'!== $charset) {
$string = twig_convert_encoding($string, $charset,'UTF-8');
}
return $string;
case'css':
if ('UTF-8'!== $charset) {
$string = twig_convert_encoding($string,'UTF-8', $charset);
}
if (0 == strlen($string) ? false : 1 !== preg_match('/^./su', $string)) {
throw new Twig_Error_Runtime('The string to escape is not a valid UTF-8 string.');
}
$string = preg_replace_callback('#[^a-zA-Z0-9]#Su','_twig_escape_css_callback', $string);
if ('UTF-8'!== $charset) {
$string = twig_convert_encoding($string, $charset,'UTF-8');
}
return $string;
case'html_attr':
if ('UTF-8'!== $charset) {
$string = twig_convert_encoding($string,'UTF-8', $charset);
}
if (0 == strlen($string) ? false : 1 !== preg_match('/^./su', $string)) {
throw new Twig_Error_Runtime('The string to escape is not a valid UTF-8 string.');
}
$string = preg_replace_callback('#[^a-zA-Z0-9,\.\-_]#Su','_twig_escape_html_attr_callback', $string);
if ('UTF-8'!== $charset) {
$string = twig_convert_encoding($string, $charset,'UTF-8');
}
return $string;
case'url':
if (PHP_VERSION_ID < 50300) {
return str_replace('%7E','~', rawurlencode($string));
}
return rawurlencode($string);
default:
static $escapers;
if (null === $escapers) {
$escapers = $env->getExtension('Twig_Extension_Core')->getEscapers();
}
if (isset($escapers[$strategy])) {
return call_user_func($escapers[$strategy], $env, $string, $charset);
}
$validStrategies = implode(', ', array_merge(array('html','js','url','css','html_attr'), array_keys($escapers)));
throw new Twig_Error_Runtime(sprintf('Invalid escaping strategy "%s" (valid ones: %s).', $strategy, $validStrategies));
}
}
function twig_escape_filter_is_safe(Twig_Node $filterArgs)
{
foreach ($filterArgs as $arg) {
if ($arg instanceof Twig_Node_Expression_Constant) {
return array($arg->getAttribute('value'));
}
return array();
}
return array('html');
}
if (function_exists('mb_convert_encoding')) {
function twig_convert_encoding($string, $to, $from)
{
return mb_convert_encoding($string, $to, $from);
}
} elseif (function_exists('iconv')) {
function twig_convert_encoding($string, $to, $from)
{
return iconv($from, $to, $string);
}
} else {
function twig_convert_encoding($string, $to, $from)
{
throw new Twig_Error_Runtime('No suitable convert encoding function (use UTF-8 as your encoding or install the iconv or mbstring extension).');
}
}
function _twig_escape_js_callback($matches)
{
$char = $matches[0];
static $shortMap = array('\\'=>'\\\\','/'=>'\\/',"\x08"=>'\b',"\x0C"=>'\f',"\x0A"=>'\n',"\x0D"=>'\r',"\x09"=>'\t',
);
if (isset($shortMap[$char])) {
return $shortMap[$char];
}
$char = twig_convert_encoding($char,'UTF-16BE','UTF-8');
$char = strtoupper(bin2hex($char));
if (4 >= strlen($char)) {
return sprintf('\u%04s', $char);
}
return sprintf('\u%04s\u%04s', substr($char, 0, -4), substr($char, -4));
}
function _twig_escape_css_callback($matches)
{
$char = $matches[0];
if (!isset($char[1])) {
$hex = ltrim(strtoupper(bin2hex($char)),'0');
if (0 === strlen($hex)) {
$hex ='0';
}
return'\\'.$hex.' ';
}
$char = twig_convert_encoding($char,'UTF-16BE','UTF-8');
return'\\'.ltrim(strtoupper(bin2hex($char)),'0').' ';
}
function _twig_escape_html_attr_callback($matches)
{
static $entityMap = array(
34 =>'quot',
38 =>'amp',
60 =>'lt',
62 =>'gt',
);
$chr = $matches[0];
$ord = ord($chr);
if (($ord <= 0x1f &&"\t"!= $chr &&"\n"!= $chr &&"\r"!= $chr) || ($ord >= 0x7f && $ord <= 0x9f)) {
return'&#xFFFD;';
}
if (1 == strlen($chr)) {
$hex = strtoupper(substr('00'.bin2hex($chr), -2));
} else {
$chr = twig_convert_encoding($chr,'UTF-16BE','UTF-8');
$hex = strtoupper(substr('0000'.bin2hex($chr), -4));
}
$int = hexdec($hex);
if (array_key_exists($int, $entityMap)) {
return sprintf('&%s;', $entityMap[$int]);
}
return sprintf('&#x%s;', $hex);
}
if (function_exists('mb_get_info')) {
function twig_length_filter(Twig_Environment $env, $thing)
{
if (null === $thing) {
return 0;
}
if (is_scalar($thing)) {
return mb_strlen($thing, $env->getCharset());
}
if ($thing instanceof \SimpleXMLElement) {
return count($thing);
}
if (is_object($thing) && method_exists($thing,'__toString') && !$thing instanceof \Countable) {
return mb_strlen((string) $thing, $env->getCharset());
}
if ($thing instanceof \Countable || is_array($thing)) {
return count($thing);
}
if ($thing instanceof \IteratorAggregate) {
return iterator_count($thing);
}
return 1;
}
function twig_upper_filter(Twig_Environment $env, $string)
{
if (null !== $charset = $env->getCharset()) {
return mb_strtoupper($string, $charset);
}
return strtoupper($string);
}
function twig_lower_filter(Twig_Environment $env, $string)
{
if (null !== $charset = $env->getCharset()) {
return mb_strtolower($string, $charset);
}
return strtolower($string);
}
function twig_title_string_filter(Twig_Environment $env, $string)
{
if (null !== $charset = $env->getCharset()) {
return mb_convert_case($string, MB_CASE_TITLE, $charset);
}
return ucwords(strtolower($string));
}
function twig_capitalize_string_filter(Twig_Environment $env, $string)
{
if (null !== $charset = $env->getCharset()) {
return mb_strtoupper(mb_substr($string, 0, 1, $charset), $charset).mb_strtolower(mb_substr($string, 1, mb_strlen($string, $charset), $charset), $charset);
}
return ucfirst(strtolower($string));
}
}
else {
function twig_length_filter(Twig_Environment $env, $thing)
{
if (null === $thing) {
return 0;
}
if (is_scalar($thing)) {
return strlen($thing);
}
if ($thing instanceof \SimpleXMLElement) {
return count($thing);
}
if (is_object($thing) && method_exists($thing,'__toString') && !$thing instanceof \Countable) {
return strlen((string) $thing);
}
if ($thing instanceof \Countable || is_array($thing)) {
return count($thing);
}
if ($thing instanceof \IteratorAggregate) {
return iterator_count($thing);
}
return 1;
}
function twig_title_string_filter(Twig_Environment $env, $string)
{
return ucwords(strtolower($string));
}
function twig_capitalize_string_filter(Twig_Environment $env, $string)
{
return ucfirst(strtolower($string));
}
}
function twig_ensure_traversable($seq)
{
if ($seq instanceof Traversable || is_array($seq)) {
return $seq;
}
return array();
}
function twig_test_empty($value)
{
if ($value instanceof Countable) {
return 0 == count($value);
}
if (is_object($value) && method_exists($value,'__toString')) {
return''=== (string) $value;
}
return''=== $value || false === $value || null === $value || array() === $value;
}
function twig_test_iterable($value)
{
return $value instanceof Traversable || is_array($value);
}
function twig_include(Twig_Environment $env, $context, $template, $variables = array(), $withContext = true, $ignoreMissing = false, $sandboxed = false)
{
$alreadySandboxed = false;
$sandbox = null;
if ($withContext) {
$variables = array_merge($context, $variables);
}
if ($isSandboxed = $sandboxed && $env->hasExtension('Twig_Extension_Sandbox')) {
$sandbox = $env->getExtension('Twig_Extension_Sandbox');
if (!$alreadySandboxed = $sandbox->isSandboxed()) {
$sandbox->enableSandbox();
}
}
$result = null;
try {
$result = $env->resolveTemplate($template)->render($variables);
} catch (Twig_Error_Loader $e) {
if (!$ignoreMissing) {
if ($isSandboxed && !$alreadySandboxed) {
$sandbox->disableSandbox();
}
throw $e;
}
} catch (Throwable $e) {
if ($isSandboxed && !$alreadySandboxed) {
$sandbox->disableSandbox();
}
throw $e;
} catch (Exception $e) {
if ($isSandboxed && !$alreadySandboxed) {
$sandbox->disableSandbox();
}
throw $e;
}
if ($isSandboxed && !$alreadySandboxed) {
$sandbox->disableSandbox();
}
return $result;
}
function twig_source(Twig_Environment $env, $name, $ignoreMissing = false)
{
$loader = $env->getLoader();
try {
if (!$loader instanceof Twig_SourceContextLoaderInterface) {
return $loader->getSource($name);
} else {
return $loader->getSourceContext($name)->getCode();
}
} catch (Twig_Error_Loader $e) {
if (!$ignoreMissing) {
throw $e;
}
}
}
function twig_constant($constant, $object = null)
{
if (null !== $object) {
$constant = get_class($object).'::'.$constant;
}
return constant($constant);
}
function twig_constant_is_defined($constant, $object = null)
{
if (null !== $object) {
$constant = get_class($object).'::'.$constant;
}
return defined($constant);
}
function twig_array_batch($items, $size, $fill = null)
{
if ($items instanceof Traversable) {
$items = iterator_to_array($items, false);
}
$size = ceil($size);
$result = array_chunk($items, $size, true);
if (null !== $fill && !empty($result)) {
$last = count($result) - 1;
if ($fillCount = $size - count($result[$last])) {
$result[$last] = array_merge(
$result[$last],
array_fill(0, $fillCount, $fill)
);
}
}
return $result;
}
class_alias('Twig_Extension_Core','Twig\Extension\CoreExtension', false);
}
namespace
{
class Twig_Extension_Escaper extends Twig_Extension
{
protected $defaultStrategy;
public function __construct($defaultStrategy ='html')
{
$this->setDefaultStrategy($defaultStrategy);
}
public function getTokenParsers()
{
return array(new Twig_TokenParser_AutoEscape());
}
public function getNodeVisitors()
{
return array(new Twig_NodeVisitor_Escaper());
}
public function getFilters()
{
return array(
new Twig_SimpleFilter('raw','twig_raw_filter', array('is_safe'=> array('all'))),
);
}
public function setDefaultStrategy($defaultStrategy)
{
if (true === $defaultStrategy) {
@trigger_error('Using "true" as the default strategy is deprecated since version 1.21. Use "html" instead.', E_USER_DEPRECATED);
$defaultStrategy ='html';
}
if ('filename'=== $defaultStrategy) {
@trigger_error('Using "filename" as the default strategy is deprecated since version 1.27. Use "name" instead.', E_USER_DEPRECATED);
$defaultStrategy ='name';
}
if ('name'=== $defaultStrategy) {
$defaultStrategy = array('Twig_FileExtensionEscapingStrategy','guess');
}
$this->defaultStrategy = $defaultStrategy;
}
public function getDefaultStrategy($name)
{
if (!is_string($this->defaultStrategy) && false !== $this->defaultStrategy) {
return call_user_func($this->defaultStrategy, $name);
}
return $this->defaultStrategy;
}
public function getName()
{
return'escaper';
}
}
function twig_raw_filter($string)
{
return $string;
}
class_alias('Twig_Extension_Escaper','Twig\Extension\EscaperExtension', false);
}
namespace
{
class Twig_Extension_Optimizer extends Twig_Extension
{
protected $optimizers;
public function __construct($optimizers = -1)
{
$this->optimizers = $optimizers;
}
public function getNodeVisitors()
{
return array(new Twig_NodeVisitor_Optimizer($this->optimizers));
}
public function getName()
{
return'optimizer';
}
}
class_alias('Twig_Extension_Optimizer','Twig\Extension\OptimizerExtension', false);
}
namespace
{
interface Twig_LoaderInterface
{
public function getSource($name);
public function getCacheKey($name);
public function isFresh($name, $time);
}
class_alias('Twig_LoaderInterface','Twig\Loader\LoaderInterface', false);
}
namespace
{
class Twig_Markup implements Countable
{
protected $content;
protected $charset;
public function __construct($content, $charset)
{
$this->content = (string) $content;
$this->charset = $charset;
}
public function __toString()
{
return $this->content;
}
public function count()
{
return function_exists('mb_get_info') ? mb_strlen($this->content, $this->charset) : strlen($this->content);
}
}
class_alias('Twig_Markup','Twig\Markup', false);
}
namespace
{
interface Twig_TemplateInterface
{
const ANY_CALL ='any';
const ARRAY_CALL ='array';
const METHOD_CALL ='method';
public function render(array $context);
public function display(array $context, array $blocks = array());
public function getEnvironment();
}
}
namespace
{
abstract class Twig_Template implements Twig_TemplateInterface
{
protected static $cache = array();
protected $parent;
protected $parents = array();
protected $env;
protected $blocks = array();
protected $traits = array();
public function __construct(Twig_Environment $env)
{
$this->env = $env;
}
public function __toString()
{
return $this->getTemplateName();
}
abstract public function getTemplateName();
public function getDebugInfo()
{
return array();
}
public function getSource()
{
@trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);
return'';
}
public function getSourceContext()
{
return new Twig_Source('', $this->getTemplateName());
}
public function getEnvironment()
{
@trigger_error('The '.__METHOD__.' method is deprecated since version 1.20 and will be removed in 2.0.', E_USER_DEPRECATED);
return $this->env;
}
public function getParent(array $context)
{
if (null !== $this->parent) {
return $this->parent;
}
try {
$parent = $this->doGetParent($context);
if (false === $parent) {
return false;
}
if ($parent instanceof self) {
return $this->parents[$parent->getTemplateName()] = $parent;
}
if (!isset($this->parents[$parent])) {
$this->parents[$parent] = $this->loadTemplate($parent);
}
} catch (Twig_Error_Loader $e) {
$e->setSourceContext(null);
$e->guess();
throw $e;
}
return $this->parents[$parent];
}
protected function doGetParent(array $context)
{
return false;
}
public function isTraitable()
{
return true;
}
public function displayParentBlock($name, array $context, array $blocks = array())
{
$name = (string) $name;
if (isset($this->traits[$name])) {
$this->traits[$name][0]->displayBlock($name, $context, $blocks, false);
} elseif (false !== $parent = $this->getParent($context)) {
$parent->displayBlock($name, $context, $blocks, false);
} else {
throw new Twig_Error_Runtime(sprintf('The template has no parent and no traits defining the "%s" block.', $name), -1, $this->getSourceContext());
}
}
public function displayBlock($name, array $context, array $blocks = array(), $useBlocks = true)
{
$name = (string) $name;
if ($useBlocks && isset($blocks[$name])) {
$template = $blocks[$name][0];
$block = $blocks[$name][1];
} elseif (isset($this->blocks[$name])) {
$template = $this->blocks[$name][0];
$block = $this->blocks[$name][1];
} else {
$template = null;
$block = null;
}
if (null !== $template && !$template instanceof self) {
throw new LogicException('A block must be a method on a Twig_Template instance.');
}
if (null !== $template) {
try {
$template->$block($context, $blocks);
} catch (Twig_Error $e) {
if (!$e->getSourceContext()) {
$e->setSourceContext($template->getSourceContext());
}
if (false === $e->getTemplateLine()) {
$e->setTemplateLine(-1);
$e->guess();
}
throw $e;
} catch (Exception $e) {
throw new Twig_Error_Runtime(sprintf('An exception has been thrown during the rendering of a template ("%s").', $e->getMessage()), -1, $template->getSourceContext(), $e);
}
} elseif (false !== $parent = $this->getParent($context)) {
$parent->displayBlock($name, $context, array_merge($this->blocks, $blocks), false);
} else {
@trigger_error(sprintf('Silent display of undefined block "%s" in template "%s" is deprecated since version 1.29 and will throw an exception in 2.0. Use the "block(\'%s\') is defined" expression to test for block existence.', $name, $this->getTemplateName(), $name), E_USER_DEPRECATED);
}
}
public function renderParentBlock($name, array $context, array $blocks = array())
{
ob_start();
$this->displayParentBlock($name, $context, $blocks);
return ob_get_clean();
}
public function renderBlock($name, array $context, array $blocks = array(), $useBlocks = true)
{
ob_start();
$this->displayBlock($name, $context, $blocks, $useBlocks);
return ob_get_clean();
}
public function hasBlock($name, array $context = null, array $blocks = array())
{
if (null === $context) {
@trigger_error('The '.__METHOD__.' method is internal and should never be called; calling it directly is deprecated since version 1.28 and won\'t be possible anymore in 2.0.', E_USER_DEPRECATED);
return isset($this->blocks[(string) $name]);
}
if (isset($blocks[$name])) {
return $blocks[$name][0] instanceof self;
}
if (isset($this->blocks[$name])) {
return true;
}
if (false !== $parent = $this->getParent($context)) {
return $parent->hasBlock($name, $context);
}
return false;
}
public function getBlockNames(array $context = null, array $blocks = array())
{
if (null === $context) {
@trigger_error('The '.__METHOD__.' method is internal and should never be called; calling it directly is deprecated since version 1.28 and won\'t be possible anymore in 2.0.', E_USER_DEPRECATED);
return array_keys($this->blocks);
}
$names = array_merge(array_keys($blocks), array_keys($this->blocks));
if (false !== $parent = $this->getParent($context)) {
$names = array_merge($names, $parent->getBlockNames($context));
}
return array_unique($names);
}
protected function loadTemplate($template, $templateName = null, $line = null, $index = null)
{
try {
if (is_array($template)) {
return $this->env->resolveTemplate($template);
}
if ($template instanceof self) {
return $template;
}
if ($template instanceof Twig_TemplateWrapper) {
return $template;
}
return $this->env->loadTemplate($template, $index);
} catch (Twig_Error $e) {
if (!$e->getSourceContext()) {
$e->setSourceContext($templateName ? new Twig_Source('', $templateName) : $this->getSourceContext());
}
if ($e->getTemplateLine()) {
throw $e;
}
if (!$line) {
$e->guess();
} else {
$e->setTemplateLine($line);
}
throw $e;
}
}
public function getBlocks()
{
return $this->blocks;
}
public function display(array $context, array $blocks = array())
{
$this->displayWithErrorHandling($this->env->mergeGlobals($context), array_merge($this->blocks, $blocks));
}
public function render(array $context)
{
$level = ob_get_level();
ob_start();
try {
$this->display($context);
} catch (Exception $e) {
while (ob_get_level() > $level) {
ob_end_clean();
}
throw $e;
} catch (Throwable $e) {
while (ob_get_level() > $level) {
ob_end_clean();
}
throw $e;
}
return ob_get_clean();
}
protected function displayWithErrorHandling(array $context, array $blocks = array())
{
try {
$this->doDisplay($context, $blocks);
} catch (Twig_Error $e) {
if (!$e->getSourceContext()) {
$e->setSourceContext($this->getSourceContext());
}
if (false === $e->getTemplateLine()) {
$e->setTemplateLine(-1);
$e->guess();
}
throw $e;
} catch (Exception $e) {
throw new Twig_Error_Runtime(sprintf('An exception has been thrown during the rendering of a template ("%s").', $e->getMessage()), -1, $this->getSourceContext(), $e);
}
}
abstract protected function doDisplay(array $context, array $blocks = array());
final protected function getContext($context, $item, $ignoreStrictCheck = false)
{
if (!array_key_exists($item, $context)) {
if ($ignoreStrictCheck || !$this->env->isStrictVariables()) {
return;
}
throw new Twig_Error_Runtime(sprintf('Variable "%s" does not exist.', $item), -1, $this->getSourceContext());
}
return $context[$item];
}
protected function getAttribute($object, $item, array $arguments = array(), $type = self::ANY_CALL, $isDefinedTest = false, $ignoreStrictCheck = false)
{
if (self::METHOD_CALL !== $type) {
$arrayItem = is_bool($item) || is_float($item) ? (int) $item : $item;
if ((is_array($object) && (isset($object[$arrayItem]) || array_key_exists($arrayItem, $object)))
|| ($object instanceof ArrayAccess && isset($object[$arrayItem]))
) {
if ($isDefinedTest) {
return true;
}
return $object[$arrayItem];
}
if (self::ARRAY_CALL === $type || !is_object($object)) {
if ($isDefinedTest) {
return false;
}
if ($ignoreStrictCheck || !$this->env->isStrictVariables()) {
return;
}
if ($object instanceof ArrayAccess) {
$message = sprintf('Key "%s" in object with ArrayAccess of class "%s" does not exist.', $arrayItem, get_class($object));
} elseif (is_object($object)) {
$message = sprintf('Impossible to access a key "%s" on an object of class "%s" that does not implement ArrayAccess interface.', $item, get_class($object));
} elseif (is_array($object)) {
if (empty($object)) {
$message = sprintf('Key "%s" does not exist as the array is empty.', $arrayItem);
} else {
$message = sprintf('Key "%s" for array with keys "%s" does not exist.', $arrayItem, implode(', ', array_keys($object)));
}
} elseif (self::ARRAY_CALL === $type) {
if (null === $object) {
$message = sprintf('Impossible to access a key ("%s") on a null variable.', $item);
} else {
$message = sprintf('Impossible to access a key ("%s") on a %s variable ("%s").', $item, gettype($object), $object);
}
} elseif (null === $object) {
$message = sprintf('Impossible to access an attribute ("%s") on a null variable.', $item);
} else {
$message = sprintf('Impossible to access an attribute ("%s") on a %s variable ("%s").', $item, gettype($object), $object);
}
throw new Twig_Error_Runtime($message, -1, $this->getSourceContext());
}
}
if (!is_object($object)) {
if ($isDefinedTest) {
return false;
}
if ($ignoreStrictCheck || !$this->env->isStrictVariables()) {
return;
}
if (null === $object) {
$message = sprintf('Impossible to invoke a method ("%s") on a null variable.', $item);
} elseif (is_array($object)) {
$message = sprintf('Impossible to invoke a method ("%s") on an array.', $item);
} else {
$message = sprintf('Impossible to invoke a method ("%s") on a %s variable ("%s").', $item, gettype($object), $object);
}
throw new Twig_Error_Runtime($message, -1, $this->getSourceContext());
}
if (self::METHOD_CALL !== $type && !$object instanceof self) { if (isset($object->$item) || array_key_exists((string) $item, $object)) {
if ($isDefinedTest) {
return true;
}
if ($this->env->hasExtension('Twig_Extension_Sandbox')) {
$this->env->getExtension('Twig_Extension_Sandbox')->checkPropertyAllowed($object, $item);
}
return $object->$item;
}
}
$class = get_class($object);
if (!isset(self::$cache[$class])) {
if ($object instanceof self) {
$ref = new ReflectionClass($class);
$methods = array();
foreach ($ref->getMethods(ReflectionMethod::IS_PUBLIC) as $refMethod) {
if ('getenvironment'!== strtolower($refMethod->name)) {
$methods[] = $refMethod->name;
}
}
} else {
$methods = get_class_methods($object);
}
sort($methods);
$cache = array();
foreach ($methods as $method) {
$cache[$method] = $method;
$cache[$lcName = strtolower($method)] = $method;
if ('g'=== $lcName[0] && 0 === strpos($lcName,'get')) {
$name = substr($method, 3);
$lcName = substr($lcName, 3);
} elseif ('i'=== $lcName[0] && 0 === strpos($lcName,'is')) {
$name = substr($method, 2);
$lcName = substr($lcName, 2);
} else {
continue;
}
if ($name) {
if (!isset($cache[$name])) {
$cache[$name] = $method;
}
if (!isset($cache[$lcName])) {
$cache[$lcName] = $method;
}
}
}
self::$cache[$class] = $cache;
}
$call = false;
if (isset(self::$cache[$class][$item])) {
$method = self::$cache[$class][$item];
} elseif (isset(self::$cache[$class][$lcItem = strtolower($item)])) {
$method = self::$cache[$class][$lcItem];
} elseif (isset(self::$cache[$class]['__call'])) {
$method = $item;
$call = true;
} else {
if ($isDefinedTest) {
return false;
}
if ($ignoreStrictCheck || !$this->env->isStrictVariables()) {
return;
}
throw new Twig_Error_Runtime(sprintf('Neither the property "%1$s" nor one of the methods "%1$s()", "get%1$s()"/"is%1$s()" or "__call()" exist and have public access in class "%2$s".', $item, $class), -1, $this->getSourceContext());
}
if ($isDefinedTest) {
return true;
}
if ($this->env->hasExtension('Twig_Extension_Sandbox')) {
$this->env->getExtension('Twig_Extension_Sandbox')->checkMethodAllowed($object, $method);
}
try {
if (!$arguments) {
$ret = $object->$method();
} else {
$ret = call_user_func_array(array($object, $method), $arguments);
}
} catch (BadMethodCallException $e) {
if ($call && ($ignoreStrictCheck || !$this->env->isStrictVariables())) {
return;
}
throw $e;
}
if ($object instanceof Twig_TemplateInterface) {
$self = $object->getTemplateName() === $this->getTemplateName();
$message = sprintf('Calling "%s" on template "%s" from template "%s" is deprecated since version 1.28 and won\'t be supported anymore in 2.0.', $item, $object->getTemplateName(), $this->getTemplateName());
if ('renderBlock'=== $method ||'displayBlock'=== $method) {
$message .= sprintf(' Use block("%s"%s) instead).', $arguments[0], $self ?'':', template');
} elseif ('hasBlock'=== $method) {
$message .= sprintf(' Use "block("%s"%s) is defined" instead).', $arguments[0], $self ?'':', template');
} elseif ('render'=== $method ||'display'=== $method) {
$message .= sprintf(' Use include("%s") instead).', $object->getTemplateName());
}
@trigger_error($message, E_USER_DEPRECATED);
return''=== $ret ?'': new Twig_Markup($ret, $this->env->getCharset());
}
return $ret;
}
}
class_alias('Twig_Template','Twig\Template', false);
}
namespace Monolog\Handler
{
use Monolog\Handler\FingersCrossed\ErrorLevelActivationStrategy;
use Monolog\Handler\FingersCrossed\ActivationStrategyInterface;
use Monolog\Logger;
class FingersCrossedHandler extends AbstractHandler
{
protected $handler;
protected $activationStrategy;
protected $buffering = true;
protected $bufferSize;
protected $buffer = array();
protected $stopBuffering;
protected $passthruLevel;
public function __construct($handler, $activationStrategy = null, $bufferSize = 0, $bubble = true, $stopBuffering = true, $passthruLevel = null)
{
if (null === $activationStrategy) {
$activationStrategy = new ErrorLevelActivationStrategy(Logger::WARNING);
}
if (!$activationStrategy instanceof ActivationStrategyInterface) {
$activationStrategy = new ErrorLevelActivationStrategy($activationStrategy);
}
$this->handler = $handler;
$this->activationStrategy = $activationStrategy;
$this->bufferSize = $bufferSize;
$this->bubble = $bubble;
$this->stopBuffering = $stopBuffering;
if ($passthruLevel !== null) {
$this->passthruLevel = Logger::toMonologLevel($passthruLevel);
}
if (!$this->handler instanceof HandlerInterface && !is_callable($this->handler)) {
throw new \RuntimeException("The given handler (".json_encode($this->handler).") is not a callable nor a Monolog\Handler\HandlerInterface object");
}
}
public function isHandling(array $record)
{
return true;
}
public function activate()
{
if ($this->stopBuffering) {
$this->buffering = false;
}
if (!$this->handler instanceof HandlerInterface) {
$record = end($this->buffer) ?: null;
$this->handler = call_user_func($this->handler, $record, $this);
if (!$this->handler instanceof HandlerInterface) {
throw new \RuntimeException("The factory callable should return a HandlerInterface");
}
}
$this->handler->handleBatch($this->buffer);
$this->buffer = array();
}
public function handle(array $record)
{
if ($this->processors) {
foreach ($this->processors as $processor) {
$record = call_user_func($processor, $record);
}
}
if ($this->buffering) {
$this->buffer[] = $record;
if ($this->bufferSize > 0 && count($this->buffer) > $this->bufferSize) {
array_shift($this->buffer);
}
if ($this->activationStrategy->isHandlerActivated($record)) {
$this->activate();
}
} else {
$this->handler->handle($record);
}
return false === $this->bubble;
}
public function close()
{
if (null !== $this->passthruLevel) {
$level = $this->passthruLevel;
$this->buffer = array_filter($this->buffer, function ($record) use ($level) {
return $record['level'] >= $level;
});
if (count($this->buffer) > 0) {
$this->handler->handleBatch($this->buffer);
$this->buffer = array();
}
}
}
public function reset()
{
$this->buffering = true;
}
public function clear()
{
$this->buffer = array();
$this->reset();
}
}
}
namespace Monolog\Handler
{
use Monolog\Logger;
class FilterHandler extends AbstractHandler
{
protected $handler;
protected $acceptedLevels;
protected $bubble;
public function __construct($handler, $minLevelOrList = Logger::DEBUG, $maxLevel = Logger::EMERGENCY, $bubble = true)
{
$this->handler = $handler;
$this->bubble = $bubble;
$this->setAcceptedLevels($minLevelOrList, $maxLevel);
if (!$this->handler instanceof HandlerInterface && !is_callable($this->handler)) {
throw new \RuntimeException("The given handler (".json_encode($this->handler).") is not a callable nor a Monolog\Handler\HandlerInterface object");
}
}
public function getAcceptedLevels()
{
return array_flip($this->acceptedLevels);
}
public function setAcceptedLevels($minLevelOrList = Logger::DEBUG, $maxLevel = Logger::EMERGENCY)
{
if (is_array($minLevelOrList)) {
$acceptedLevels = array_map('Monolog\Logger::toMonologLevel', $minLevelOrList);
} else {
$minLevelOrList = Logger::toMonologLevel($minLevelOrList);
$maxLevel = Logger::toMonologLevel($maxLevel);
$acceptedLevels = array_values(array_filter(Logger::getLevels(), function ($level) use ($minLevelOrList, $maxLevel) {
return $level >= $minLevelOrList && $level <= $maxLevel;
}));
}
$this->acceptedLevels = array_flip($acceptedLevels);
}
public function isHandling(array $record)
{
return isset($this->acceptedLevels[$record['level']]);
}
public function handle(array $record)
{
if (!$this->isHandling($record)) {
return false;
}
if (!$this->handler instanceof HandlerInterface) {
$this->handler = call_user_func($this->handler, $record, $this);
if (!$this->handler instanceof HandlerInterface) {
throw new \RuntimeException("The factory callable should return a HandlerInterface");
}
}
if ($this->processors) {
foreach ($this->processors as $processor) {
$record = call_user_func($processor, $record);
}
}
$this->handler->handle($record);
return false === $this->bubble;
}
public function handleBatch(array $records)
{
$filtered = array();
foreach ($records as $record) {
if ($this->isHandling($record)) {
$filtered[] = $record;
}
}
$this->handler->handleBatch($filtered);
}
}
}
namespace Monolog\Handler\FingersCrossed
{
interface ActivationStrategyInterface
{
public function isHandlerActivated(array $record);
}
}
namespace Monolog\Handler\FingersCrossed
{
use Monolog\Logger;
class ErrorLevelActivationStrategy implements ActivationStrategyInterface
{
private $actionLevel;
public function __construct($actionLevel)
{
$this->actionLevel = Logger::toMonologLevel($actionLevel);
}
public function isHandlerActivated(array $record)
{
return $record['level'] >= $this->actionLevel;
}
}
}
namespace Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter
{
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
interface ParamConverterInterface
{
public function apply(Request $request, ParamConverter $configuration);
public function supports(ParamConverter $configuration);
}
}
namespace Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter
{
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use DateTime;
class DateTimeParamConverter implements ParamConverterInterface
{
public function apply(Request $request, ParamConverter $configuration)
{
$param = $configuration->getName();
if (!$request->attributes->has($param)) {
return false;
}
$options = $configuration->getOptions();
$value = $request->attributes->get($param);
if (!$value && $configuration->isOptional()) {
return false;
}
if (isset($options['format'])) {
$date = DateTime::createFromFormat($options['format'], $value);
if (!$date) {
throw new NotFoundHttpException('Invalid date given.');
}
} else {
if (false === strtotime($value)) {
throw new NotFoundHttpException('Invalid date given.');
}
$date = new DateTime($value);
}
$request->attributes->set($param, $date);
return true;
}
public function supports(ParamConverter $configuration)
{
if (null === $configuration->getClass()) {
return false;
}
return'DateTime'=== $configuration->getClass();
}
}
}
namespace Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter
{
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\NoResultException;
class DoctrineParamConverter implements ParamConverterInterface
{
protected $registry;
public function __construct(ManagerRegistry $registry = null)
{
$this->registry = $registry;
}
public function apply(Request $request, ParamConverter $configuration)
{
$name = $configuration->getName();
$class = $configuration->getClass();
$options = $this->getOptions($configuration);
if (null === $request->attributes->get($name, false)) {
$configuration->setIsOptional(true);
}
if (false === $object = $this->find($class, $request, $options, $name)) {
if (false === $object = $this->findOneBy($class, $request, $options)) {
if ($configuration->isOptional()) {
$object = null;
} else {
throw new \LogicException('Unable to guess how to get a Doctrine instance from the request information.');
}
}
}
if (null === $object && false === $configuration->isOptional()) {
throw new NotFoundHttpException(sprintf('%s object not found.', $class));
}
$request->attributes->set($name, $object);
return true;
}
protected function find($class, Request $request, $options, $name)
{
if ($options['mapping'] || $options['exclude']) {
return false;
}
$id = $this->getIdentifier($request, $options, $name);
if (false === $id || null === $id) {
return false;
}
if (isset($options['repository_method'])) {
$method = $options['repository_method'];
} else {
$method ='find';
}
try {
return $this->getManager($options['entity_manager'], $class)->getRepository($class)->$method($id);
} catch (NoResultException $e) {
return;
}
}
protected function getIdentifier(Request $request, $options, $name)
{
if (isset($options['id'])) {
if (!is_array($options['id'])) {
$name = $options['id'];
} elseif (is_array($options['id'])) {
$id = array();
foreach ($options['id'] as $field) {
$id[$field] = $request->attributes->get($field);
}
return $id;
}
}
if ($request->attributes->has($name)) {
return $request->attributes->get($name);
}
if ($request->attributes->has('id') && !isset($options['id'])) {
return $request->attributes->get('id');
}
return false;
}
protected function findOneBy($class, Request $request, $options)
{
if (!$options['mapping']) {
$keys = $request->attributes->keys();
$options['mapping'] = $keys ? array_combine($keys, $keys) : array();
}
foreach ($options['exclude'] as $exclude) {
unset($options['mapping'][$exclude]);
}
if (!$options['mapping']) {
return false;
}
if (isset($options['id']) && null === $request->attributes->get($options['id'])) {
return false;
}
$criteria = array();
$em = $this->getManager($options['entity_manager'], $class);
$metadata = $em->getClassMetadata($class);
$mapMethodSignature = isset($options['repository_method'])
&& isset($options['map_method_signature'])
&& $options['map_method_signature'] === true;
foreach ($options['mapping'] as $attribute => $field) {
if ($metadata->hasField($field)
|| ($metadata->hasAssociation($field) && $metadata->isSingleValuedAssociation($field))
|| $mapMethodSignature) {
$criteria[$field] = $request->attributes->get($attribute);
}
}
if ($options['strip_null']) {
$criteria = array_filter($criteria, function ($value) { return !is_null($value); });
}
if (!$criteria) {
return false;
}
if (isset($options['repository_method'])) {
$repositoryMethod = $options['repository_method'];
} else {
$repositoryMethod ='findOneBy';
}
try {
if ($mapMethodSignature) {
return $this->findDataByMapMethodSignature($em, $class, $repositoryMethod, $criteria);
}
return $em->getRepository($class)->$repositoryMethod($criteria);
} catch (NoResultException $e) {
return;
}
}
private function findDataByMapMethodSignature($em, $class, $repositoryMethod, $criteria)
{
$arguments = array();
$repository = $em->getRepository($class);
$ref = new \ReflectionMethod($repository, $repositoryMethod);
foreach ($ref->getParameters() as $parameter) {
if (array_key_exists($parameter->name, $criteria)) {
$arguments[] = $criteria[$parameter->name];
} elseif ($parameter->isDefaultValueAvailable()) {
$arguments[] = $parameter->getDefaultValue();
} else {
throw new \InvalidArgumentException(sprintf('Repository method "%s::%s" requires that you provide a value for the "$%s" argument.', get_class($repository), $repositoryMethod, $parameter->name));
}
}
return $ref->invokeArgs($repository, $arguments);
}
public function supports(ParamConverter $configuration)
{
if (null === $this->registry || !count($this->registry->getManagers())) {
return false;
}
if (null === $configuration->getClass()) {
return false;
}
$options = $this->getOptions($configuration);
$em = $this->getManager($options['entity_manager'], $configuration->getClass());
if (null === $em) {
return false;
}
return !$em->getMetadataFactory()->isTransient($configuration->getClass());
}
protected function getOptions(ParamConverter $configuration)
{
return array_replace(array('entity_manager'=> null,'exclude'=> array(),'mapping'=> array(),'strip_null'=> false,
), $configuration->getOptions());
}
private function getManager($name, $class)
{
if (null === $name) {
return $this->registry->getManagerForClass($class);
}
return $this->registry->getManager($name);
}
}
}
namespace Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter
{
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ConfigurationInterface;
class ParamConverterManager
{
protected $converters = array();
protected $namedConverters = array();
public function apply(Request $request, $configurations)
{
if (is_object($configurations)) {
$configurations = array($configurations);
}
foreach ($configurations as $configuration) {
$this->applyConverter($request, $configuration);
}
}
protected function applyConverter(Request $request, ConfigurationInterface $configuration)
{
$value = $request->attributes->get($configuration->getName());
$className = $configuration->getClass();
if (is_object($value) && $value instanceof $className) {
return;
}
if ($converterName = $configuration->getConverter()) {
if (!isset($this->namedConverters[$converterName])) {
throw new \RuntimeException(sprintf("No converter named '%s' found for conversion of parameter '%s'.",
$converterName, $configuration->getName()
));
}
$converter = $this->namedConverters[$converterName];
if (!$converter->supports($configuration)) {
throw new \RuntimeException(sprintf("Converter '%s' does not support conversion of parameter '%s'.",
$converterName, $configuration->getName()
));
}
$converter->apply($request, $configuration);
return;
}
foreach ($this->all() as $converter) {
if ($converter->supports($configuration)) {
if ($converter->apply($request, $configuration)) {
return;
}
}
}
}
public function add(ParamConverterInterface $converter, $priority = 0, $name = null)
{
if ($priority !== null) {
if (!isset($this->converters[$priority])) {
$this->converters[$priority] = array();
}
$this->converters[$priority][] = $converter;
}
if (null !== $name) {
$this->namedConverters[$name] = $converter;
}
}
public function all()
{
krsort($this->converters);
$converters = array();
foreach ($this->converters as $all) {
$converters = array_merge($converters, $all);
}
return $converters;
}
}
}
namespace Sensio\Bundle\FrameworkExtraBundle\Configuration
{
interface ConfigurationInterface
{
public function getAliasName();
public function allowArray();
}
}
namespace Sensio\Bundle\FrameworkExtraBundle\Configuration
{
abstract class ConfigurationAnnotation implements ConfigurationInterface
{
public function __construct(array $values)
{
foreach ($values as $k => $v) {
if (!method_exists($this, $name ='set'.$k)) {
throw new \RuntimeException(sprintf('Unknown key "%s" for annotation "@%s".', $k, get_class($this)));
}
$this->$name($v);
}
}
}
}
namespace Sonata\CoreBundle\Form\Type
{
use Sonata\CoreBundle\Form\DataTransformer\BooleanTypeToBooleanTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
class BooleanType extends AbstractType
{
const TYPE_YES = 1;
const TYPE_NO = 2;
public function buildForm(FormBuilderInterface $builder, array $options)
{
if ($options['transform']) {
$builder->addModelTransformer(new BooleanTypeToBooleanTransformer());
}
if ('SonataCoreBundle'!== $options['catalogue']) {
@trigger_error('Option "catalogue" is deprecated since SonataCoreBundle 2.3.10 and will be removed in 4.0.'.' Use option "translation_domain" instead.',
E_USER_DEPRECATED
);
}
}
public function setDefaultOptions(OptionsResolverInterface $resolver)
{
$this->configureOptions($resolver);
}
public function configureOptions(OptionsResolver $resolver)
{
$defaultOptions = ['transform'=> false,'catalogue'=>'SonataCoreBundle','choice_translation_domain'=>'SonataCoreBundle','choices'=> ['label_type_yes'=> self::TYPE_YES,'label_type_no'=> self::TYPE_NO,
],'translation_domain'=> function (Options $options) {
if ($options['catalogue']) {
return $options['catalogue'];
}
return $options['translation_domain'];
},
];
if (method_exists(FormTypeInterface::class,'setDefaultOptions')) {
$defaultOptions['choices_as_values'] = true;
}
$resolver->setDefaults($defaultOptions);
}
public function getParent()
{
return ChoiceType::class;
}
public function getName()
{
return $this->getBlockPrefix();
}
public function getBlockPrefix()
{
return'sonata_type_boolean';
}
}
}
namespace Sonata\CoreBundle\Form\Type
{
use Sonata\CoreBundle\Form\EventListener\ResizeFormListener;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
class CollectionType extends AbstractType
{
public function buildForm(FormBuilderInterface $builder, array $options)
{
$listener = new ResizeFormListener(
$options['type'],
$options['type_options'],
$options['modifiable'],
$options['pre_bind_data_callback']
);
$builder->addEventSubscriber($listener);
}
public function buildView(FormView $view, FormInterface $form, array $options)
{
$view->vars['btn_add'] = $options['btn_add'];
$view->vars['btn_catalogue'] = $options['btn_catalogue'];
}
public function setDefaultOptions(OptionsResolverInterface $resolver)
{
$this->configureOptions($resolver);
}
public function configureOptions(OptionsResolver $resolver)
{
$resolver->setDefaults(['modifiable'=> false,'type'=> TextType::class,'type_options'=> [],'pre_bind_data_callback'=> null,'btn_add'=>'link_add','btn_catalogue'=>'SonataCoreBundle',
]);
}
public function getBlockPrefix()
{
return'sonata_type_collection';
}
public function getName()
{
return $this->getBlockPrefix();
}
}
}
namespace Sonata\CoreBundle\Form\Type
{
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Translation\TranslatorInterface;
class DateRangeType extends AbstractType
{
protected $translator;
public function __construct(TranslatorInterface $translator = null)
{
if (null !== $translator && __CLASS__ !== get_class($this) && DateRangePickerType::class !== get_class($this)) {
@trigger_error('The translator dependency in '.__CLASS__.' is deprecated since 3.1 and will be removed in 4.0. '.'Please prepare your dependencies for this change.',
E_USER_DEPRECATED
);
}
$this->translator = $translator;
}
public function buildForm(FormBuilderInterface $builder, array $options)
{
$options['field_options_start'] = array_merge(
['label'=>'date_range_start','translation_domain'=>'SonataCoreBundle',
],
$options['field_options_start']
);
$options['field_options_end'] = array_merge(
['label'=>'date_range_end','translation_domain'=>'SonataCoreBundle',
],
$options['field_options_end']
);
$builder->add('start', $options['field_type'], array_merge(['required'=> false], $options['field_options'], $options['field_options_start']));
$builder->add('end', $options['field_type'], array_merge(['required'=> false], $options['field_options'], $options['field_options_end']));
}
public function getBlockPrefix()
{
return'sonata_type_date_range';
}
public function getName()
{
return $this->getBlockPrefix();
}
public function setDefaultOptions(OptionsResolverInterface $resolver)
{
$this->configureOptions($resolver);
}
public function configureOptions(OptionsResolver $resolver)
{
$resolver->setDefaults(['field_options'=> [],'field_options_start'=> [],'field_options_end'=> [],'field_type'=> DateType::class,
]);
}
}
}
namespace Sonata\CoreBundle\Form\Type
{
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Translation\TranslatorInterface;
class DateTimeRangeType extends AbstractType
{
protected $translator;
public function __construct(TranslatorInterface $translator = null)
{
if (null !== $translator && __CLASS__ !== get_class($this) && DateTimeRangePickerType::class !== get_class($this)) {
@trigger_error('The translator dependency in '.__CLASS__.' is deprecated since 3.1 and will be removed in 4.0. '.'Please prepare your dependencies for this change.',
E_USER_DEPRECATED
);
}
$this->translator = $translator;
}
public function buildForm(FormBuilderInterface $builder, array $options)
{
$options['field_options_start'] = array_merge(
['label'=>'date_range_start','translation_domain'=>'SonataCoreBundle',
],
$options['field_options_start']
);
$options['field_options_end'] = array_merge(
['label'=>'date_range_end','translation_domain'=>'SonataCoreBundle',
],
$options['field_options_end']
);
$builder->add('start', $options['field_type'], array_merge(['required'=> false], $options['field_options'], $options['field_options_start']));
$builder->add('end', $options['field_type'], array_merge(['required'=> false], $options['field_options'], $options['field_options_end']));
}
public function getBlockPrefix()
{
return'sonata_type_datetime_range';
}
public function getName()
{
return $this->getBlockPrefix();
}
public function setDefaultOptions(OptionsResolverInterface $resolver)
{
$this->configureOptions($resolver);
}
public function configureOptions(OptionsResolver $resolver)
{
$resolver->setDefaults(['field_options'=> [],'field_options_start'=> [],'field_options_end'=> [],'field_type'=> DateTimeType::class,
]);
}
}
}
namespace Sonata\CoreBundle\Form\Type
{
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Translation\TranslatorInterface;
class EqualType extends AbstractType
{
const TYPE_IS_EQUAL = 1;
const TYPE_IS_NOT_EQUAL = 2;
protected $translator;
public function __construct(TranslatorInterface $translator = null)
{
if (null !== $translator && __CLASS__ !== get_class($this)) {
@trigger_error('The translator dependency in '.__CLASS__.' is deprecated since 3.1 and will be removed in 4.0. '.'Please prepare your dependencies for this change.',
E_USER_DEPRECATED
);
}
$this->translator = $translator;
}
public function setDefaultOptions(OptionsResolverInterface $resolver)
{
$this->configureOptions($resolver);
}
public function configureOptions(OptionsResolver $resolver)
{
$defaultOptions = ['choice_translation_domain'=>'SonataCoreBundle','choices'=> ['label_type_equals'=> self::TYPE_IS_EQUAL,'label_type_not_equals'=> self::TYPE_IS_NOT_EQUAL,
],
];
if (method_exists(FormTypeInterface::class,'setDefaultOptions')) {
$defaultOptions['choices_as_values'] = true;
}
$resolver->setDefaults($defaultOptions);
}
public function getParent()
{
return ChoiceType::class;
}
public function getBlockPrefix()
{
return'sonata_type_equal';
}
public function getName()
{
return $this->getBlockPrefix();
}
}
}
namespace Sonata\CoreBundle\Form\Type
{
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
class ImmutableArrayType extends AbstractType
{
public function buildForm(FormBuilderInterface $builder, array $options)
{
foreach ($options['keys'] as $infos) {
if ($infos instanceof FormBuilderInterface) {
$builder->add($infos);
} else {
list($name, $type, $options) = $infos;
if (is_callable($options)) {
$extra = array_slice($infos, 3);
$options = $options($builder, $name, $type, $extra);
if (null === $options) {
$options = [];
} elseif (!is_array($options)) {
throw new \RuntimeException('the closure must return null or an array');
}
}
$builder->add($name, $type, $options);
}
}
}
public function setDefaultOptions(OptionsResolverInterface $resolver)
{
$this->configureOptions($resolver);
}
public function configureOptions(OptionsResolver $resolver)
{
$resolver->setDefaults(['keys'=> [],
]);
$resolver->setAllowedValues('keys', function ($value) {
foreach ($value as $subValue) {
if (!$subValue instanceof FormBuilderInterface && (!is_array($subValue) || 3 !== count($subValue))) {
return false;
}
}
return true;
});
}
public function getBlockPrefix()
{
return'sonata_type_immutable_array';
}
public function getName()
{
return $this->getBlockPrefix();
}
}
}
namespace Sonata\CoreBundle\Form\Type
{
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Translation\TranslatorInterface;
@trigger_error(
sprintf('Form type "%s" is deprecated since SonataCoreBundle 2.2.0 and will be'.' removed in 4.0. Use form type "%s" with "translation_domain" option instead.',
TranslatableChoiceType::class,
ChoiceType::class
),
E_USER_DEPRECATED
);
class TranslatableChoiceType extends AbstractType
{
protected $translator;
public function __construct(TranslatorInterface $translator)
{
$this->translator = $translator;
}
public function setDefaultOptions(OptionsResolverInterface $resolver)
{
$this->configureOptions($resolver);
}
public function configureOptions(OptionsResolver $resolver)
{
$resolver->setDefaults(['catalogue'=>'messages',
]);
}
public function buildView(FormView $view, FormInterface $form, array $options)
{
$view->vars['translation_domain'] = $options['catalogue'];
}
public function getParent()
{
return ChoiceType::class;
}
public function getBlockPrefix()
{
return'sonata_type_translatable_choice';
}
public function getName()
{
return $this->getBlockPrefix();
}
}
}
namespace Sonata\BlockBundle\Block
{
use Sonata\BlockBundle\Exception\BlockNotFoundException;
use Sonata\BlockBundle\Model\BlockInterface;
interface BlockLoaderInterface
{
public function load($name);
public function support($name);
}
}
namespace Sonata\BlockBundle\Block
{
use Sonata\BlockBundle\Exception\BlockNotFoundException;
class BlockLoaderChain implements BlockLoaderInterface
{
protected $loaders;
public function __construct(array $loaders)
{
$this->loaders = $loaders;
}
public function exists($type)
{
foreach ($this->loaders as $loader) {
if ($loader->exists($type)) {
return true;
}
}
return false;
}
public function load($block)
{
foreach ($this->loaders as $loader) {
if ($loader->support($block)) {
return $loader->load($block);
}
}
throw new BlockNotFoundException();
}
public function support($name)
{
return true;
}
}
}
namespace Sonata\BlockBundle\Block
{
use Symfony\Component\HttpFoundation\Response;
interface BlockRendererInterface
{
public function render(BlockContextInterface $name, Response $response = null);
}
}
namespace Sonata\BlockBundle\Block
{
use Psr\Log\LoggerInterface;
use Sonata\BlockBundle\Exception\Strategy\StrategyManagerInterface;
use Symfony\Component\HttpFoundation\Response;
class BlockRenderer implements BlockRendererInterface
{
protected $blockServiceManager;
protected $exceptionStrategyManager;
protected $logger;
protected $debug;
private $lastResponse;
public function __construct(BlockServiceManagerInterface $blockServiceManager, StrategyManagerInterface $exceptionStrategyManager, LoggerInterface $logger = null, $debug = false)
{
$this->blockServiceManager = $blockServiceManager;
$this->exceptionStrategyManager = $exceptionStrategyManager;
$this->logger = $logger;
$this->debug = $debug;
}
public function render(BlockContextInterface $blockContext, Response $response = null)
{
$block = $blockContext->getBlock();
if ($this->logger) {
$this->logger->info(sprintf('[cms::renderBlock] block.id=%d, block.type=%s ', $block->getId(), $block->getType()));
}
try {
$service = $this->blockServiceManager->get($block);
$service->load($block);
$response = $service->execute($blockContext, $this->createResponse($blockContext, $response));
if (!$response instanceof Response) {
$response = null;
throw new \RuntimeException('A block service must return a Response object');
}
$response = $this->addMetaInformation($response, $blockContext, $service);
} catch (\Exception $exception) {
if ($this->logger) {
$this->logger->error(sprintf('[cms::renderBlock] block.id=%d - error while rendering block - %s',
$block->getId(),
$exception->getMessage()
), compact('exception'));
}
$this->lastResponse = null;
$response = $this->exceptionStrategyManager->handleException($exception, $blockContext->getBlock(), $response);
}
return $response;
}
protected function createResponse(BlockContextInterface $blockContext, Response $response = null)
{
if (null === $response) {
$response = new Response();
}
if (($ttl = $blockContext->getBlock()->getTtl()) > 0) {
$response->setTtl($ttl);
}
return $response;
}
protected function addMetaInformation(Response $response, BlockContextInterface $blockContext, BlockServiceInterface $service)
{
if ($this->lastResponse && $this->lastResponse->isCacheable()) {
$response->setTtl($this->lastResponse->getTtl());
$response->setPublic();
} elseif ($this->lastResponse) { $response->setPrivate();
$response->setTtl(0);
$response->headers->removeCacheControlDirective('s-maxage');
$response->headers->removeCacheControlDirective('maxage');
}
if (!$blockContext->getBlock()->hasParent()) {
$this->lastResponse = null;
} else { $this->lastResponse = $response;
}
return $response;
}
}
}
namespace Sonata\BlockBundle\Block
{
use Sonata\BlockBundle\Model\BlockInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
interface BlockServiceInterface
{
public function execute(BlockContextInterface $blockContext, Response $response = null);
public function getName();
public function setDefaultSettings(OptionsResolverInterface $resolver);
public function load(BlockInterface $block);
public function getJavascripts($media);
public function getStylesheets($media);
public function getCacheKeys(BlockInterface $block);
}
}
namespace Sonata\BlockBundle\Block
{
use Sonata\BlockBundle\Model\BlockInterface;
use Sonata\CoreBundle\Validator\ErrorElement;
interface BlockServiceManagerInterface
{
public function add($name, $service, $contexts = []);
public function get(BlockInterface $block);
public function setServices(array $blockServices);
public function getServices();
public function getServicesByContext($name, $includeContainers = true);
public function has($name);
public function getService($name);
public function getLoadedServices();
public function validate(ErrorElement $errorElement, BlockInterface $block);
}
}
namespace Sonata\BlockBundle\Block
{
use Psr\Log\LoggerInterface;
use Sonata\BlockBundle\Model\BlockInterface;
use Sonata\CoreBundle\Validator\ErrorElement;
use Symfony\Component\DependencyInjection\ContainerInterface;
class BlockServiceManager implements BlockServiceManagerInterface
{
protected $services;
protected $container;
protected $inValidate;
protected $contexts;
public function __construct(ContainerInterface $container, $debug, LoggerInterface $logger = null)
{
$this->services = [];
$this->contexts = [];
$this->container = $container;
}
public function get(BlockInterface $block)
{
$this->load($block->getType());
return $this->services[$block->getType()];
}
public function getService($id)
{
return $this->load($id);
}
public function has($id)
{
return isset($this->services[$id]) ? true : false;
}
public function add($name, $service, $contexts = [])
{
$this->services[$name] = $service;
foreach ($contexts as $context) {
if (!array_key_exists($context, $this->contexts)) {
$this->contexts[$context] = [];
}
$this->contexts[$context][] = $name;
}
}
public function setServices(array $blockServices)
{
foreach ($blockServices as $name => $service) {
$this->add($name, $service);
}
}
public function getServices()
{
foreach ($this->services as $name => $id) {
if (is_string($id)) {
$this->load($id);
}
}
return $this->sortServices($this->services);
}
public function getServicesByContext($context, $includeContainers = true)
{
if (!array_key_exists($context, $this->contexts)) {
return [];
}
$services = [];
$containers = $this->container->getParameter('sonata.block.container.types');
foreach ($this->contexts[$context] as $name) {
if (!$includeContainers && in_array($name, $containers)) {
continue;
}
$services[$name] = $this->getService($name);
}
return $this->sortServices($services);
}
public function getLoadedServices()
{
$services = [];
foreach ($this->services as $service) {
if (!$service instanceof BlockServiceInterface) {
continue;
}
$services[] = $service;
}
return $services;
}
public function validate(ErrorElement $errorElement, BlockInterface $block)
{
if (!$block->getId() && !$block->getType()) {
return;
}
if ($this->inValidate) {
return;
}
try {
$this->inValidate = true;
$this->get($block)->validateBlock($errorElement, $block);
$this->inValidate = false;
} catch (\Exception $e) {
$this->inValidate = false;
}
}
private function load($type)
{
if (!$this->has($type)) {
throw new \RuntimeException(sprintf('The block service `%s` does not exist', $type));
}
if (!$this->services[$type] instanceof BlockServiceInterface) {
$this->services[$type] = $this->container->get($type);
}
if (!$this->services[$type] instanceof BlockServiceInterface) {
throw new \RuntimeException(sprintf('The service %s does not implement BlockServiceInterface', $type));
}
return $this->services[$type];
}
private function sortServices($services)
{
uasort($services, function ($a, $b) {
if ($a->getName() == $b->getName()) {
return 0;
}
return ($a->getName() < $b->getName()) ? -1 : 1;
});
return $services;
}
}
}
namespace Sonata\BlockBundle\Block\Loader
{
use Sonata\BlockBundle\Block\BlockLoaderInterface;
use Sonata\BlockBundle\Model\Block;
class ServiceLoader implements BlockLoaderInterface
{
protected $types;
public function __construct(array $types)
{
$this->types = $types;
}
public function exists($type)
{
return in_array($type, $this->types, true);
}
public function load($configuration)
{
if (!in_array($configuration['type'], $this->types)) {
throw new \RuntimeException(sprintf('The block type "%s" does not exist',
$configuration['type']
));
}
$block = new Block();
$block->setId(uniqid());
$block->setType($configuration['type']);
$block->setEnabled(true);
$block->setCreatedAt(new \DateTime());
$block->setUpdatedAt(new \DateTime());
$block->setSettings(isset($configuration['settings']) ? $configuration['settings'] : []);
return $block;
}
public function support($configuration)
{
if (!is_array($configuration)) {
return false;
}
if (!isset($configuration['type'])) {
return false;
}
return true;
}
}
}
namespace Sonata\BlockBundle\Block\Service
{
interface BlockServiceInterface extends \Sonata\BlockBundle\Block\BlockServiceInterface
{
}
}
namespace Sonata\BlockBundle\Block\Service
{
use Sonata\BlockBundle\Block\BlockContextInterface;
use Sonata\BlockBundle\Model\BlockInterface;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
abstract class AbstractBlockService implements BlockServiceInterface
{
protected $name;
protected $templating;
public function __construct($name = null, EngineInterface $templating = null)
{
if (null === $name || null === $templating) {
@trigger_error('The $name and $templating parameters will be required fields with the 4.0 release.',
E_USER_DEPRECATED
);
}
$this->name = $name;
$this->templating = $templating;
}
public function renderResponse($view, array $parameters = [], Response $response = null)
{
return $this->getTemplating()->renderResponse($view, $parameters, $response);
}
public function renderPrivateResponse($view, array $parameters = [], Response $response = null)
{
return $this->renderResponse($view, $parameters, $response)
->setTtl(0)
->setPrivate()
;
}
public function setDefaultSettings(OptionsResolverInterface $resolver)
{
$this->configureSettings($resolver);
}
public function configureSettings(OptionsResolver $resolver)
{
}
public function getCacheKeys(BlockInterface $block)
{
return ['block_id'=> $block->getId(),'updated_at'=> $block->getUpdatedAt() ? $block->getUpdatedAt()->format('U') : strtotime('now'),
];
}
public function load(BlockInterface $block)
{
}
public function getJavascripts($media)
{
return [];
}
public function getStylesheets($media)
{
return [];
}
public function execute(BlockContextInterface $blockContext, Response $response = null)
{
return $this->renderResponse($blockContext->getTemplate(), ['block_context'=> $blockContext,'block'=> $blockContext->getBlock(),
], $response);
}
public function getName()
{
return $this->name;
}
public function getTemplating()
{
return $this->templating;
}
}
}
namespace Sonata\BlockBundle\Block\Service
{
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\BlockBundle\Block\BlockContextInterface;
use Sonata\BlockBundle\Model\BlockInterface;
use Sonata\CoreBundle\Validator\ErrorElement;
use Symfony\Component\HttpFoundation\Response;
class EmptyBlockService extends AbstractBlockService
{
public function buildEditForm(FormMapper $form, BlockInterface $block)
{
throw new \RuntimeException('Not used, this block renders an empty result if no block document can be found');
}
public function validateBlock(ErrorElement $errorElement, BlockInterface $block)
{
throw new \RuntimeException('Not used, this block renders an empty result if no block document can be found');
}
public function execute(BlockContextInterface $blockContext, Response $response = null)
{
return new Response();
}
}
}
namespace Sonata\BlockBundle\Block\Service
{
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\BlockBundle\Model\BlockInterface;
use Sonata\CoreBundle\Model\MetadataInterface;
use Sonata\CoreBundle\Validator\ErrorElement;
interface AdminBlockServiceInterface extends BlockServiceInterface
{
public function buildEditForm(FormMapper $form, BlockInterface $block);
public function buildCreateForm(FormMapper $form, BlockInterface $block);
public function validateBlock(ErrorElement $errorElement, BlockInterface $block);
public function getBlockMetadata($code = null);
}
}
namespace Sonata\BlockBundle\Block\Service
{
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\BlockBundle\Model\BlockInterface;
use Sonata\CoreBundle\Model\Metadata;
use Sonata\CoreBundle\Validator\ErrorElement;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
abstract class AbstractAdminBlockService extends AbstractBlockService implements AdminBlockServiceInterface
{
public function __construct($name, EngineInterface $templating)
{
parent::__construct($name, $templating);
}
public function buildCreateForm(FormMapper $formMapper, BlockInterface $block)
{
$this->buildEditForm($formMapper, $block);
}
public function prePersist(BlockInterface $block)
{
}
public function postPersist(BlockInterface $block)
{
}
public function preUpdate(BlockInterface $block)
{
}
public function postUpdate(BlockInterface $block)
{
}
public function preRemove(BlockInterface $block)
{
}
public function postRemove(BlockInterface $block)
{
}
public function buildEditForm(FormMapper $form, BlockInterface $block)
{
}
public function validateBlock(ErrorElement $errorElement, BlockInterface $block)
{
}
public function getBlockMetadata($code = null)
{
return new Metadata($this->getName(), (null !== $code ? $code : $this->getName()), false,'SonataBlockBundle', ['class'=>'fa fa-file']);
}
}
}
namespace Sonata\BlockBundle\Block\Service
{
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\BlockBundle\Block\BlockContextInterface;
use Sonata\BlockBundle\Model\BlockInterface;
use Sonata\CoreBundle\Form\Type\ImmutableArrayType;
use Sonata\CoreBundle\Model\Metadata;
use Sonata\CoreBundle\Validator\ErrorElement;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolver;
class RssBlockService extends AbstractAdminBlockService
{
public function configureSettings(OptionsResolver $resolver)
{
$resolver->setDefaults(['url'=> false,'title'=> null,'translation_domain'=> null,'icon'=>'fa fa-rss-square','class'=> null,'template'=>'@SonataBlock/Block/block_core_rss.html.twig',
]);
}
public function buildEditForm(FormMapper $formMapper, BlockInterface $block)
{
$formMapper->add('settings', ImmutableArrayType::class, ['keys'=> [
['url', UrlType::class, ['required'=> false,'label'=>'form.label_url',
]],
['title', TextType::class, ['label'=>'form.label_title','required'=> false,
]],
['translation_domain', TextType::class, ['label'=>'form.label_translation_domain','required'=> false,
]],
['icon', TextType::class, ['label'=>'form.label_icon','required'=> false,
]],
['class', TextType::class, ['label'=>'form.label_class','required'=> false,
]],
],'translation_domain'=>'SonataBlockBundle',
]);
}
public function validateBlock(ErrorElement $errorElement, BlockInterface $block)
{
$errorElement
->with('settings[url]')
->assertNotNull([])
->assertNotBlank()
->end()
->with('settings[title]')
->assertNotNull([])
->assertNotBlank()
->assertLength(['max'=> 50])
->end();
}
public function execute(BlockContextInterface $blockContext, Response $response = null)
{
$settings = $blockContext->getSettings();
$feeds = false;
if ($settings['url']) {
$options = ['http'=> ['user_agent'=>'Sonata/RSS Reader','timeout'=> 2,
],
];
$content = @file_get_contents($settings['url'], false, stream_context_create($options));
if ($content) {
try {
$feeds = new \SimpleXMLElement($content);
$feeds = $feeds->channel->item;
} catch (\Exception $e) {
}
}
}
return $this->renderResponse($blockContext->getTemplate(), ['feeds'=> $feeds,'block'=> $blockContext->getBlock(),'settings'=> $settings,
], $response);
}
public function getBlockMetadata($code = null)
{
return new Metadata($this->getName(), (null !== $code ? $code : $this->getName()), false,'SonataBlockBundle', ['class'=>'fa fa-rss-square',
]);
}
}
}
namespace Sonata\BlockBundle\Block\Service
{
use Knp\Menu\ItemInterface;
use Knp\Menu\Provider\MenuProviderInterface;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\BlockBundle\Block\BlockContextInterface;
use Sonata\BlockBundle\Menu\MenuRegistry;
use Sonata\BlockBundle\Menu\MenuRegistryInterface;
use Sonata\BlockBundle\Model\BlockInterface;
use Sonata\CoreBundle\Form\Type\ImmutableArrayType;
use Sonata\CoreBundle\Model\Metadata;
use Sonata\CoreBundle\Validator\ErrorElement;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolver;
class MenuBlockService extends AbstractAdminBlockService
{
protected $menuProvider;
protected $menus;
protected $menuRegistry;
public function __construct($name, EngineInterface $templating, MenuProviderInterface $menuProvider, $menuRegistry = null)
{
parent::__construct($name, $templating);
$this->menuProvider = $menuProvider;
if ($menuRegistry instanceof MenuRegistryInterface) {
$this->menuRegistry = $menuRegistry;
} elseif (null === $menuRegistry) {
$this->menuRegistry = new MenuRegistry();
} elseif (is_array($menuRegistry)) { @trigger_error('Initializing '.__CLASS__.' with an array parameter is deprecated since 3.3 and will be removed in 4.0.',
E_USER_DEPRECATED
);
$this->menuRegistry = new MenuRegistry();
foreach ($menuRegistry as $menu) {
$this->menuRegistry->add($menu);
}
} else {
throw new \InvalidArgumentException(sprintf('MenuRegistry must be either null or instance of %s',
MenuRegistryInterface::class
));
}
}
public function execute(BlockContextInterface $blockContext, Response $response = null)
{
$responseSettings = ['menu'=> $this->getMenu($blockContext),'menu_options'=> $this->getMenuOptions($blockContext->getSettings()),'block'=> $blockContext->getBlock(),'context'=> $blockContext,
];
if ('private'=== $blockContext->getSetting('cache_policy')) {
return $this->renderPrivateResponse($blockContext->getTemplate(), $responseSettings, $response);
}
return $this->renderResponse($blockContext->getTemplate(), $responseSettings, $response);
}
public function buildEditForm(FormMapper $form, BlockInterface $block)
{
$form->add('settings', ImmutableArrayType::class, ['keys'=> $this->getFormSettingsKeys(),'translation_domain'=>'SonataBlockBundle',
]);
}
public function validateBlock(ErrorElement $errorElement, BlockInterface $block)
{
if (($name = $block->getSetting('menu_name')) &&''!== $name && !$this->menuProvider->has($name)) {
$errorElement->with('menu_name')
->addViolation('sonata.block.menu.not_existing', ['%name%'=> $name])
->end();
}
}
public function configureSettings(OptionsResolver $resolver)
{
$resolver->setDefaults(['title'=> $this->getName(),'cache_policy'=>'public','template'=>'@SonataBlock/Block/block_core_menu.html.twig','menu_name'=>'','safe_labels'=> false,'current_class'=>'active','first_class'=> false,'last_class'=> false,'current_uri'=> null,'menu_class'=>'list-group','children_class'=>'list-group-item','menu_template'=> null,
]);
}
public function getBlockMetadata($code = null)
{
return new Metadata($this->getName(), (null !== $code ? $code : $this->getName()), false,'SonataBlockBundle', ['class'=>'fa fa-bars',
]);
}
protected function getFormSettingsKeys()
{
$choiceOptions = ['required'=> false,'label'=>'form.label_url','choice_translation_domain'=>'SonataBlockBundle',
];
if (method_exists(FormTypeInterface::class,'setDefaultOptions')) {
$choiceOptions['choices_as_values'] = true;
}
$choiceOptions['choices'] = array_flip($this->menuRegistry->getAliasNames());
return [
['title', TextType::class, ['required'=> false,'label'=>'form.label_title',
]],
['cache_policy', ChoiceType::class, ['label'=>'form.label_cache_policy','choices'=> ['public','private'],
]],
['menu_name', ChoiceType::class, $choiceOptions],
['safe_labels', CheckboxType::class, ['required'=> false,'label'=>'form.label_safe_labels',
]],
['current_class', TextType::class, ['required'=> false,'label'=>'form.label_current_class',
]],
['first_class', TextType::class, ['required'=> false,'label'=>'form.label_first_class',
]],
['last_class', TextType::class, ['required'=> false,'label'=>'form.label_last_class',
]],
['menu_class', TextType::class, ['required'=> false,'label'=>'form.label_menu_class',
]],
['children_class', TextType::class, ['required'=> false,'label'=>'form.label_children_class',
]],
['menu_template', TextType::class, ['required'=> false,'label'=>'form.label_menu_template',
]],
];
}
protected function getMenu(BlockContextInterface $blockContext)
{
$settings = $blockContext->getSettings();
return $settings['menu_name'];
}
protected function getMenuOptions(array $settings)
{
$mapping = ['current_class'=>'currentClass','first_class'=>'firstClass','last_class'=>'lastClass','safe_labels'=>'allow_safe_labels','menu_template'=>'template',
];
$options = [];
foreach ($settings as $key => $value) {
if (array_key_exists($key, $mapping) && null !== $value) {
$options[$mapping[$key]] = $value;
}
}
return $options;
}
}
}
namespace Sonata\BlockBundle\Block\Service
{
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\BlockBundle\Block\BlockContextInterface;
use Sonata\BlockBundle\Model\BlockInterface;
use Sonata\CoreBundle\Form\Type\ImmutableArrayType;
use Sonata\CoreBundle\Model\Metadata;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolver;
class TextBlockService extends AbstractAdminBlockService
{
public function execute(BlockContextInterface $blockContext, Response $response = null)
{
return $this->renderResponse($blockContext->getTemplate(), ['block'=> $blockContext->getBlock(),'settings'=> $blockContext->getSettings(),
], $response);
}
public function buildEditForm(FormMapper $formMapper, BlockInterface $block)
{
$formMapper->add('settings', ImmutableArrayType::class, ['keys'=> [
['content', TextareaType::class, ['label'=>'form.label_content',
]],
],'translation_domain'=>'SonataBlockBundle',
]);
}
public function configureSettings(OptionsResolver $resolver)
{
$resolver->setDefaults(['content'=>'Insert your custom content here','template'=>'@SonataBlock/Block/block_core_text.html.twig',
]);
}
public function getBlockMetadata($code = null)
{
return new Metadata($this->getName(), (null !== $code ? $code : $this->getName()), false,'SonataBlockBundle', ['class'=>'fa fa-file-text-o',
]);
}
}
}
namespace Sonata\BlockBundle\Exception
{
interface BlockExceptionInterface
{
}
}
namespace Symfony\Component\HttpKernel\Exception
{
interface HttpExceptionInterface
{
public function getStatusCode();
public function getHeaders();
}
}
namespace Symfony\Component\HttpKernel\Exception
{
class HttpException extends \RuntimeException implements HttpExceptionInterface
{
private $statusCode;
private $headers;
public function __construct($statusCode, $message = null, \Exception $previous = null, array $headers = array(), $code = 0)
{
$this->statusCode = $statusCode;
$this->headers = $headers;
parent::__construct($message, $code, $previous);
}
public function getStatusCode()
{
return $this->statusCode;
}
public function getHeaders()
{
return $this->headers;
}
}
}
namespace Symfony\Component\HttpKernel\Exception
{
class NotFoundHttpException extends HttpException
{
public function __construct($message = null, \Exception $previous = null, $code = 0)
{
parent::__construct(404, $message, $previous, array(), $code);
}
}
}
namespace Sonata\BlockBundle\Exception
{
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
class BlockNotFoundException extends NotFoundHttpException
{
}
}
namespace Sonata\BlockBundle\Exception\Filter
{
use Sonata\BlockBundle\Model\BlockInterface;
interface FilterInterface
{
public function handle(\Exception $exception, BlockInterface $block);
}
}
namespace Sonata\BlockBundle\Exception\Filter
{
use Sonata\BlockBundle\Model\BlockInterface;
class DebugOnlyFilter implements FilterInterface
{
protected $debug;
public function __construct($debug)
{
$this->debug = $debug;
}
public function handle(\Exception $exception, BlockInterface $block)
{
return $this->debug ? true : false;
}
}
}
namespace Sonata\BlockBundle\Exception\Filter
{
use Sonata\BlockBundle\Model\BlockInterface;
class IgnoreClassFilter implements FilterInterface
{
protected $class;
public function __construct($class)
{
$this->class = $class;
}
public function handle(\Exception $exception, BlockInterface $block)
{
return !$exception instanceof $this->class;
}
}
}
namespace Sonata\BlockBundle\Exception\Filter
{
use Sonata\BlockBundle\Model\BlockInterface;
class KeepAllFilter implements FilterInterface
{
public function handle(\Exception $exception, BlockInterface $block)
{
return true;
}
}
}
namespace Sonata\BlockBundle\Exception\Filter
{
use Sonata\BlockBundle\Model\BlockInterface;
class KeepNoneFilter implements FilterInterface
{
public function handle(\Exception $exception, BlockInterface $block)
{
return false;
}
}
}
namespace Sonata\BlockBundle\Exception\Renderer
{
use Sonata\BlockBundle\Model\BlockInterface;
use Symfony\Component\HttpFoundation\Response;
interface RendererInterface
{
public function render(\Exception $exception, BlockInterface $block, Response $response = null);
}
}
namespace Sonata\BlockBundle\Exception\Renderer
{
use Sonata\BlockBundle\Model\BlockInterface;
use Symfony\Component\Debug\Exception\FlattenException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Templating\EngineInterface;
class InlineDebugRenderer implements RendererInterface
{
protected $templating;
protected $template;
protected $forceStyle;
protected $debug;
public function __construct(EngineInterface $templating, $template, $debug, $forceStyle = true)
{
$this->templating = $templating;
$this->template = $template;
$this->debug = $debug;
$this->forceStyle = $forceStyle;
}
public function render(\Exception $exception, BlockInterface $block, Response $response = null)
{
$response = $response ?: new Response();
if (!$this->debug) {
return $response;
}
$flattenException = FlattenException::create($exception);
$code = $flattenException->getStatusCode();
$parameters = ['exception'=> $flattenException,'status_code'=> $code,'status_text'=> isset(Response::$statusTexts[$code]) ? Response::$statusTexts[$code] :'','logger'=> false,'currentContent'=> false,'block'=> $block,'forceStyle'=> $this->forceStyle,
];
$content = $this->templating->render($this->template, $parameters);
$response->setContent($content);
return $response;
}
}
}
namespace Sonata\BlockBundle\Exception\Renderer
{
use Sonata\BlockBundle\Model\BlockInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Templating\EngineInterface;
class InlineRenderer implements RendererInterface
{
protected $templating;
protected $template;
public function __construct(EngineInterface $templating, $template)
{
$this->templating = $templating;
$this->template = $template;
}
public function render(\Exception $exception, BlockInterface $block, Response $response = null)
{
$parameters = ['exception'=> $exception,'block'=> $block,
];
$content = $this->templating->render($this->template, $parameters);
$response = $response ?: new Response();
$response->setContent($content);
return $response;
}
}
}
namespace Sonata\BlockBundle\Exception\Renderer
{
use Sonata\BlockBundle\Model\BlockInterface;
use Symfony\Component\HttpFoundation\Response;
class MonkeyThrowRenderer implements RendererInterface
{
public function render(\Exception $banana, BlockInterface $block, Response $response = null)
{
throw $banana;
}
}
}
namespace Sonata\BlockBundle\Exception\Strategy
{
use Sonata\BlockBundle\Model\BlockInterface;
use Symfony\Component\HttpFoundation\Response;
interface StrategyManagerInterface
{
public function handleException(\Exception $exception, BlockInterface $block, Response $response = null);
}
}
namespace Sonata\BlockBundle\Exception\Strategy
{
use Sonata\BlockBundle\Exception\Filter\FilterInterface;
use Sonata\BlockBundle\Exception\Renderer\RendererInterface;
use Sonata\BlockBundle\Model\BlockInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;
class StrategyManager implements StrategyManagerInterface
{
protected $container;
protected $filters;
protected $renderers;
protected $blockFilters;
protected $blockRenderers;
protected $defaultFilter;
protected $defaultRenderer;
public function __construct(ContainerInterface $container, array $filters, array $renderers, array $blockFilters, array $blockRenderers)
{
$this->container = $container;
$this->filters = $filters;
$this->renderers = $renderers;
$this->blockFilters = $blockFilters;
$this->blockRenderers = $blockRenderers;
}
public function setDefaultFilter($name)
{
if (!array_key_exists($name, $this->filters)) {
throw new \InvalidArgumentException(sprintf('Cannot set default exception filter "%s". It does not exist.', $name));
}
$this->defaultFilter = $name;
}
public function setDefaultRenderer($name)
{
if (!array_key_exists($name, $this->renderers)) {
throw new \InvalidArgumentException(sprintf('Cannot set default exception renderer "%s". It does not exist.', $name));
}
$this->defaultRenderer = $name;
}
public function handleException(\Exception $exception, BlockInterface $block, Response $response = null)
{
$response = $response ?: new Response();
$response->setPrivate();
$filter = $this->getBlockFilter($block);
if ($filter->handle($exception, $block)) {
$renderer = $this->getBlockRenderer($block);
$response = $renderer->render($exception, $block, $response);
}
return $response;
}
public function getBlockRenderer(BlockInterface $block)
{
$type = $block->getType();
$name = isset($this->blockRenderers[$type]) ? $this->blockRenderers[$type] : $this->defaultRenderer;
$service = $this->getRendererService($name);
if (!$service instanceof RendererInterface) {
throw new \RuntimeException(sprintf('The service "%s" is not an exception renderer', $name));
}
return $service;
}
public function getBlockFilter(BlockInterface $block)
{
$type = $block->getType();
$name = isset($this->blockFilters[$type]) ? $this->blockFilters[$type] : $this->defaultFilter;
$service = $this->getFilterService($name);
if (!$service instanceof FilterInterface) {
throw new \RuntimeException(sprintf('The service "%s" is not an exception filter', $name));
}
return $service;
}
protected function getFilterService($name)
{
if (!isset($this->filters[$name])) {
throw new \RuntimeException('The filter "%s" does not exist.');
}
return $this->container->get($this->filters[$name]);
}
protected function getRendererService($name)
{
if (!isset($this->renderers[$name])) {
throw new \RuntimeException('The renderer "%s" does not exist.');
}
return $this->container->get($this->renderers[$name]);
}
}
}
namespace Sonata\BlockBundle\Form\Type
{
use Sonata\BlockBundle\Block\BlockServiceManagerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;
class ServiceListType extends AbstractType
{
protected $manager;
public function __construct(BlockServiceManagerInterface $manager)
{
$this->manager = $manager;
}
public function getBlockPrefix()
{
return'sonata_block_service_choice';
}
public function getName()
{
return $this->getBlockPrefix();
}
public function getParent()
{
return ChoiceType::class;
}
public function configureOptions(OptionsResolver $resolver)
{
$manager = $this->manager;
$resolver->setRequired(['context',
]);
$resolver->setDefaults(['multiple'=> false,'expanded'=> false,'choices'=> function (Options $options, $previousValue) use ($manager) {
$types = [];
foreach ($manager->getServicesByContext($options['context'], $options['include_containers']) as $code => $service) {
$types[$code] = sprintf('%s - %s', $service->getName(), $code);
}
return $types;
},'preferred_choices'=> [],'empty_data'=> function (Options $options) {
$multiple = isset($options['multiple']) && $options['multiple'];
$expanded = isset($options['expanded']) && $options['expanded'];
return $multiple || $expanded ? [] :'';
},'empty_value'=> function (Options $options, $previousValue) {
$multiple = isset($options['multiple']) && $options['multiple'];
$expanded = isset($options['expanded']) && $options['expanded'];
return $multiple || $expanded || !isset($previousValue) ? null :'';
},'error_bubbling'=> false,'include_containers'=> false,
]);
}
}
}
namespace Sonata\BlockBundle\Model
{
interface BlockInterface
{
public function setId($id);
public function getId();
public function setName($name);
public function getName();
public function setType($type);
public function getType();
public function setEnabled($enabled);
public function getEnabled();
public function setPosition($position);
public function getPosition();
public function setCreatedAt(\DateTime $createdAt = null);
public function getCreatedAt();
public function setUpdatedAt(\DateTime $updatedAt = null);
public function getUpdatedAt();
public function getTtl();
public function setSettings(array $settings = []);
public function getSettings();
public function setSetting($name, $value);
public function getSetting($name, $default = null);
public function addChildren(self $children);
public function getChildren();
public function hasChildren();
public function setParent(self $parent = null);
public function getParent();
public function hasParent();
}
}
namespace Sonata\BlockBundle\Model
{
abstract class BaseBlock implements BlockInterface
{
protected $name;
protected $settings;
protected $enabled;
protected $position;
protected $parent;
protected $children;
protected $createdAt;
protected $updatedAt;
protected $type;
protected $ttl;
public function __construct()
{
$this->settings = [];
$this->enabled = false;
$this->children = [];
}
public function __toString()
{
return sprintf('%s ~ #%s', $this->getName(), $this->getId());
}
public function setName($name)
{
$this->name = $name;
}
public function getName()
{
return $this->name;
}
public function setType($type)
{
$this->type = $type;
}
public function getType()
{
return $this->type;
}
public function setSettings(array $settings = [])
{
$this->settings = $settings;
}
public function getSettings()
{
return $this->settings;
}
public function setSetting($name, $value)
{
$this->settings[$name] = $value;
}
public function getSetting($name, $default = null)
{
return isset($this->settings[$name]) ? $this->settings[$name] : $default;
}
public function setEnabled($enabled)
{
$this->enabled = $enabled;
}
public function getEnabled()
{
return $this->enabled;
}
public function setPosition($position)
{
$this->position = $position;
}
public function getPosition()
{
return $this->position;
}
public function setCreatedAt(\DateTime $createdAt = null)
{
$this->createdAt = $createdAt;
}
public function getCreatedAt()
{
return $this->createdAt;
}
public function setUpdatedAt(\DateTime $updatedAt = null)
{
$this->updatedAt = $updatedAt;
}
public function getUpdatedAt()
{
return $this->updatedAt;
}
public function addChildren(BlockInterface $child)
{
$this->children[] = $child;
$child->setParent($this);
}
public function getChildren()
{
return $this->children;
}
public function setParent(BlockInterface $parent = null)
{
$this->parent = $parent;
}
public function getParent()
{
return $this->parent;
}
public function hasParent()
{
return $this->getParent() instanceof self;
}
public function getTtl()
{
if (!$this->getSetting('use_cache', true)) {
return 0;
}
$ttl = $this->getSetting('ttl', 86400);
foreach ($this->getChildren() as $block) {
$blockTtl = $block->getTtl();
$ttl = ($blockTtl < $ttl) ? $blockTtl : $ttl;
}
$this->ttl = $ttl;
return $this->ttl;
}
public function hasChildren()
{
return count($this->children) > 0;
}
}
}
namespace Sonata\BlockBundle\Model
{
class Block extends BaseBlock
{
protected $id;
public function setId($id)
{
$this->id = $id;
}
public function getId()
{
return $this->id;
}
}
}
namespace Sonata\CoreBundle\Model
{
use Doctrine\DBAL\Connection;
interface ManagerInterface
{
public function getClass();
public function findAll();
public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null);
public function findOneBy(array $criteria, array $orderBy = null);
public function find($id);
public function create();
public function save($entity, $andFlush = true);
public function delete($entity, $andFlush = true);
public function getTableName();
public function getConnection();
}
}
namespace Sonata\CoreBundle\Model
{
use Sonata\DatagridBundle\Pager\PagerInterface;
interface PageableManagerInterface
{
public function getPager(array $criteria, $page, $limit = 10, array $sort = []);
}
}
namespace Sonata\BlockBundle\Model
{
use Sonata\CoreBundle\Model\ManagerInterface;
use Sonata\CoreBundle\Model\PageableManagerInterface;
interface BlockManagerInterface extends ManagerInterface, PageableManagerInterface
{
}
}
namespace Sonata\BlockBundle\Model
{
class EmptyBlock extends Block
{
}
}
namespace Sonata\BlockBundle\Twig\Extension
{
use Sonata\BlockBundle\Templating\Helper\BlockHelper;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
class BlockExtension extends AbstractExtension
{
protected $blockHelper;
public function __construct(BlockHelper $blockHelper)
{
$this->blockHelper = $blockHelper;
}
public function getFunctions()
{
return [
new TwigFunction('sonata_block_exists',
[$this->blockHelper,'exists']
),
new TwigFunction('sonata_block_render',
[$this->blockHelper,'render'],
['is_safe'=> ['html']]
),
new TwigFunction('sonata_block_render_event',
[$this->blockHelper,'renderEvent'],
['is_safe'=> ['html']]
),
new TwigFunction('sonata_block_include_javascripts',
[$this->blockHelper,'includeJavascripts'],
['is_safe'=> ['html']]
),
new TwigFunction('sonata_block_include_stylesheets',
[$this->blockHelper,'includeStylesheets'],
['is_safe'=> ['html']]
),
];
}
public function getName()
{
return'sonata_block';
}
}
}
namespace Sonata\BlockBundle\Twig
{
class GlobalVariables
{
protected $templates;
public function __construct(array $templates)
{
$this->templates = $templates;
}
public function getTemplates()
{
return $this->templates;
}
}
}
namespace Sonata\AdminBundle\Admin
{
interface AccessRegistryInterface
{
public function getAccessMapping();
public function checkAccess($action, $object = null);
}
}
namespace Sonata\AdminBundle\Admin
{
interface FieldDescriptionRegistryInterface
{
public function getFormFieldDescription($name);
public function getFormFieldDescriptions();
public function hasShowFieldDescription($name);
public function addShowFieldDescription($name, FieldDescriptionInterface $fieldDescription);
public function removeShowFieldDescription($name);
public function addListFieldDescription($name, FieldDescriptionInterface $fieldDescription);
public function removeListFieldDescription($name);
public function getList();
public function hasFilterFieldDescription($name);
public function addFilterFieldDescription($name, FieldDescriptionInterface $fieldDescription);
public function removeFilterFieldDescription($name);
public function getFilterFieldDescriptions();
public function getFilterFieldDescription($name);
}
}
namespace Sonata\AdminBundle\Admin
{
interface LifecycleHookProviderInterface
{
public function update($object);
public function create($object);
public function delete($object);
public function preUpdate($object);
public function postUpdate($object);
public function prePersist($object);
public function postPersist($object);
public function preRemove($object);
public function postRemove($object);
}
}
namespace Sonata\AdminBundle\Admin
{
use Knp\Menu\ItemInterface;
interface MenuBuilderInterface
{
public function buildSideMenu($action, AdminInterface $childAdmin = null);
public function buildTabMenu($action, AdminInterface $childAdmin = null);
}
}
namespace Sonata\AdminBundle\Admin
{
interface ParentAdminInterface
{
public function addChild(AdminInterface $child);
public function hasChild($code);
public function getChildren();
public function getChild($code);
}
}
namespace Sonata\AdminBundle\Admin
{
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Route\RouteGeneratorInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface as RoutingUrlGeneratorInterface;
interface UrlGeneratorInterface
{
public function getRoutes();
public function getRouterIdParameter();
public function setRouteGenerator(RouteGeneratorInterface $routeGenerator);
public function generateObjectUrl(
$name,
$object,
array $parameters = [],
$absolute = RoutingUrlGeneratorInterface::ABSOLUTE_PATH
);
public function generateUrl($name, array $parameters = [], $absolute = RoutingUrlGeneratorInterface::ABSOLUTE_PATH);
public function generateMenuUrl($name, array $parameters = [], $absolute = RoutingUrlGeneratorInterface::ABSOLUTE_PATH);
public function getUrlsafeIdentifier($entity);
}
}
namespace Sonata\AdminBundle\Admin
{
use Knp\Menu\FactoryInterface as MenuFactoryInterface;
use Sonata\AdminBundle\Builder\DatagridBuilderInterface;
use Sonata\AdminBundle\Builder\FormContractorInterface;
use Sonata\AdminBundle\Builder\ListBuilderInterface;
use Sonata\AdminBundle\Builder\RouteBuilderInterface;
use Sonata\AdminBundle\Datagrid\ProxyQueryInterface;
use Sonata\AdminBundle\Security\Handler\SecurityHandlerInterface;
use Sonata\AdminBundle\Translator\LabelTranslatorStrategyInterface;
use Sonata\CoreBundle\Model\Metadata;
use Sonata\CoreBundle\Validator\ErrorElement;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Translation\TranslatorInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
interface AdminInterface extends AccessRegistryInterface, FieldDescriptionRegistryInterface, LifecycleHookProviderInterface, MenuBuilderInterface, ParentAdminInterface, UrlGeneratorInterface
{
public function setMenuFactory(MenuFactoryInterface $menuFactory);
public function getMenuFactory();
public function setFormContractor(FormContractorInterface $formContractor);
public function setListBuilder(ListBuilderInterface $listBuilder);
public function getListBuilder();
public function setDatagridBuilder(DatagridBuilderInterface $datagridBuilder);
public function getDatagridBuilder();
public function setTranslator(TranslatorInterface $translator);
public function getTranslator();
public function setRequest(Request $request);
public function setConfigurationPool(Pool $pool);
public function getClass();
public function attachAdminClass(FieldDescriptionInterface $fieldDescription);
public function getDatagrid();
public function setBaseControllerName($baseControllerName);
public function getBaseControllerName();
public function getModelManager();
public function getManagerType();
public function createQuery($context ='list');
public function getFormBuilder();
public function getForm();
public function getRequest();
public function hasRequest();
public function getCode();
public function getBaseCodeRoute();
public function getSecurityInformation();
public function setParentFieldDescription(FieldDescriptionInterface $parentFieldDescription);
public function getParentFieldDescription();
public function hasParentFieldDescription();
public function trans($id, array $parameters = [], $domain = null, $locale = null);
public function getIdParameter();
public function hasRoute($name);
public function setSecurityHandler(SecurityHandlerInterface $securityHandler);
public function getSecurityHandler();
public function isGranted($name, $object = null);
public function getNormalizedIdentifier($entity);
public function id($entity);
public function setValidator($validator);
public function getValidator();
public function getShow();
public function setFormTheme(array $formTheme);
public function getFormTheme();
public function setFilterTheme(array $filterTheme);
public function getFilterTheme();
public function addExtension(AdminExtensionInterface $extension);
public function getExtensions();
public function setRouteBuilder(RouteBuilderInterface $routeBuilder);
public function getRouteBuilder();
public function toString($object);
public function setLabelTranslatorStrategy(LabelTranslatorStrategyInterface $labelTranslatorStrategy);
public function getLabelTranslatorStrategy();
public function supportsPreviewMode();
public function getNewInstance();
public function setUniqid($uniqId);
public function getUniqid();
public function getObject($id);
public function setSubject($subject);
public function getSubject();
public function getListFieldDescription($name);
public function hasListFieldDescription($name);
public function getListFieldDescriptions();
public function getExportFormats();
public function getDataSourceIterator();
public function configure();
public function preBatchAction($actionName, ProxyQueryInterface $query, array &$idx, $allElements);
public function getFilterParameters();
public function hasSubject();
public function validate(ErrorElement $errorElement, $object);
public function showIn($context);
public function createObjectSecurity($object);
public function getParent();
public function setParent(self $admin);
public function isChild();
public function getTemplate($name);
public function setTranslationDomain($translationDomain);
public function getTranslationDomain();
public function getFormGroups();
public function setFormGroups(array $formGroups);
public function getFormTabs();
public function setFormTabs(array $formTabs);
public function getShowTabs();
public function setShowTabs(array $showTabs);
public function removeFieldFromFormGroup($key);
public function getShowGroups();
public function setShowGroups(array $showGroups);
public function reorderShowGroup($group, array $keys);
public function addFormFieldDescription($name, FieldDescriptionInterface $fieldDescription);
public function removeFormFieldDescription($name);
public function isAclEnabled();
public function setSubClasses(array $subClasses);
public function hasSubClass($name);
public function hasActiveSubClass();
public function getActiveSubClass();
public function getActiveSubclassCode();
public function getBatchActions();
public function getLabel();
public function getPersistentParameters();
public function getBreadcrumbs($action);
public function setCurrentChild($currentChild);
public function getCurrentChild();
public function getTranslationLabel($label, $context ='', $type ='');
public function getObjectMetadata($object);
public function getListModes();
public function setListMode($mode);
public function getListMode();
}
}
namespace Symfony\Component\Security\Acl\Model
{
interface DomainObjectInterface
{
public function getObjectIdentifier();
}
}
namespace Sonata\AdminBundle\Admin
{
interface AdminTreeInterface
{
public function getRootAncestor();
public function getChildDepth();
public function getCurrentLeafChildAdmin();
}
}
namespace Sonata\AdminBundle\Admin
{
use Doctrine\Common\Util\ClassUtils;
use Knp\Menu\FactoryInterface as MenuFactoryInterface;
use Knp\Menu\ItemInterface;
use Knp\Menu\ItemInterface as MenuItemInterface;
use Sonata\AdminBundle\Builder\DatagridBuilderInterface;
use Sonata\AdminBundle\Builder\FormContractorInterface;
use Sonata\AdminBundle\Builder\ListBuilderInterface;
use Sonata\AdminBundle\Builder\RouteBuilderInterface;
use Sonata\AdminBundle\Builder\ShowBuilderInterface;
use Sonata\AdminBundle\Datagrid\DatagridInterface;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\Pager;
use Sonata\AdminBundle\Datagrid\ProxyQueryInterface;
use Sonata\AdminBundle\Filter\Persister\FilterPersisterInterface;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelHiddenType;
use Sonata\AdminBundle\Model\ModelManagerInterface;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Route\RouteGeneratorInterface;
use Sonata\AdminBundle\Security\Handler\AclSecurityHandlerInterface;
use Sonata\AdminBundle\Security\Handler\SecurityHandlerInterface;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Templating\MutableTemplateRegistryInterface;
use Sonata\AdminBundle\Translator\LabelTranslatorStrategyInterface;
use Sonata\CoreBundle\Model\Metadata;
use Sonata\CoreBundle\Validator\Constraints\InlineConstraint;
use Sonata\CoreBundle\Validator\ErrorElement;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PropertyAccess\PropertyPath;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface as RoutingUrlGeneratorInterface;
use Symfony\Component\Security\Acl\Model\DomainObjectInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Translation\TranslatorInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
abstract class AbstractAdmin implements AdminInterface, DomainObjectInterface, AdminTreeInterface
{
const CONTEXT_MENU ='menu';
const CONTEXT_DASHBOARD ='dashboard';
const CLASS_REGEX ='@
        (?:([A-Za-z0-9]*)\\\)?        # vendor name / app name
        (Bundle\\\)?                  # optional bundle directory
        ([A-Za-z0-9]+?)(?:Bundle)?\\\ # bundle name, with optional suffix
        (
            Entity|Document|Model|PHPCR|CouchDocument|Phpcr|
            Doctrine\\\Orm|Doctrine\\\Phpcr|Doctrine\\\MongoDB|Doctrine\\\CouchDB
        )\\\(.*)@x';
const MOSAIC_ICON_CLASS ='fa fa-th-large fa-fw';
protected $listFieldDescriptions = [];
protected $showFieldDescriptions = [];
protected $formFieldDescriptions = [];
protected $filterFieldDescriptions = [];
protected $maxPerPage = 32;
protected $maxPageLinks = 25;
protected $baseRouteName;
protected $baseRoutePattern;
protected $baseControllerName;
protected $classnameLabel;
protected $translationDomain ='messages';
protected $formOptions = [];
protected $datagridValues = ['_page'=> 1,'_per_page'=> 32,
];
protected $perPageOptions = [16, 32, 64, 128, 256];
protected $pagerType = Pager::TYPE_DEFAULT;
protected $code;
protected $label;
protected $persistFilters = false;
protected $routes;
protected $subject;
protected $children = [];
protected $parent = null;
protected $baseCodeRoute ='';
protected $parentAssociationMapping = null;
protected $parentFieldDescription;
protected $currentChild = false;
protected $uniqid;
protected $modelManager;
protected $request;
protected $translator;
protected $formContractor;
protected $listBuilder;
protected $showBuilder;
protected $datagridBuilder;
protected $routeBuilder;
protected $datagrid;
protected $routeGenerator;
protected $breadcrumbs = [];
protected $securityHandler = null;
protected $validator = null;
protected $configurationPool;
protected $menu;
protected $menuFactory;
protected $loaded = ['view_fields'=> false,'view_groups'=> false,'routes'=> false,'tab_menu'=> false,
];
protected $formTheme = [];
protected $filterTheme = [];
protected $templates = [];
protected $extensions = [];
protected $labelTranslatorStrategy;
protected $supportsPreviewMode = false;
protected $securityInformation = [];
protected $cacheIsGranted = [];
protected $searchResultActions = ['edit','show'];
protected $listModes = ['list'=> ['class'=>'fa fa-list fa-fw',
],'mosaic'=> ['class'=> self::MOSAIC_ICON_CLASS,
],
];
protected $accessMapping = [];
private $templateRegistry;
private $class;
private $subClasses = [];
private $list;
private $show;
private $form;
private $filter;
private $cachedBaseRouteName;
private $cachedBaseRoutePattern;
private $formGroups = false;
private $formTabs = false;
private $showGroups = false;
private $showTabs = false;
private $managerType;
private $breadcrumbsBuilder;
private $filterPersister;
public function __construct($code, $class, $baseControllerName)
{
$this->code = $code;
$this->class = $class;
$this->baseControllerName = $baseControllerName;
$this->predefinePerPageOptions();
$this->datagridValues['_per_page'] = $this->maxPerPage;
}
public function getExportFormats()
{
return ['json','xml','csv','xls',
];
}
public function getExportFields()
{
$fields = $this->getModelManager()->getExportFields($this->getClass());
foreach ($this->getExtensions() as $extension) {
if (method_exists($extension,'configureExportFields')) {
$fields = $extension->configureExportFields($this, $fields);
}
}
return $fields;
}
public function getDataSourceIterator()
{
$datagrid = $this->getDatagrid();
$datagrid->buildPager();
$fields = [];
foreach ($this->getExportFields() as $key => $field) {
$label = $this->getTranslationLabel($field,'export','label');
$transLabel = $this->trans($label);
if ($transLabel == $label) {
$fields[$key] = $field;
} else {
$fields[$transLabel] = $field;
}
}
return $this->getModelManager()->getDataSourceIterator($datagrid, $fields);
}
public function validate(ErrorElement $errorElement, $object)
{
}
public function initialize()
{
if (!$this->classnameLabel) {
$this->classnameLabel = substr($this->getClass(), strrpos($this->getClass(),'\\') + 1);
}
$this->baseCodeRoute = $this->getCode();
$this->configure();
}
public function configure()
{
}
public function update($object)
{
$this->preUpdate($object);
foreach ($this->extensions as $extension) {
$extension->preUpdate($this, $object);
}
$result = $this->getModelManager()->update($object);
if (null !== $result) {
$object = $result;
}
$this->postUpdate($object);
foreach ($this->extensions as $extension) {
$extension->postUpdate($this, $object);
}
return $object;
}
public function create($object)
{
$this->prePersist($object);
foreach ($this->extensions as $extension) {
$extension->prePersist($this, $object);
}
$result = $this->getModelManager()->create($object);
if (null !== $result) {
$object = $result;
}
$this->postPersist($object);
foreach ($this->extensions as $extension) {
$extension->postPersist($this, $object);
}
$this->createObjectSecurity($object);
return $object;
}
public function delete($object)
{
$this->preRemove($object);
foreach ($this->extensions as $extension) {
$extension->preRemove($this, $object);
}
$this->getSecurityHandler()->deleteObjectSecurity($this, $object);
$this->getModelManager()->delete($object);
$this->postRemove($object);
foreach ($this->extensions as $extension) {
$extension->postRemove($this, $object);
}
}
public function preValidate($object)
{
}
public function preUpdate($object)
{
}
public function postUpdate($object)
{
}
public function prePersist($object)
{
}
public function postPersist($object)
{
}
public function preRemove($object)
{
}
public function postRemove($object)
{
}
public function preBatchAction($actionName, ProxyQueryInterface $query, array &$idx, $allElements)
{
}
public function getFilterParameters()
{
$parameters = [];
if ($this->hasRequest()) {
$filters = $this->request->query->get('filter', []);
if (false !== $this->persistFilters && null !== $this->filterPersister) {
if ('reset'=== $this->request->query->get('filters')) {
$this->filterPersister->reset($this->getCode());
}
if (empty($filters)) {
$filters = $this->filterPersister->get($this->getCode());
} else {
$this->filterPersister->set($this->getCode(), $filters);
}
}
$parameters = array_merge(
$this->getModelManager()->getDefaultSortValues($this->getClass()),
$this->datagridValues,
$this->getDefaultFilterValues(),
$filters
);
if (!$this->determinedPerPageValue($parameters['_per_page'])) {
$parameters['_per_page'] = $this->maxPerPage;
}
if ($this->isChild() && $this->getParentAssociationMapping()) {
$name = str_replace('.','__', $this->getParentAssociationMapping());
$parameters[$name] = ['value'=> $this->request->get($this->getParent()->getIdParameter())];
}
}
return $parameters;
}
public function buildDatagrid()
{
if ($this->datagrid) {
return;
}
$filterParameters = $this->getFilterParameters();
if (isset($filterParameters['_sort_by']) && \is_string($filterParameters['_sort_by'])) {
if ($this->hasListFieldDescription($filterParameters['_sort_by'])) {
$filterParameters['_sort_by'] = $this->getListFieldDescription($filterParameters['_sort_by']);
} else {
$filterParameters['_sort_by'] = $this->getModelManager()->getNewFieldDescriptionInstance(
$this->getClass(),
$filterParameters['_sort_by'],
[]
);
$this->getListBuilder()->buildField(null, $filterParameters['_sort_by'], $this);
}
}
$this->datagrid = $this->getDatagridBuilder()->getBaseDatagrid($this, $filterParameters);
$this->datagrid->getPager()->setMaxPageLinks($this->maxPageLinks);
$mapper = new DatagridMapper($this->getDatagridBuilder(), $this->datagrid, $this);
$this->configureDatagridFilters($mapper);
if ($this->isChild() && $this->getParentAssociationMapping() && !$mapper->has($this->getParentAssociationMapping())) {
$mapper->add($this->getParentAssociationMapping(), null, ['show_filter'=> false,'label'=> false,'field_type'=> ModelHiddenType::class,'field_options'=> ['model_manager'=> $this->getModelManager(),
],'operator_type'=> HiddenType::class,
], null, null, ['admin_code'=> $this->getParent()->getCode(),
]);
}
foreach ($this->getExtensions() as $extension) {
$extension->configureDatagridFilters($mapper);
}
}
public function getParentAssociationMapping()
{
if (\is_array($this->parentAssociationMapping) && $this->getParent()) {
$parent = $this->getParent()->getCode();
if (array_key_exists($parent, $this->parentAssociationMapping)) {
return $this->parentAssociationMapping[$parent];
}
throw new \InvalidArgumentException(sprintf("There's no association between %s and %s.",
$this->getCode(),
$this->getParent()->getCode()
));
}
return $this->parentAssociationMapping;
}
final public function addParentAssociationMapping($code, $value)
{
$this->parentAssociationMapping[$code] = $value;
}
public function getBaseRoutePattern()
{
if (null !== $this->cachedBaseRoutePattern) {
return $this->cachedBaseRoutePattern;
}
if ($this->isChild()) { $baseRoutePattern = $this->baseRoutePattern;
if (!$this->baseRoutePattern) {
preg_match(self::CLASS_REGEX, $this->class, $matches);
if (!$matches) {
throw new \RuntimeException(sprintf('Please define a default `baseRoutePattern` value for the admin class `%s`', \get_class($this)));
}
$baseRoutePattern = $this->urlize($matches[5],'-');
}
$this->cachedBaseRoutePattern = sprintf('%s/%s/%s',
$this->getParent()->getBaseRoutePattern(),
$this->getParent()->getRouterIdParameter(),
$baseRoutePattern
);
} elseif ($this->baseRoutePattern) {
$this->cachedBaseRoutePattern = $this->baseRoutePattern;
} else {
preg_match(self::CLASS_REGEX, $this->class, $matches);
if (!$matches) {
throw new \RuntimeException(sprintf('Please define a default `baseRoutePattern` value for the admin class `%s`', \get_class($this)));
}
$this->cachedBaseRoutePattern = sprintf('/%s%s/%s',
empty($matches[1]) ?'': $this->urlize($matches[1],'-').'/',
$this->urlize($matches[3],'-'),
$this->urlize($matches[5],'-')
);
}
return $this->cachedBaseRoutePattern;
}
public function getBaseRouteName()
{
if (null !== $this->cachedBaseRouteName) {
return $this->cachedBaseRouteName;
}
if ($this->isChild()) { $baseRouteName = $this->baseRouteName;
if (!$this->baseRouteName) {
preg_match(self::CLASS_REGEX, $this->class, $matches);
if (!$matches) {
throw new \RuntimeException(sprintf('Cannot automatically determine base route name, please define a default `baseRouteName` value for the admin class `%s`', \get_class($this)));
}
$baseRouteName = $this->urlize($matches[5]);
}
$this->cachedBaseRouteName = sprintf('%s_%s',
$this->getParent()->getBaseRouteName(),
$baseRouteName
);
} elseif ($this->baseRouteName) {
$this->cachedBaseRouteName = $this->baseRouteName;
} else {
preg_match(self::CLASS_REGEX, $this->class, $matches);
if (!$matches) {
throw new \RuntimeException(sprintf('Cannot automatically determine base route name, please define a default `baseRouteName` value for the admin class `%s`', \get_class($this)));
}
$this->cachedBaseRouteName = sprintf('admin_%s%s_%s',
empty($matches[1]) ?'': $this->urlize($matches[1]).'_',
$this->urlize($matches[3]),
$this->urlize($matches[5])
);
}
return $this->cachedBaseRouteName;
}
public function urlize($word, $sep ='_')
{
return strtolower(preg_replace('/[^a-z0-9_]/i', $sep.'$1', $word));
}
public function getClass()
{
if ($this->hasActiveSubClass()) {
if ($this->getParentFieldDescription()) {
throw new \RuntimeException('Feature not implemented: an embedded admin cannot have subclass');
}
$subClass = $this->getRequest()->query->get('subclass');
if (!$this->hasSubClass($subClass)) {
throw new \RuntimeException(sprintf('Subclass "%s" is not defined.', $subClass));
}
return $this->getSubClass($subClass);
}
if ($this->subject && \is_object($this->subject)) {
return ClassUtils::getClass($this->subject);
}
return $this->class;
}
public function getSubClasses()
{
return $this->subClasses;
}
public function addSubClass($subClass)
{
@trigger_error(sprintf('Method "%s" is deprecated since 3.30 and will be removed in 4.0.',
__METHOD__
), E_USER_DEPRECATED);
if (!\in_array($subClass, $this->subClasses)) {
$this->subClasses[] = $subClass;
}
}
public function setSubClasses(array $subClasses)
{
$this->subClasses = $subClasses;
}
public function hasSubClass($name)
{
return isset($this->subClasses[$name]);
}
public function hasActiveSubClass()
{
if (\count($this->subClasses) > 0 && $this->request) {
return null !== $this->getRequest()->query->get('subclass');
}
return false;
}
public function getActiveSubClass()
{
if (!$this->hasActiveSubClass()) {
return;
}
return $this->getSubClass($this->getActiveSubclassCode());
}
public function getActiveSubclassCode()
{
if (!$this->hasActiveSubClass()) {
return;
}
$subClass = $this->getRequest()->query->get('subclass');
if (!$this->hasSubClass($subClass)) {
return;
}
return $subClass;
}
public function getBatchActions()
{
$actions = [];
if ($this->hasRoute('delete') && $this->hasAccess('delete')) {
$actions['delete'] = ['label'=>'action_delete','translation_domain'=>'SonataAdminBundle','ask_confirmation'=> true, ];
}
$actions = $this->configureBatchActions($actions);
foreach ($this->getExtensions() as $extension) {
if (method_exists($extension,'configureBatchActions')) {
$actions = $extension->configureBatchActions($this, $actions);
}
}
foreach ($actions as $name => &$action) {
if (!array_key_exists('label', $action)) {
$action['label'] = $this->getTranslationLabel($name,'batch','label');
}
if (!array_key_exists('translation_domain', $action)) {
$action['translation_domain'] = $this->getTranslationDomain();
}
}
return $actions;
}
public function getRoutes()
{
$this->buildRoutes();
return $this->routes;
}
public function getRouterIdParameter()
{
return'{'.$this->getIdParameter().'}';
}
public function getIdParameter()
{
$parameter ='id';
for ($i = 0; $i < $this->getChildDepth(); ++$i) {
$parameter ='child'.ucfirst($parameter);
}
return $parameter;
}
public function hasRoute($name)
{
if (!$this->routeGenerator) {
throw new \RuntimeException('RouteGenerator cannot be null');
}
return $this->routeGenerator->hasAdminRoute($this, $name);
}
public function isCurrentRoute($name, $adminCode = null)
{
if (!$this->hasRequest()) {
return false;
}
$request = $this->getRequest();
$route = $request->get('_route');
if ($adminCode) {
$admin = $this->getConfigurationPool()->getAdminByAdminCode($adminCode);
} else {
$admin = $this;
}
if (!$admin) {
return false;
}
return ($admin->getBaseRouteName().'_'.$name) == $route;
}
public function generateObjectUrl($name, $object, array $parameters = [], $absolute = RoutingUrlGeneratorInterface::ABSOLUTE_PATH)
{
$parameters['id'] = $this->getUrlsafeIdentifier($object);
return $this->generateUrl($name, $parameters, $absolute);
}
public function generateUrl($name, array $parameters = [], $absolute = RoutingUrlGeneratorInterface::ABSOLUTE_PATH)
{
return $this->routeGenerator->generateUrl($this, $name, $parameters, $absolute);
}
public function generateMenuUrl($name, array $parameters = [], $absolute = RoutingUrlGeneratorInterface::ABSOLUTE_PATH)
{
return $this->routeGenerator->generateMenuUrl($this, $name, $parameters, $absolute);
}
final public function setTemplateRegistry(MutableTemplateRegistryInterface $templateRegistry)
{
$this->templateRegistry = $templateRegistry;
}
public function setTemplates(array $templates)
{
$this->templates = $templates;
$this->getTemplateRegistry()->setTemplates($templates);
}
public function setTemplate($name, $template)
{
$this->templates[$name] = $template;
$this->getTemplateRegistry()->setTemplate($name, $template);
}
public function getTemplates()
{
return $this->getTemplateRegistry()->getTemplates();
}
public function getTemplate($name)
{
return $this->getTemplateRegistry()->getTemplate($name);
}
public function getNewInstance()
{
$object = $this->getModelManager()->getModelInstance($this->getClass());
foreach ($this->getExtensions() as $extension) {
$extension->alterNewInstance($this, $object);
}
return $object;
}
public function getFormBuilder()
{
$this->formOptions['data_class'] = $this->getClass();
$formBuilder = $this->getFormContractor()->getFormBuilder(
$this->getUniqid(),
$this->formOptions
);
$this->defineFormBuilder($formBuilder);
return $formBuilder;
}
public function defineFormBuilder(FormBuilderInterface $formBuilder)
{
$mapper = new FormMapper($this->getFormContractor(), $formBuilder, $this);
$this->configureFormFields($mapper);
foreach ($this->getExtensions() as $extension) {
$extension->configureFormFields($mapper);
}
$this->attachInlineValidator();
}
public function attachAdminClass(FieldDescriptionInterface $fieldDescription)
{
$pool = $this->getConfigurationPool();
$adminCode = $fieldDescription->getOption('admin_code');
if (null !== $adminCode) {
$admin = $pool->getAdminByAdminCode($adminCode);
} else {
$admin = $pool->getAdminByClass($fieldDescription->getTargetEntity());
}
if (!$admin) {
return;
}
if ($this->hasRequest()) {
$admin->setRequest($this->getRequest());
}
$fieldDescription->setAssociationAdmin($admin);
}
public function getObject($id)
{
$object = $this->getModelManager()->find($this->getClass(), $id);
foreach ($this->getExtensions() as $extension) {
$extension->alterObject($this, $object);
}
return $object;
}
public function getForm()
{
$this->buildForm();
return $this->form;
}
public function getList()
{
$this->buildList();
return $this->list;
}
public function createQuery($context ='list')
{
if (\func_num_args() > 0) {
@trigger_error('The $context argument of '.__METHOD__.' is deprecated since 3.3, to be removed in 4.0.',
E_USER_DEPRECATED
);
}
$query = $this->getModelManager()->createQuery($this->getClass());
foreach ($this->extensions as $extension) {
$extension->configureQuery($this, $query, $context);
}
return $query;
}
public function getDatagrid()
{
$this->buildDatagrid();
return $this->datagrid;
}
public function buildTabMenu($action, AdminInterface $childAdmin = null)
{
if ($this->loaded['tab_menu']) {
return;
}
$this->loaded['tab_menu'] = true;
$menu = $this->menuFactory->createItem('root');
$menu->setChildrenAttribute('class','nav navbar-nav');
$menu->setExtra('translation_domain', $this->translationDomain);
if (method_exists($menu,'setCurrentUri')) {
$menu->setCurrentUri($this->getRequest()->getBaseUrl().$this->getRequest()->getPathInfo());
}
$this->configureTabMenu($menu, $action, $childAdmin);
foreach ($this->getExtensions() as $extension) {
$extension->configureTabMenu($this, $menu, $action, $childAdmin);
}
$this->menu = $menu;
}
public function buildSideMenu($action, AdminInterface $childAdmin = null)
{
return $this->buildTabMenu($action, $childAdmin);
}
public function getSideMenu($action, AdminInterface $childAdmin = null)
{
if ($this->isChild()) {
return $this->getParent()->getSideMenu($action, $this);
}
$this->buildSideMenu($action, $childAdmin);
return $this->menu;
}
public function getRootCode()
{
return $this->getRoot()->getCode();
}
public function getRoot()
{
$parentFieldDescription = $this->getParentFieldDescription();
if (!$parentFieldDescription) {
return $this;
}
return $parentFieldDescription->getAdmin()->getRoot();
}
public function setBaseControllerName($baseControllerName)
{
$this->baseControllerName = $baseControllerName;
}
public function getBaseControllerName()
{
return $this->baseControllerName;
}
public function setLabel($label)
{
$this->label = $label;
}
public function getLabel()
{
return $this->label;
}
public function setPersistFilters($persist)
{
@trigger_error('The '.__METHOD__.' method is deprecated since version 3.34 and will be removed in 4.0.',
E_USER_DEPRECATED
);
$this->persistFilters = $persist;
}
public function setFilterPersister(FilterPersisterInterface $filterPersister = null)
{
$this->filterPersister = $filterPersister;
$this->persistFilters = true;
}
public function setMaxPerPage($maxPerPage)
{
$this->maxPerPage = $maxPerPage;
}
public function getMaxPerPage()
{
return $this->maxPerPage;
}
public function setMaxPageLinks($maxPageLinks)
{
$this->maxPageLinks = $maxPageLinks;
}
public function getMaxPageLinks()
{
return $this->maxPageLinks;
}
public function getFormGroups()
{
return $this->formGroups;
}
public function setFormGroups(array $formGroups)
{
$this->formGroups = $formGroups;
}
public function removeFieldFromFormGroup($key)
{
foreach ($this->formGroups as $name => $formGroup) {
unset($this->formGroups[$name]['fields'][$key]);
if (empty($this->formGroups[$name]['fields'])) {
unset($this->formGroups[$name]);
}
}
}
public function reorderFormGroup($group, array $keys)
{
$formGroups = $this->getFormGroups();
$formGroups[$group]['fields'] = array_merge(array_flip($keys), $formGroups[$group]['fields']);
$this->setFormGroups($formGroups);
}
public function getFormTabs()
{
return $this->formTabs;
}
public function setFormTabs(array $formTabs)
{
$this->formTabs = $formTabs;
}
public function getShowTabs()
{
return $this->showTabs;
}
public function setShowTabs(array $showTabs)
{
$this->showTabs = $showTabs;
}
public function getShowGroups()
{
return $this->showGroups;
}
public function setShowGroups(array $showGroups)
{
$this->showGroups = $showGroups;
}
public function reorderShowGroup($group, array $keys)
{
$showGroups = $this->getShowGroups();
$showGroups[$group]['fields'] = array_merge(array_flip($keys), $showGroups[$group]['fields']);
$this->setShowGroups($showGroups);
}
public function setParentFieldDescription(FieldDescriptionInterface $parentFieldDescription)
{
$this->parentFieldDescription = $parentFieldDescription;
}
public function getParentFieldDescription()
{
return $this->parentFieldDescription;
}
public function hasParentFieldDescription()
{
return $this->parentFieldDescription instanceof FieldDescriptionInterface;
}
public function setSubject($subject)
{
if (\is_object($subject) && !is_a($subject, $this->getClass(), true)) {
$message =<<<'EOT'
You are trying to set entity an instance of "%s",
which is not the one registered with this admin class ("%s").
This is deprecated since 3.5 and will no longer be supported in 4.0.
EOT
;
@trigger_error(
sprintf($message, \get_class($subject), $this->getClass()),
E_USER_DEPRECATED
); }
$this->subject = $subject;
}
public function getSubject()
{
if (null === $this->subject && $this->request && !$this->hasParentFieldDescription()) {
$id = $this->request->get($this->getIdParameter());
if (null !== $id) {
$this->subject = $this->getObject($id);
}
}
return $this->subject;
}
public function hasSubject()
{
return (bool) $this->getSubject();
}
public function getFormFieldDescriptions()
{
$this->buildForm();
return $this->formFieldDescriptions;
}
public function getFormFieldDescription($name)
{
return $this->hasFormFieldDescription($name) ? $this->formFieldDescriptions[$name] : null;
}
public function hasFormFieldDescription($name)
{
return array_key_exists($name, $this->formFieldDescriptions) ? true : false;
}
public function addFormFieldDescription($name, FieldDescriptionInterface $fieldDescription)
{
$this->formFieldDescriptions[$name] = $fieldDescription;
}
public function removeFormFieldDescription($name)
{
unset($this->formFieldDescriptions[$name]);
}
public function getShowFieldDescriptions()
{
$this->buildShow();
return $this->showFieldDescriptions;
}
public function getShowFieldDescription($name)
{
$this->buildShow();
return $this->hasShowFieldDescription($name) ? $this->showFieldDescriptions[$name] : null;
}
public function hasShowFieldDescription($name)
{
return array_key_exists($name, $this->showFieldDescriptions);
}
public function addShowFieldDescription($name, FieldDescriptionInterface $fieldDescription)
{
$this->showFieldDescriptions[$name] = $fieldDescription;
}
public function removeShowFieldDescription($name)
{
unset($this->showFieldDescriptions[$name]);
}
public function getListFieldDescriptions()
{
$this->buildList();
return $this->listFieldDescriptions;
}
public function getListFieldDescription($name)
{
return $this->hasListFieldDescription($name) ? $this->listFieldDescriptions[$name] : null;
}
public function hasListFieldDescription($name)
{
$this->buildList();
return array_key_exists($name, $this->listFieldDescriptions) ? true : false;
}
public function addListFieldDescription($name, FieldDescriptionInterface $fieldDescription)
{
$this->listFieldDescriptions[$name] = $fieldDescription;
}
public function removeListFieldDescription($name)
{
unset($this->listFieldDescriptions[$name]);
}
public function getFilterFieldDescription($name)
{
return $this->hasFilterFieldDescription($name) ? $this->filterFieldDescriptions[$name] : null;
}
public function hasFilterFieldDescription($name)
{
return array_key_exists($name, $this->filterFieldDescriptions) ? true : false;
}
public function addFilterFieldDescription($name, FieldDescriptionInterface $fieldDescription)
{
$this->filterFieldDescriptions[$name] = $fieldDescription;
}
public function removeFilterFieldDescription($name)
{
unset($this->filterFieldDescriptions[$name]);
}
public function getFilterFieldDescriptions()
{
$this->buildDatagrid();
return $this->filterFieldDescriptions;
}
public function addChild(AdminInterface $child)
{
for ($parentAdmin = $this; null !== $parentAdmin; $parentAdmin = $parentAdmin->getParent()) {
if ($parentAdmin->getCode() !== $child->getCode()) {
continue;
}
throw new \RuntimeException(sprintf('Circular reference detected! The child admin `%s` is already in the parent tree of the `%s` admin.',
$child->getCode(), $this->getCode()
));
}
$this->children[$child->getCode()] = $child;
$child->setParent($this);
$args = \func_get_args();
if (isset($args[1])) {
$child->addParentAssociationMapping($this->getCode(), $args[1]);
} else {
@trigger_error('Calling "addChild" without second argument is deprecated since 3.35'.' and will not be allowed in 4.0.',
E_USER_DEPRECATED
);
}
}
public function hasChild($code)
{
return isset($this->children[$code]);
}
public function getChildren()
{
return $this->children;
}
public function getChild($code)
{
return $this->hasChild($code) ? $this->children[$code] : null;
}
public function setParent(AdminInterface $parent)
{
$this->parent = $parent;
}
public function getParent()
{
return $this->parent;
}
final public function getRootAncestor()
{
$parent = $this;
while ($parent->isChild()) {
$parent = $parent->getParent();
}
return $parent;
}
final public function getChildDepth()
{
$parent = $this;
$depth = 0;
while ($parent->isChild()) {
$parent = $parent->getParent();
++$depth;
}
return $depth;
}
final public function getCurrentLeafChildAdmin()
{
$child = $this->getCurrentChildAdmin();
if (null === $child) {
return;
}
for ($c = $child; null !== $c; $c = $child->getCurrentChildAdmin()) {
$child = $c;
}
return $child;
}
public function isChild()
{
return $this->parent instanceof AdminInterface;
}
public function hasChildren()
{
return \count($this->children) > 0;
}
public function setUniqid($uniqid)
{
$this->uniqid = $uniqid;
}
public function getUniqid()
{
if (!$this->uniqid) {
$this->uniqid ='s'.substr(md5($this->getBaseCodeRoute()), 0, 10);
}
return $this->uniqid;
}
public function getClassnameLabel()
{
return $this->classnameLabel;
}
public function getPersistentParameters()
{
$parameters = [];
foreach ($this->getExtensions() as $extension) {
$params = $extension->getPersistentParameters($this);
if (!\is_array($params)) {
throw new \RuntimeException(sprintf('The %s::getPersistentParameters must return an array', \get_class($extension)));
}
$parameters = array_merge($parameters, $params);
}
return $parameters;
}
public function getPersistentParameter($name)
{
$parameters = $this->getPersistentParameters();
return isset($parameters[$name]) ? $parameters[$name] : null;
}
public function getBreadcrumbs($action)
{
@trigger_error('The '.__METHOD__.' method is deprecated since version 3.2 and will be removed in 4.0.'.' Use Sonata\AdminBundle\Admin\BreadcrumbsBuilder::getBreadcrumbs instead.',
E_USER_DEPRECATED
);
return $this->getBreadcrumbsBuilder()->getBreadcrumbs($this, $action);
}
public function buildBreadcrumbs($action, MenuItemInterface $menu = null)
{
@trigger_error('The '.__METHOD__.' method is deprecated since version 3.2 and will be removed in 4.0.',
E_USER_DEPRECATED
);
if (isset($this->breadcrumbs[$action])) {
return $this->breadcrumbs[$action];
}
return $this->breadcrumbs[$action] = $this->getBreadcrumbsBuilder()
->buildBreadcrumbs($this, $action, $menu);
}
final public function getBreadcrumbsBuilder()
{
@trigger_error('The '.__METHOD__.' method is deprecated since version 3.2 and will be removed in 4.0.'.' Use the sonata.admin.breadcrumbs_builder service instead.',
E_USER_DEPRECATED
);
if (null === $this->breadcrumbsBuilder) {
$this->breadcrumbsBuilder = new BreadcrumbsBuilder(
$this->getConfigurationPool()->getContainer()->getParameter('sonata.admin.configuration.breadcrumbs')
);
}
return $this->breadcrumbsBuilder;
}
final public function setBreadcrumbsBuilder(BreadcrumbsBuilderInterface $value)
{
@trigger_error('The '.__METHOD__.' method is deprecated since version 3.2 and will be removed in 4.0.'.' Use the sonata.admin.breadcrumbs_builder service instead.',
E_USER_DEPRECATED
);
$this->breadcrumbsBuilder = $value;
return $this;
}
public function setCurrentChild($currentChild)
{
$this->currentChild = $currentChild;
}
public function getCurrentChild()
{
return $this->currentChild;
}
public function getCurrentChildAdmin()
{
foreach ($this->children as $children) {
if ($children->getCurrentChild()) {
return $children;
}
}
}
public function trans($id, array $parameters = [], $domain = null, $locale = null)
{
@trigger_error('The '.__METHOD__.' method is deprecated since version 3.9 and will be removed in 4.0.',
E_USER_DEPRECATED
);
$domain = $domain ?: $this->getTranslationDomain();
return $this->translator->trans($id, $parameters, $domain, $locale);
}
public function transChoice($id, $count, array $parameters = [], $domain = null, $locale = null)
{
@trigger_error('The '.__METHOD__.' method is deprecated since version 3.9 and will be removed in 4.0.',
E_USER_DEPRECATED
);
$domain = $domain ?: $this->getTranslationDomain();
return $this->translator->transChoice($id, $count, $parameters, $domain, $locale);
}
public function setTranslationDomain($translationDomain)
{
$this->translationDomain = $translationDomain;
}
public function getTranslationDomain()
{
return $this->translationDomain;
}
public function setTranslator(TranslatorInterface $translator)
{
$args = \func_get_args();
if (isset($args[1]) && $args[1]) {
@trigger_error('The '.__METHOD__.' method is deprecated since version 3.9 and will be removed in 4.0.',
E_USER_DEPRECATED
);
}
$this->translator = $translator;
}
public function getTranslator()
{
@trigger_error('The '.__METHOD__.' method is deprecated since version 3.9 and will be removed in 4.0.',
E_USER_DEPRECATED
);
return $this->translator;
}
public function getTranslationLabel($label, $context ='', $type ='')
{
return $this->getLabelTranslatorStrategy()->getLabel($label, $context, $type);
}
public function setRequest(Request $request)
{
$this->request = $request;
foreach ($this->getChildren() as $children) {
$children->setRequest($request);
}
}
public function getRequest()
{
if (!$this->request) {
throw new \RuntimeException('The Request object has not been set');
}
return $this->request;
}
public function hasRequest()
{
return null !== $this->request;
}
public function setFormContractor(FormContractorInterface $formBuilder)
{
$this->formContractor = $formBuilder;
}
public function getFormContractor()
{
return $this->formContractor;
}
public function setDatagridBuilder(DatagridBuilderInterface $datagridBuilder)
{
$this->datagridBuilder = $datagridBuilder;
}
public function getDatagridBuilder()
{
return $this->datagridBuilder;
}
public function setListBuilder(ListBuilderInterface $listBuilder)
{
$this->listBuilder = $listBuilder;
}
public function getListBuilder()
{
return $this->listBuilder;
}
public function setShowBuilder(ShowBuilderInterface $showBuilder)
{
$this->showBuilder = $showBuilder;
}
public function getShowBuilder()
{
return $this->showBuilder;
}
public function setConfigurationPool(Pool $configurationPool)
{
$this->configurationPool = $configurationPool;
}
public function getConfigurationPool()
{
return $this->configurationPool;
}
public function setRouteGenerator(RouteGeneratorInterface $routeGenerator)
{
$this->routeGenerator = $routeGenerator;
}
public function getRouteGenerator()
{
return $this->routeGenerator;
}
public function getCode()
{
return $this->code;
}
public function setBaseCodeRoute($baseCodeRoute)
{
@trigger_error('The '.__METHOD__.' is deprecated since 3.24 and will be removed in 4.0.',
E_USER_DEPRECATED
);
$this->baseCodeRoute = $baseCodeRoute;
}
public function getBaseCodeRoute()
{
if ($this->isChild()) {
$parentCode = $this->getParent()->getCode();
if ($this->getParent()->isChild()) {
$parentCode = $this->getParent()->getBaseCodeRoute();
}
return $parentCode.'|'.$this->getCode();
}
return $this->baseCodeRoute;
}
public function getModelManager()
{
return $this->modelManager;
}
public function setModelManager(ModelManagerInterface $modelManager)
{
$this->modelManager = $modelManager;
}
public function getManagerType()
{
return $this->managerType;
}
public function setManagerType($type)
{
$this->managerType = $type;
}
public function getObjectIdentifier()
{
return $this->getCode();
}
public function setSecurityInformation(array $information)
{
$this->securityInformation = $information;
}
public function getSecurityInformation()
{
return $this->securityInformation;
}
public function getPermissionsShow($context)
{
switch ($context) {
case self::CONTEXT_DASHBOARD:
case self::CONTEXT_MENU:
default:
return ['LIST'];
}
}
public function showIn($context)
{
switch ($context) {
case self::CONTEXT_DASHBOARD:
case self::CONTEXT_MENU:
default:
return $this->isGranted($this->getPermissionsShow($context));
}
}
public function createObjectSecurity($object)
{
$this->getSecurityHandler()->createObjectSecurity($this, $object);
}
public function setSecurityHandler(SecurityHandlerInterface $securityHandler)
{
$this->securityHandler = $securityHandler;
}
public function getSecurityHandler()
{
return $this->securityHandler;
}
public function isGranted($name, $object = null)
{
$key = md5(json_encode($name).($object ?'/'.spl_object_hash($object) :''));
if (!array_key_exists($key, $this->cacheIsGranted)) {
$this->cacheIsGranted[$key] = $this->securityHandler->isGranted($this, $name, $object ?: $this);
}
return $this->cacheIsGranted[$key];
}
public function getUrlsafeIdentifier($entity)
{
return $this->getModelManager()->getUrlsafeIdentifier($entity);
}
public function getNormalizedIdentifier($entity)
{
return $this->getModelManager()->getNormalizedIdentifier($entity);
}
public function id($entity)
{
return $this->getNormalizedIdentifier($entity);
}
public function setValidator($validator)
{
if (!$validator instanceof ValidatorInterface) {
throw new \InvalidArgumentException('Argument 1 must be an instance of Symfony\Component\Validator\Validator\ValidatorInterface');
}
$this->validator = $validator;
}
public function getValidator()
{
return $this->validator;
}
public function getShow()
{
$this->buildShow();
return $this->show;
}
public function setFormTheme(array $formTheme)
{
$this->formTheme = $formTheme;
}
public function getFormTheme()
{
return $this->formTheme;
}
public function setFilterTheme(array $filterTheme)
{
$this->filterTheme = $filterTheme;
}
public function getFilterTheme()
{
return $this->filterTheme;
}
public function addExtension(AdminExtensionInterface $extension)
{
$this->extensions[] = $extension;
}
public function getExtensions()
{
return $this->extensions;
}
public function setMenuFactory(MenuFactoryInterface $menuFactory)
{
$this->menuFactory = $menuFactory;
}
public function getMenuFactory()
{
return $this->menuFactory;
}
public function setRouteBuilder(RouteBuilderInterface $routeBuilder)
{
$this->routeBuilder = $routeBuilder;
}
public function getRouteBuilder()
{
return $this->routeBuilder;
}
public function toString($object)
{
if (!\is_object($object)) {
return'';
}
if (method_exists($object,'__toString') && null !== $object->__toString()) {
return (string) $object;
}
return sprintf('%s:%s', ClassUtils::getClass($object), spl_object_hash($object));
}
public function setLabelTranslatorStrategy(LabelTranslatorStrategyInterface $labelTranslatorStrategy)
{
$this->labelTranslatorStrategy = $labelTranslatorStrategy;
}
public function getLabelTranslatorStrategy()
{
return $this->labelTranslatorStrategy;
}
public function supportsPreviewMode()
{
return $this->supportsPreviewMode;
}
public function setPerPageOptions(array $options)
{
$this->perPageOptions = $options;
}
public function getPerPageOptions()
{
return $this->perPageOptions;
}
public function setPagerType($pagerType)
{
$this->pagerType = $pagerType;
}
public function getPagerType()
{
return $this->pagerType;
}
public function determinedPerPageValue($perPage)
{
return \in_array($perPage, $this->perPageOptions);
}
public function isAclEnabled()
{
return $this->getSecurityHandler() instanceof AclSecurityHandlerInterface;
}
public function getObjectMetadata($object)
{
return new Metadata($this->toString($object));
}
public function getListModes()
{
return $this->listModes;
}
public function setListMode($mode)
{
if (!$this->hasRequest()) {
throw new \RuntimeException(sprintf('No request attached to the current admin: %s', $this->getCode()));
}
$this->getRequest()->getSession()->set(sprintf('%s.list_mode', $this->getCode()), $mode);
}
public function getListMode()
{
if (!$this->hasRequest()) {
return'list';
}
return $this->getRequest()->getSession()->get(sprintf('%s.list_mode', $this->getCode()),'list');
}
public function getAccessMapping()
{
return $this->accessMapping;
}
public function checkAccess($action, $object = null)
{
$access = $this->getAccess();
if (!array_key_exists($action, $access)) {
throw new \InvalidArgumentException(sprintf('Action "%s" could not be found in access mapping.'.' Please make sure your action is defined into your admin class accessMapping property.',
$action
));
}
if (!\is_array($access[$action])) {
$access[$action] = [$access[$action]];
}
foreach ($access[$action] as $role) {
if (false === $this->isGranted($role, $object)) {
throw new AccessDeniedException(sprintf('Access Denied to the action %s and role %s', $action, $role));
}
}
}
public function hasAccess($action, $object = null)
{
$access = $this->getAccess();
if (!array_key_exists($action, $access)) {
return false;
}
if (!\is_array($access[$action])) {
$access[$action] = [$access[$action]];
}
foreach ($access[$action] as $role) {
if (false === $this->isGranted($role, $object)) {
return false;
}
}
return true;
}
public function configureActionButtons($action, $object = null)
{
$list = [];
if (\in_array($action, ['tree','show','edit','delete','list','batch'])
&& $this->hasAccess('create')
&& $this->hasRoute('create')
) {
$list['create'] = ['template'=> $this->getTemplate('button_create'),
];
}
if (\in_array($action, ['show','delete','acl','history'])
&& $this->canAccessObject('edit', $object)
&& $this->hasRoute('edit')
) {
$list['edit'] = ['template'=> $this->getTemplate('button_edit'),
];
}
if (\in_array($action, ['show','edit','acl'])
&& $this->canAccessObject('history', $object)
&& $this->hasRoute('history')
) {
$list['history'] = ['template'=> $this->getTemplate('button_history'),
];
}
if (\in_array($action, ['edit','history'])
&& $this->isAclEnabled()
&& $this->canAccessObject('acl', $object)
&& $this->hasRoute('acl')
) {
$list['acl'] = ['template'=> $this->getTemplate('button_acl'),
];
}
if (\in_array($action, ['edit','history','acl'])
&& $this->canAccessObject('show', $object)
&& \count($this->getShow()) > 0
&& $this->hasRoute('show')
) {
$list['show'] = ['template'=> $this->getTemplate('button_show'),
];
}
if (\in_array($action, ['show','edit','delete','acl','batch'])
&& $this->hasAccess('list')
&& $this->hasRoute('list')
) {
$list['list'] = ['template'=> $this->getTemplate('button_list'),
];
}
return $list;
}
public function getActionButtons($action, $object = null)
{
$list = $this->configureActionButtons($action, $object);
foreach ($this->getExtensions() as $extension) {
if (method_exists($extension,'configureActionButtons')) {
$list = $extension->configureActionButtons($this, $list, $action, $object);
}
}
return $list;
}
public function getDashboardActions()
{
$actions = [];
if ($this->hasRoute('create') && $this->hasAccess('create')) {
$actions['create'] = ['label'=>'link_add','translation_domain'=>'SonataAdminBundle','template'=> $this->getTemplate('action_create'),'url'=> $this->generateUrl('create'),'icon'=>'plus-circle',
];
}
if ($this->hasRoute('list') && $this->hasAccess('list')) {
$actions['list'] = ['label'=>'link_list','translation_domain'=>'SonataAdminBundle','url'=> $this->generateUrl('list'),'icon'=>'list',
];
}
return $actions;
}
final public function showMosaicButton($isShown)
{
if ($isShown) {
$this->listModes['mosaic'] = ['class'=> static::MOSAIC_ICON_CLASS];
} else {
unset($this->listModes['mosaic']);
}
}
final public function getSearchResultLink($object)
{
foreach ($this->searchResultActions as $action) {
if ($this->hasRoute($action) && $this->hasAccess($action, $object)) {
return $this->generateObjectUrl($action, $object);
}
}
}
final public function isDefaultFilter($name)
{
$filter = $this->getFilterParameters();
$default = $this->getDefaultFilterValues();
if (!array_key_exists($name, $filter) || !array_key_exists($name, $default)) {
return false;
}
return $filter[$name] == $default[$name];
}
public function canAccessObject($action, $object)
{
return $object && $this->id($object) && $this->hasAccess($action, $object);
}
final protected function getTemplateRegistry()
{
return $this->templateRegistry;
}
final protected function getDefaultFilterValues()
{
$defaultFilterValues = [];
$this->configureDefaultFilterValues($defaultFilterValues);
foreach ($this->getExtensions() as $extension) {
if (method_exists($extension,'configureDefaultFilterValues')) {
$extension->configureDefaultFilterValues($this, $defaultFilterValues);
}
}
return $defaultFilterValues;
}
protected function configureFormFields(FormMapper $form)
{
}
protected function configureListFields(ListMapper $list)
{
}
protected function configureDatagridFilters(DatagridMapper $filter)
{
}
protected function configureShowFields(ShowMapper $show)
{
}
protected function configureRoutes(RouteCollection $collection)
{
}
protected function configureBatchActions($actions)
{
return $actions;
}
protected function configureSideMenu(MenuItemInterface $menu, $action, AdminInterface $childAdmin = null)
{
}
protected function configureTabMenu(MenuItemInterface $menu, $action, AdminInterface $childAdmin = null)
{
$this->configureSideMenu($menu, $action, $childAdmin);
}
protected function buildShow()
{
if ($this->show) {
return;
}
$this->show = new FieldDescriptionCollection();
$mapper = new ShowMapper($this->showBuilder, $this->show, $this);
$this->configureShowFields($mapper);
foreach ($this->getExtensions() as $extension) {
$extension->configureShowFields($mapper);
}
}
protected function buildList()
{
if ($this->list) {
return;
}
$this->list = $this->getListBuilder()->getBaseList();
$mapper = new ListMapper($this->getListBuilder(), $this->list, $this);
if (\count($this->getBatchActions()) > 0) {
$fieldDescription = $this->getModelManager()->getNewFieldDescriptionInstance(
$this->getClass(),'batch',
['label'=>'batch','code'=>'_batch','sortable'=> false,'virtual_field'=> true,
]
);
$fieldDescription->setAdmin($this);
$fieldDescription->setTemplate($this->getTemplate('batch'));
$mapper->add($fieldDescription,'batch');
}
$this->configureListFields($mapper);
foreach ($this->getExtensions() as $extension) {
$extension->configureListFields($mapper);
}
if ($this->hasRequest() && $this->getRequest()->isXmlHttpRequest()) {
$fieldDescription = $this->getModelManager()->getNewFieldDescriptionInstance(
$this->getClass(),'select',
['label'=> false,'code'=>'_select','sortable'=> false,'virtual_field'=> false,
]
);
$fieldDescription->setAdmin($this);
$fieldDescription->setTemplate($this->getTemplate('select'));
$mapper->add($fieldDescription,'select');
}
}
protected function buildForm()
{
if ($this->form) {
return;
}
if ($this->isChild() && $this->getParentAssociationMapping()) {
$parent = $this->getParent()->getObject($this->request->get($this->getParent()->getIdParameter()));
$propertyAccessor = $this->getConfigurationPool()->getPropertyAccessor();
$propertyPath = new PropertyPath($this->getParentAssociationMapping());
$object = $this->getSubject();
$value = $propertyAccessor->getValue($object, $propertyPath);
if (\is_array($value) || ($value instanceof \Traversable && $value instanceof \ArrayAccess)) {
$value[] = $parent;
$propertyAccessor->setValue($object, $propertyPath, $value);
} else {
$propertyAccessor->setValue($object, $propertyPath, $parent);
}
}
$formBuilder = $this->getFormBuilder();
$formBuilder->addEventListener(FormEvents::POST_SUBMIT, function (FormEvent $event) {
$this->preValidate($event->getData());
}, 100);
$this->form = $formBuilder->getForm();
}
protected function getSubClass($name)
{
if ($this->hasSubClass($name)) {
return $this->subClasses[$name];
}
throw new \RuntimeException(sprintf('Unable to find the subclass `%s` for admin `%s`',
$name,
\get_class($this)
));
}
protected function attachInlineValidator()
{
$admin = $this;
$metadata = $this->validator->getMetadataFor($this->getClass());
$metadata->addConstraint(new InlineConstraint(['service'=> $this,'method'=> function (ErrorElement $errorElement, $object) use ($admin) {
if ($admin->hasSubject() && spl_object_hash($object) !== spl_object_hash($admin->getSubject())) {
return;
}
$admin->validate($errorElement, $object);
foreach ($admin->getExtensions() as $extension) {
$extension->validate($admin, $errorElement, $object);
}
},'serializingWarning'=> true,
]));
}
protected function predefinePerPageOptions()
{
array_unshift($this->perPageOptions, $this->maxPerPage);
$this->perPageOptions = array_unique($this->perPageOptions);
sort($this->perPageOptions);
}
protected function getAccess()
{
$access = array_merge(['acl'=>'MASTER','export'=>'EXPORT','historyCompareRevisions'=>'EDIT','historyViewRevision'=>'EDIT','history'=>'EDIT','edit'=>'EDIT','show'=>'VIEW','create'=>'CREATE','delete'=>'DELETE','batchDelete'=>'DELETE','list'=>'LIST',
], $this->getAccessMapping());
foreach ($this->extensions as $extension) {
if (method_exists($extension,'getAccessMapping')) {
$access = array_merge($access, $extension->getAccessMapping($this));
}
}
return $access;
}
protected function configureDefaultFilterValues(array &$filterValues)
{
}
private function buildRoutes()
{
if ($this->loaded['routes']) {
return;
}
$this->loaded['routes'] = true;
$this->routes = new RouteCollection(
$this->getBaseCodeRoute(),
$this->getBaseRouteName(),
$this->getBaseRoutePattern(),
$this->getBaseControllerName()
);
$this->routeBuilder->build($this, $this->routes);
$this->configureRoutes($this->routes);
foreach ($this->getExtensions() as $extension) {
$extension->configureRoutes($this, $this->routes);
}
}
}
}
namespace Sonata\AdminBundle\Admin
{
use Knp\Menu\ItemInterface as MenuItemInterface;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\ProxyQueryInterface;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\CoreBundle\Validator\ErrorElement;
interface AdminExtensionInterface
{
public function configureFormFields(FormMapper $formMapper);
public function configureListFields(ListMapper $listMapper);
public function configureDatagridFilters(DatagridMapper $datagridMapper);
public function configureShowFields(ShowMapper $showMapper);
public function configureRoutes(AdminInterface $admin, RouteCollection $collection);
public function configureSideMenu(
AdminInterface $admin,
MenuItemInterface $menu,
$action,
AdminInterface $childAdmin = null
);
public function configureTabMenu(
AdminInterface $admin,
MenuItemInterface $menu,
$action,
AdminInterface $childAdmin = null
);
public function validate(AdminInterface $admin, ErrorElement $errorElement, $object);
public function configureQuery(AdminInterface $admin, ProxyQueryInterface $query, $context ='list');
public function alterNewInstance(AdminInterface $admin, $object);
public function alterObject(AdminInterface $admin, $object);
public function getPersistentParameters(AdminInterface $admin);
public function preUpdate(AdminInterface $admin, $object);
public function postUpdate(AdminInterface $admin, $object);
public function prePersist(AdminInterface $admin, $object);
public function postPersist(AdminInterface $admin, $object);
public function preRemove(AdminInterface $admin, $object);
public function postRemove(AdminInterface $admin, $object);
}
}
namespace Sonata\AdminBundle\Admin
{
use Knp\Menu\ItemInterface as MenuItemInterface;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\ProxyQueryInterface;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\CoreBundle\Validator\ErrorElement;
abstract class AbstractAdminExtension implements AdminExtensionInterface
{
public function configureFormFields(FormMapper $formMapper)
{
}
public function configureListFields(ListMapper $listMapper)
{
}
public function configureDatagridFilters(DatagridMapper $datagridMapper)
{
}
public function configureShowFields(ShowMapper $showMapper)
{
}
public function configureRoutes(AdminInterface $admin, RouteCollection $collection)
{
}
public function configureSideMenu(AdminInterface $admin, MenuItemInterface $menu, $action, AdminInterface $childAdmin = null)
{
}
public function configureTabMenu(AdminInterface $admin, MenuItemInterface $menu, $action, AdminInterface $childAdmin = null)
{
$this->configureSideMenu($admin, $menu, $action, $childAdmin);
}
public function validate(AdminInterface $admin, ErrorElement $errorElement, $object)
{
}
public function configureQuery(AdminInterface $admin, ProxyQueryInterface $query, $context ='list')
{
}
public function alterNewInstance(AdminInterface $admin, $object)
{
}
public function alterObject(AdminInterface $admin, $object)
{
}
public function getPersistentParameters(AdminInterface $admin)
{
return [];
}
public function getAccessMapping(AdminInterface $admin)
{
return [];
}
public function configureBatchActions(AdminInterface $admin, array $actions)
{
return $actions;
}
public function configureExportFields(AdminInterface $admin, array $fields)
{
return $fields;
}
public function preUpdate(AdminInterface $admin, $object)
{
}
public function postUpdate(AdminInterface $admin, $object)
{
}
public function prePersist(AdminInterface $admin, $object)
{
}
public function postPersist(AdminInterface $admin, $object)
{
}
public function preRemove(AdminInterface $admin, $object)
{
}
public function postRemove(AdminInterface $admin, $object)
{
}
public function configureActionButtons(AdminInterface $admin, $list, $action, $object)
{
return $list;
}
public function configureDefaultFilterValues(AdminInterface $admin, array &$filterValues)
{
}
}
}
namespace Sonata\AdminBundle\Admin
{
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Inflector\Inflector;
use Doctrine\Common\Util\ClassUtils;
use Doctrine\ODM\MongoDB\PersistentCollection;
use Doctrine\ORM\PersistentCollection as DoctrinePersistentCollection;
use Sonata\AdminBundle\Exception\NoValueException;
use Sonata\AdminBundle\Util\FormBuilderIterator;
use Sonata\AdminBundle\Util\FormViewIterator;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormView;
class AdminHelper
{
protected $pool;
public function __construct(Pool $pool)
{
$this->pool = $pool;
}
public function getChildFormBuilder(FormBuilderInterface $formBuilder, $elementId)
{
foreach (new FormBuilderIterator($formBuilder) as $name => $formBuilder) {
if ($name == $elementId) {
return $formBuilder;
}
}
}
public function getChildFormView(FormView $formView, $elementId)
{
foreach (new \RecursiveIteratorIterator(new FormViewIterator($formView), \RecursiveIteratorIterator::SELF_FIRST) as $name => $formView) {
if ($name === $elementId) {
return $formView;
}
}
}
public function getAdmin($code)
{
return $this->pool->getInstance($code);
}
public function appendFormFieldElement(AdminInterface $admin, $subject, $elementId)
{
$formBuilder = $admin->getFormBuilder();
$form = $formBuilder->getForm();
$form->setData($subject);
$form->handleRequest($admin->getRequest());
$childFormBuilder = $this->getChildFormBuilder($formBuilder, $elementId);
if (!$childFormBuilder) {
$propertyAccessor = $this->pool->getPropertyAccessor();
$entity = $admin->getSubject();
$path = $this->getElementAccessPath($elementId, $entity);
$collection = $propertyAccessor->getValue($entity, $path);
if ($collection instanceof DoctrinePersistentCollection || $collection instanceof PersistentCollection) {
$entityClassName = $collection->getTypeClass()->getName();
} elseif ($collection instanceof Collection) {
$entityClassName = $this->getEntityClassName($admin, explode('.', preg_replace('#\[\d*?\]#','', $path)));
} else {
throw new \Exception('unknown collection class');
}
$collection->add(new $entityClassName());
$propertyAccessor->setValue($entity, $path, $collection);
$fieldDescription = null;
} else {
$fieldDescription = $admin->getFormFieldDescription($childFormBuilder->getName());
try {
$value = $fieldDescription->getValue($form->getData());
} catch (NoValueException $e) {
$value = null;
}
$data = $admin->getRequest()->get($formBuilder->getName());
if (!isset($data[$childFormBuilder->getName()])) {
$data[$childFormBuilder->getName()] = [];
}
$objectCount = null === $value ? 0 : \count($value);
$postCount = \count($data[$childFormBuilder->getName()]);
$fields = array_keys($fieldDescription->getAssociationAdmin()->getFormFieldDescriptions());
$value = [];
foreach ($fields as $name) {
$value[$name] ='';
}
while ($objectCount < $postCount) {
$this->addNewInstance($form->getData(), $fieldDescription);
++$objectCount;
}
$this->addNewInstance($form->getData(), $fieldDescription);
}
$finalForm = $admin->getFormBuilder()->getForm();
$finalForm->setData($subject);
$finalForm->setData($form->getData());
return [$fieldDescription, $finalForm];
}
public function addNewInstance($object, FieldDescriptionInterface $fieldDescription)
{
$instance = $fieldDescription->getAssociationAdmin()->getNewInstance();
$mapping = $fieldDescription->getAssociationMapping();
$method = sprintf('add%s', Inflector::classify($mapping['fieldName']));
if (!method_exists($object, $method)) {
$method = rtrim($method,'s');
if (!method_exists($object, $method)) {
$method = sprintf('add%s', Inflector::classify(Inflector::singularize($mapping['fieldName'])));
if (!method_exists($object, $method)) {
throw new \RuntimeException(
sprintf('Please add a method %s in the %s class!', $method, ClassUtils::getClass($object))
);
}
}
}
$object->$method($instance);
}
public function camelize($property)
{
@trigger_error(
sprintf('The %s method is deprecated since 3.1 and will be removed in 4.0. '.'Use \Doctrine\Common\Inflector\Inflector::classify() instead.',
__METHOD__
),
E_USER_DEPRECATED
);
return Inflector::classify($property);
}
public function getElementAccessPath($elementId, $entity)
{
$propertyAccessor = $this->pool->getPropertyAccessor();
$idWithoutIdentifier = preg_replace('/^[^_]*_/','', $elementId);
$initialPath = preg_replace('#(_(\d+)_)#','[$2]_', $idWithoutIdentifier);
$parts = explode('_', $initialPath);
$totalPath ='';
$currentPath ='';
foreach ($parts as $part) {
$currentPath .= empty($currentPath) ? $part :'_'.$part;
$separator = empty($totalPath) ?'':'.';
if ($propertyAccessor->isReadable($entity, $totalPath.$separator.$currentPath)) {
$totalPath .= $separator.$currentPath;
$currentPath ='';
}
}
if (!empty($currentPath)) {
throw new \Exception(
sprintf('Could not get element id from %s Failing part: %s', $elementId, $currentPath)
);
}
return $totalPath;
}
protected function getEntityClassName(AdminInterface $admin, $elements)
{
$element = array_shift($elements);
$associationAdmin = $admin->getFormFieldDescription($element)->getAssociationAdmin();
if (0 == \count($elements)) {
return $associationAdmin->getClass();
}
return $this->getEntityClassName($associationAdmin, $elements);
}
}
}
namespace Sonata\AdminBundle\Admin
{
interface FieldDescriptionInterface
{
public function setFieldName($fieldName);
public function getFieldName();
public function setName($name);
public function getName();
public function getOption($name, $default = null);
public function setOption($name, $value);
public function setOptions(array $options);
public function getOptions();
public function setTemplate($template);
public function getTemplate();
public function setType($type);
public function getType();
public function setParent(AdminInterface $parent);
public function getParent();
public function setAssociationMapping($associationMapping);
public function getAssociationMapping();
public function getTargetEntity();
public function setFieldMapping($fieldMapping);
public function getFieldMapping();
public function setParentAssociationMappings(array $parentAssociationMappings);
public function getParentAssociationMappings();
public function setAssociationAdmin(AdminInterface $associationAdmin);
public function getAssociationAdmin();
public function isIdentifier();
public function getValue($object);
public function setAdmin(AdminInterface $admin);
public function getAdmin();
public function mergeOption($name, array $options = []);
public function mergeOptions(array $options = []);
public function setMappingType($mappingType);
public function getMappingType();
public function getLabel();
public function getTranslationDomain();
public function isSortable();
public function getSortFieldMapping();
public function getSortParentAssociationMapping();
public function getFieldValue($object, $fieldName);
}
}
namespace Sonata\AdminBundle\Admin
{
use Doctrine\Common\Inflector\Inflector;
use Sonata\AdminBundle\Exception\NoValueException;
abstract class BaseFieldDescription implements FieldDescriptionInterface
{
protected $name;
protected $type;
protected $mappingType;
protected $fieldName;
protected $associationMapping;
protected $fieldMapping;
protected $parentAssociationMappings;
protected $template;
protected $options = [];
protected $parent = null;
protected $admin;
protected $associationAdmin;
protected $help;
private static $fieldGetters = [];
public function setFieldName($fieldName)
{
$this->fieldName = $fieldName;
}
public function getFieldName()
{
return $this->fieldName;
}
public function setName($name)
{
$this->name = $name;
if (!$this->getFieldName()) {
$this->setFieldName(substr(strrchr('.'.$name,'.'), 1));
}
}
public function getName()
{
return $this->name;
}
public function getOption($name, $default = null)
{
return isset($this->options[$name]) ? $this->options[$name] : $default;
}
public function setOption($name, $value)
{
$this->options[$name] = $value;
}
public function setOptions(array $options)
{
if (isset($options['type'])) {
$this->setType($options['type']);
unset($options['type']);
}
if (isset($options['template'])) {
$this->setTemplate($options['template']);
unset($options['template']);
}
if (isset($options['help'])) {
$this->setHelp($options['help']);
unset($options['help']);
}
if (!isset($options['placeholder'])) {
$options['placeholder'] ='short_object_description_placeholder';
}
if (!isset($options['link_parameters'])) {
$options['link_parameters'] = [];
}
$this->options = $options;
}
public function getOptions()
{
return $this->options;
}
public function setTemplate($template)
{
$this->template = $template;
}
public function getTemplate()
{
return $this->template;
}
public function setType($type)
{
$this->type = $type;
}
public function getType()
{
return $this->type;
}
public function setParent(AdminInterface $parent)
{
$this->parent = $parent;
}
public function getParent()
{
return $this->parent;
}
public function getAssociationMapping()
{
return $this->associationMapping;
}
public function getFieldMapping()
{
return $this->fieldMapping;
}
public function getParentAssociationMappings()
{
return $this->parentAssociationMappings;
}
public function setAssociationAdmin(AdminInterface $associationAdmin)
{
$this->associationAdmin = $associationAdmin;
$this->associationAdmin->setParentFieldDescription($this);
}
public function getAssociationAdmin()
{
return $this->associationAdmin;
}
public function hasAssociationAdmin()
{
return null !== $this->associationAdmin;
}
public function getFieldValue($object, $fieldName)
{
if ($this->isVirtual() || null === $object) {
return;
}
$getters = [];
$parameters = [];
if ($this->getOption('code')) {
$getters[] = $this->getOption('code');
}
if ($this->getOption('parameters')) {
$parameters = $this->getOption('parameters');
}
if (\is_string($fieldName) &&''!== $fieldName) {
if ($this->hasCachedFieldGetter($object, $fieldName)) {
return $this->callCachedGetter($object, $fieldName, $parameters);
}
$camelizedFieldName = Inflector::classify($fieldName);
$getters[] ='get'.$camelizedFieldName;
$getters[] ='is'.$camelizedFieldName;
$getters[] ='has'.$camelizedFieldName;
}
foreach ($getters as $getter) {
if (method_exists($object, $getter) && \is_callable([$object, $getter])) {
$this->cacheFieldGetter($object, $fieldName,'getter', $getter);
return \call_user_func_array([$object, $getter], $parameters);
}
}
if (method_exists($object,'__call')) {
$this->cacheFieldGetter($object, $fieldName,'call');
return \call_user_func_array([$object,'__call'], [$fieldName, $parameters]);
}
if (isset($object->{$fieldName})) {
$this->cacheFieldGetter($object, $fieldName,'var');
return $object->{$fieldName};
}
throw new NoValueException(sprintf('Unable to retrieve the value of `%s`', $this->getName()));
}
public function setAdmin(AdminInterface $admin)
{
$this->admin = $admin;
}
public function getAdmin()
{
return $this->admin;
}
public function mergeOption($name, array $options = [])
{
if (!isset($this->options[$name])) {
$this->options[$name] = [];
}
if (!\is_array($this->options[$name])) {
throw new \RuntimeException(sprintf('The key `%s` does not point to an array value', $name));
}
$this->options[$name] = array_merge($this->options[$name], $options);
}
public function mergeOptions(array $options = [])
{
$this->setOptions(array_merge_recursive($this->options, $options));
}
public function setMappingType($mappingType)
{
$this->mappingType = $mappingType;
}
public function getMappingType()
{
return $this->mappingType;
}
public static function camelize($property)
{
@trigger_error(
sprintf('The %s method is deprecated since 3.1 and will be removed in 4.0. '.'Use \Doctrine\Common\Inflector\Inflector::classify() instead.',
__METHOD__
),
E_USER_DEPRECATED
);
return Inflector::classify($property);
}
public function setHelp($help)
{
$this->help = $help;
}
public function getHelp()
{
return $this->help;
}
public function getLabel()
{
return $this->getOption('label');
}
public function isSortable()
{
return false !== $this->getOption('sortable', false);
}
public function getSortFieldMapping()
{
return $this->getOption('sort_field_mapping');
}
public function getSortParentAssociationMapping()
{
return $this->getOption('sort_parent_association_mappings');
}
public function getTranslationDomain()
{
return $this->getOption('translation_domain') ?: $this->getAdmin()->getTranslationDomain();
}
public function isVirtual()
{
return false !== $this->getOption('virtual_field', false);
}
private function getFieldGetterKey($object, $fieldName)
{
if (!\is_string($fieldName)) {
return null;
}
if (!\is_object($object)) {
return null;
}
$components = [\get_class($object), $fieldName];
$code = $this->getOption('code');
if (\is_string($code) &&''!== $code) {
$components[] = $code;
}
return implode('-', $components);
}
private function hasCachedFieldGetter($object, $fieldName)
{
return isset(
self::$fieldGetters[$this->getFieldGetterKey($object, $fieldName)]
);
}
private function callCachedGetter($object, $fieldName, array $parameters = [])
{
$getterKey = $this->getFieldGetterKey($object, $fieldName);
if ('getter'=== self::$fieldGetters[$getterKey]['method']) {
return \call_user_func_array(
[$object, self::$fieldGetters[$getterKey]['getter']],
$parameters
);
} elseif ('call'=== self::$fieldGetters[$getterKey]['method']) {
return \call_user_func_array(
[$object,'__call'],
[$fieldName, $parameters]
);
}
return $object->{$fieldName};
}
private function cacheFieldGetter($object, $fieldName, $method, $getter = null)
{
$getterKey = $this->getFieldGetterKey($object, $fieldName);
if (null !== $getterKey) {
self::$fieldGetters[$getterKey] = ['method'=> $method,
];
if (null !== $getter) {
self::$fieldGetters[$getterKey]['getter'] = $getter;
}
}
}
}
}
namespace Sonata\AdminBundle\Admin
{
class FieldDescriptionCollection implements \ArrayAccess, \Countable
{
protected $elements = [];
public function add(FieldDescriptionInterface $fieldDescription)
{
$this->elements[$fieldDescription->getName()] = $fieldDescription;
}
public function getElements()
{
return $this->elements;
}
public function has($name)
{
return array_key_exists($name, $this->elements);
}
public function get($name)
{
if ($this->has($name)) {
return $this->elements[$name];
}
throw new \InvalidArgumentException(sprintf('Element "%s" does not exist.', $name));
}
public function remove($name)
{
if ($this->has($name)) {
unset($this->elements[$name]);
}
}
public function offsetExists($offset)
{
return $this->has($offset);
}
public function offsetGet($offset)
{
return $this->get($offset);
}
public function offsetSet($offset, $value)
{
throw new \RuntimeException('Cannot set value, use add');
}
public function offsetUnset($offset)
{
$this->remove($offset);
}
public function count()
{
return \count($this->elements);
}
public function reorder(array $keys)
{
if ($this->has('batch')) {
array_unshift($keys,'batch');
}
$this->elements = array_merge(array_flip($keys), $this->elements);
}
}
}
namespace Sonata\AdminBundle\Block
{
use Sonata\AdminBundle\Admin\Pool;
use Sonata\AdminBundle\Templating\TemplateRegistry;
use Sonata\AdminBundle\Templating\TemplateRegistryInterface;
use Sonata\BlockBundle\Block\BlockContextInterface;
use Sonata\BlockBundle\Block\Service\AbstractBlockService;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolver;
class AdminListBlockService extends AbstractBlockService
{
protected $pool;
private $templateRegistry;
public function __construct(
$name,
EngineInterface $templating,
Pool $pool,
TemplateRegistryInterface $templateRegistry = null
) {
parent::__construct($name, $templating);
$this->pool = $pool;
$this->templateRegistry = $templateRegistry ?: new TemplateRegistry();
}
public function execute(BlockContextInterface $blockContext, Response $response = null)
{
$dashboardGroups = $this->pool->getDashboardGroups();
$settings = $blockContext->getSettings();
$visibleGroups = [];
foreach ($dashboardGroups as $name => $dashboardGroup) {
if (!$settings['groups'] || \in_array($name, $settings['groups'])) {
$visibleGroups[] = $dashboardGroup;
}
}
return $this->renderPrivateResponse($this->templateRegistry->getTemplate('list_block'), ['block'=> $blockContext->getBlock(),'settings'=> $settings,'admin_pool'=> $this->pool,'groups'=> $visibleGroups,
], $response);
}
public function getName()
{
return'Admin List';
}
public function configureSettings(OptionsResolver $resolver)
{
$resolver->setDefaults(['groups'=> false,
]);
$resolver->setAllowedTypes('groups', ['bool','array']);
}
}
}
namespace Sonata\AdminBundle\Builder
{
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Admin\FieldDescriptionInterface;
interface BuilderInterface
{
public function fixFieldDescription(AdminInterface $admin, FieldDescriptionInterface $fieldDescription);
}
}
namespace Sonata\AdminBundle\Builder
{
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Admin\FieldDescriptionInterface;
use Sonata\AdminBundle\Datagrid\DatagridInterface;
interface DatagridBuilderInterface extends BuilderInterface
{
public function addFilter(
DatagridInterface $datagrid,
$type,
FieldDescriptionInterface $fieldDescription,
AdminInterface $admin
);
public function getBaseDatagrid(AdminInterface $admin, array $values = []);
}
}
namespace Sonata\AdminBundle\Builder
{
use Sonata\AdminBundle\Admin\FieldDescriptionInterface;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormFactoryInterface;
interface FormContractorInterface extends BuilderInterface
{
public function __construct(FormFactoryInterface $formFactory);
public function getFormBuilder($name, array $options = []);
public function getDefaultOptions($type, FieldDescriptionInterface $fieldDescription);
}
}
namespace Sonata\AdminBundle\Builder
{
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Admin\FieldDescriptionCollection;
use Sonata\AdminBundle\Admin\FieldDescriptionInterface;
interface ListBuilderInterface extends BuilderInterface
{
public function getBaseList(array $options = []);
public function buildField($type, FieldDescriptionInterface $fieldDescription, AdminInterface $admin);
public function addField(
FieldDescriptionCollection $list,
$type,
FieldDescriptionInterface $fieldDescription,
AdminInterface $admin
);
}
}
namespace Sonata\AdminBundle\Builder
{
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Route\RouteCollection;
interface RouteBuilderInterface
{
public function build(AdminInterface $admin, RouteCollection $collection);
}
}
namespace Sonata\AdminBundle\Builder
{
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Admin\FieldDescriptionCollection;
use Sonata\AdminBundle\Admin\FieldDescriptionInterface;
interface ShowBuilderInterface extends BuilderInterface
{
public function getBaseList(array $options = []);
public function addField(
FieldDescriptionCollection $list,
$type,
FieldDescriptionInterface $fieldDescription,
AdminInterface $admin
);
}
}
namespace Sonata\AdminBundle\Datagrid
{
use Sonata\AdminBundle\Admin\FieldDescriptionCollection;
use Sonata\AdminBundle\Filter\FilterInterface;
use Symfony\Component\Form\FormInterface;
interface DatagridInterface
{
public function getPager();
public function getQuery();
public function getResults();
public function buildPager();
public function addFilter(FilterInterface $filter);
public function getFilters();
public function reorderFilters(array $keys);
public function getValues();
public function getColumns();
public function setValue($name, $operator, $value);
public function getForm();
public function getFilter($name);
public function hasFilter($name);
public function removeFilter($name);
public function hasActiveFilters();
public function hasDisplayableFilters();
}
}
namespace Sonata\AdminBundle\Datagrid
{
use Sonata\AdminBundle\Admin\FieldDescriptionCollection;
use Sonata\AdminBundle\Admin\FieldDescriptionInterface;
use Sonata\AdminBundle\Filter\FilterInterface;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Exception\UnexpectedTypeException;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
class Datagrid implements DatagridInterface
{
protected $filters = [];
protected $values;
protected $columns;
protected $pager;
protected $bound = false;
protected $query;
protected $formBuilder;
protected $form;
protected $results;
public function __construct(
ProxyQueryInterface $query,
FieldDescriptionCollection $columns,
PagerInterface $pager,
FormBuilderInterface $formBuilder,
array $values = []
) {
$this->pager = $pager;
$this->query = $query;
$this->values = $values;
$this->columns = $columns;
$this->formBuilder = $formBuilder;
}
public function getPager()
{
return $this->pager;
}
public function getResults()
{
$this->buildPager();
if (null === $this->results) {
$this->results = $this->pager->getResults();
}
return $this->results;
}
public function buildPager()
{
if ($this->bound) {
return;
}
foreach ($this->getFilters() as $name => $filter) {
list($type, $options) = $filter->getRenderSettings();
$this->formBuilder->add($filter->getFormName(), $type, $options);
}
$hiddenType = HiddenType::class;
$this->formBuilder->add('_sort_by', $hiddenType);
$this->formBuilder->get('_sort_by')->addViewTransformer(new CallbackTransformer(
function ($value) {
return $value;
},
function ($value) {
return $value instanceof FieldDescriptionInterface ? $value->getName() : $value;
}
));
$this->formBuilder->add('_sort_order', $hiddenType);
$this->formBuilder->add('_page', $hiddenType);
$this->formBuilder->add('_per_page', $hiddenType);
$this->form = $this->formBuilder->getForm();
$this->form->submit($this->values);
$data = $this->form->getData();
foreach ($this->getFilters() as $name => $filter) {
$this->values[$name] = isset($this->values[$name]) ? $this->values[$name] : null;
$filterFormName = $filter->getFormName();
if (isset($this->values[$filterFormName]['value']) &&''!== $this->values[$filterFormName]['value']) {
$filter->apply($this->query, $data[$filterFormName]);
}
}
if (isset($this->values['_sort_by'])) {
if (!$this->values['_sort_by'] instanceof FieldDescriptionInterface) {
throw new UnexpectedTypeException($this->values['_sort_by'], FieldDescriptionInterface::class);
}
if ($this->values['_sort_by']->isSortable()) {
$this->query->setSortBy($this->values['_sort_by']->getSortParentAssociationMapping(), $this->values['_sort_by']->getSortFieldMapping());
$this->query->setSortOrder(isset($this->values['_sort_order']) ? $this->values['_sort_order'] : null);
}
}
$maxPerPage = 25;
if (isset($this->values['_per_page'])) {
if (isset($this->values['_per_page']['value'])) {
$maxPerPage = $this->values['_per_page']['value'];
} else {
$maxPerPage = $this->values['_per_page'];
}
}
$this->pager->setMaxPerPage($maxPerPage);
$page = 1;
if (isset($this->values['_page'])) {
if (isset($this->values['_page']['value'])) {
$page = $this->values['_page']['value'];
} else {
$page = $this->values['_page'];
}
}
$this->pager->setPage($page);
$this->pager->setQuery($this->query);
$this->pager->init();
$this->bound = true;
}
public function addFilter(FilterInterface $filter)
{
$this->filters[$filter->getName()] = $filter;
}
public function hasFilter($name)
{
return isset($this->filters[$name]);
}
public function removeFilter($name)
{
unset($this->filters[$name]);
}
public function getFilter($name)
{
return $this->hasFilter($name) ? $this->filters[$name] : null;
}
public function getFilters()
{
return $this->filters;
}
public function reorderFilters(array $keys)
{
$this->filters = array_merge(array_flip($keys), $this->filters);
}
public function getValues()
{
return $this->values;
}
public function setValue($name, $operator, $value)
{
$this->values[$name] = ['type'=> $operator,'value'=> $value,
];
}
public function hasActiveFilters()
{
foreach ($this->filters as $name => $filter) {
if ($filter->isActive()) {
return true;
}
}
return false;
}
public function hasDisplayableFilters()
{
foreach ($this->filters as $name => $filter) {
$showFilter = $filter->getOption('show_filter', null);
if (($filter->isActive() && null === $showFilter) || (true === $showFilter)) {
return true;
}
}
return false;
}
public function getColumns()
{
return $this->columns;
}
public function getQuery()
{
return $this->query;
}
public function getForm()
{
$this->buildPager();
return $this->form;
}
}
}
namespace Sonata\AdminBundle\Mapper
{
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Builder\BuilderInterface;
abstract class BaseMapper
{
protected $admin;
protected $builder;
public function __construct(BuilderInterface $builder, AdminInterface $admin)
{
$this->builder = $builder;
$this->admin = $admin;
}
public function getAdmin()
{
return $this->admin;
}
abstract public function get($key);
abstract public function has($key);
abstract public function remove($key);
abstract public function reorder(array $keys);
}
}
namespace Sonata\AdminBundle\Datagrid
{
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Admin\FieldDescriptionInterface;
use Sonata\AdminBundle\Builder\DatagridBuilderInterface;
use Sonata\AdminBundle\Mapper\BaseMapper;
class DatagridMapper extends BaseMapper
{
protected $datagrid;
public function __construct(
DatagridBuilderInterface $datagridBuilder,
DatagridInterface $datagrid,
AdminInterface $admin
) {
parent::__construct($datagridBuilder, $admin);
$this->datagrid = $datagrid;
}
public function add(
$name,
$type = null,
array $filterOptions = [],
$fieldType = null,
$fieldOptions = null,
array $fieldDescriptionOptions = []
) {
if (\is_array($fieldOptions)) {
$filterOptions['field_options'] = $fieldOptions;
}
if ($fieldType) {
$filterOptions['field_type'] = $fieldType;
}
if ($name instanceof FieldDescriptionInterface) {
$fieldDescription = $name;
$fieldDescription->mergeOptions($filterOptions);
} elseif (\is_string($name)) {
if ($this->admin->hasFilterFieldDescription($name)) {
throw new \RuntimeException(sprintf('Duplicate field name "%s" in datagrid mapper. Names should be unique.', $name));
}
if (!isset($filterOptions['field_name'])) {
$filterOptions['field_name'] = substr(strrchr('.'.$name,'.'), 1);
}
$fieldDescription = $this->admin->getModelManager()->getNewFieldDescriptionInstance(
$this->admin->getClass(),
$name,
array_merge($filterOptions, $fieldDescriptionOptions)
);
} else {
throw new \RuntimeException('Unknown field name in datagrid mapper.'.' Field name should be either of FieldDescriptionInterface interface or string.');
}
$this->builder->addFilter($this->datagrid, $type, $fieldDescription, $this->admin);
return $this;
}
public function get($name)
{
return $this->datagrid->getFilter($name);
}
public function has($key)
{
return $this->datagrid->hasFilter($key);
}
final public function keys()
{
return array_keys($this->datagrid->getFilters());
}
public function remove($key)
{
$this->admin->removeFilterFieldDescription($key);
$this->datagrid->removeFilter($key);
return $this;
}
public function reorder(array $keys)
{
$this->datagrid->reorderFilters($keys);
return $this;
}
}
}
namespace Sonata\AdminBundle\Datagrid
{
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Admin\FieldDescriptionCollection;
use Sonata\AdminBundle\Admin\FieldDescriptionInterface;
use Sonata\AdminBundle\Builder\ListBuilderInterface;
use Sonata\AdminBundle\Mapper\BaseMapper;
class ListMapper extends BaseMapper
{
protected $list;
public function __construct(
ListBuilderInterface $listBuilder,
FieldDescriptionCollection $list,
AdminInterface $admin
) {
parent::__construct($listBuilder, $admin);
$this->list = $list;
}
public function addIdentifier($name, $type = null, array $fieldDescriptionOptions = [])
{
$fieldDescriptionOptions['identifier'] = true;
if (!isset($fieldDescriptionOptions['route']['name'])) {
$routeName = ($this->admin->hasAccess('edit') && $this->admin->hasRoute('edit')) ?'edit':'show';
$fieldDescriptionOptions['route']['name'] = $routeName;
}
if (!isset($fieldDescriptionOptions['route']['parameters'])) {
$fieldDescriptionOptions['route']['parameters'] = [];
}
return $this->add($name, $type, $fieldDescriptionOptions);
}
public function add($name, $type = null, array $fieldDescriptionOptions = [])
{
if ('_action'== $name &&'actions'== $type) {
if (isset($fieldDescriptionOptions['actions']['view'])) {
@trigger_error('Inline action "view" is deprecated since version 2.2.4 and will be removed in 4.0. '.'Use inline action "show" instead.',
E_USER_DEPRECATED
);
$fieldDescriptionOptions['actions']['show'] = $fieldDescriptionOptions['actions']['view'];
unset($fieldDescriptionOptions['actions']['view']);
}
}
if (\in_array($type, ['actions','batch','select'])) {
$fieldDescriptionOptions['virtual_field'] = true;
}
if ($name instanceof FieldDescriptionInterface) {
$fieldDescription = $name;
$fieldDescription->mergeOptions($fieldDescriptionOptions);
} elseif (\is_string($name)) {
if ($this->admin->hasListFieldDescription($name)) {
throw new \RuntimeException(sprintf('Duplicate field name "%s" in list mapper. Names should be unique.',
$name
));
}
$fieldDescription = $this->admin->getModelManager()->getNewFieldDescriptionInstance(
$this->admin->getClass(),
$name,
$fieldDescriptionOptions
);
} else {
throw new \RuntimeException('Unknown field name in list mapper. '.'Field name should be either of FieldDescriptionInterface interface or string.');
}
if (null === $fieldDescription->getLabel()) {
$fieldDescription->setOption('label',
$this->admin->getLabelTranslatorStrategy()->getLabel($fieldDescription->getName(),'list','label')
);
}
$this->builder->addField($this->list, $type, $fieldDescription, $this->admin);
return $this;
}
public function get($name)
{
return $this->list->get($name);
}
public function has($key)
{
return $this->list->has($key);
}
public function remove($key)
{
$this->admin->removeListFieldDescription($key);
$this->list->remove($key);
return $this;
}
final public function keys()
{
return array_keys($this->list->getElements());
}
public function reorder(array $keys)
{
$this->list->reorder($keys);
return $this;
}
}
}
namespace Sonata\AdminBundle\Datagrid
{
interface ProxyQueryInterface
{
public function __call($name, $args);
public function execute(array $params = [], $hydrationMode = null);
public function setSortBy($parentAssociationMappings, $fieldMapping);
public function getSortBy();
public function setSortOrder($sortOrder);
public function getSortOrder();
public function getSingleScalarResult();
public function setFirstResult($firstResult);
public function getFirstResult();
public function setMaxResults($maxResults);
public function getMaxResults();
public function getUniqueParameterId();
public function entityJoin(array $associationMappings);
}
}
namespace Sonata\AdminBundle\Exception
{
class ModelManagerException extends \Exception
{
}
}
namespace Sonata\AdminBundle\Exception
{
class NoValueException extends \Exception
{
}
}
namespace Sonata\AdminBundle\Filter
{
use Sonata\AdminBundle\Datagrid\ProxyQueryInterface;
interface FilterInterface
{
const CONDITION_OR ='OR';
const CONDITION_AND ='AND';
public function filter(ProxyQueryInterface $queryBuilder, $alias, $field, $value);
public function apply($query, $value);
public function getName();
public function getFormName();
public function getLabel();
public function setLabel($label);
public function getDefaultOptions();
public function getOption($name, $default = null);
public function setOption($name, $value);
public function initialize($name, array $options = []);
public function getFieldName();
public function getParentAssociationMappings();
public function getFieldMapping();
public function getAssociationMapping();
public function getFieldOptions();
public function getFieldOption($name, $default = null);
public function setFieldOption($name, $value);
public function getFieldType();
public function getRenderSettings();
public function isActive();
public function setCondition($condition);
public function getCondition();
public function getTranslationDomain();
}
}
namespace Sonata\AdminBundle\Filter
{
use Symfony\Component\Form\Extension\Core\Type\TextType;
abstract class Filter implements FilterInterface
{
protected $name = null;
protected $value = null;
protected $options = [];
protected $condition;
public function initialize($name, array $options = [])
{
$this->name = $name;
$this->setOptions($options);
}
public function getName()
{
return $this->name;
}
public function getFormName()
{
return str_replace('.','__', $this->name);
}
public function getOption($name, $default = null)
{
if (array_key_exists($name, $this->options)) {
return $this->options[$name];
}
return $default;
}
public function setOption($name, $value)
{
$this->options[$name] = $value;
}
public function getFieldType()
{
return $this->getOption('field_type', TextType::class);
}
public function getFieldOptions()
{
return $this->getOption('field_options', ['required'=> false]);
}
public function getFieldOption($name, $default = null)
{
if (isset($this->options['field_options'][$name]) && \is_array($this->options['field_options'])) {
return $this->options['field_options'][$name];
}
return $default;
}
public function setFieldOption($name, $value)
{
$this->options['field_options'][$name] = $value;
}
public function getLabel()
{
return $this->getOption('label');
}
public function setLabel($label)
{
$this->setOption('label', $label);
}
public function getFieldName()
{
$fieldName = $this->getOption('field_name');
if (!$fieldName) {
throw new \RuntimeException(sprintf('The option `field_name` must be set for field: `%s`', $this->getName()));
}
return $fieldName;
}
public function getParentAssociationMappings()
{
return $this->getOption('parent_association_mappings', []);
}
public function getFieldMapping()
{
$fieldMapping = $this->getOption('field_mapping');
if (!$fieldMapping) {
throw new \RuntimeException(sprintf('The option `field_mapping` must be set for field: `%s`', $this->getName()));
}
return $fieldMapping;
}
public function getAssociationMapping()
{
$associationMapping = $this->getOption('association_mapping');
if (!$associationMapping) {
throw new \RuntimeException(sprintf('The option `association_mapping` must be set for field: `%s`', $this->getName()));
}
return $associationMapping;
}
public function setOptions(array $options)
{
$this->options = array_merge(
['show_filter'=> null,'advanced_filter'=> true],
$this->getDefaultOptions(),
$options
);
}
public function getOptions()
{
return $this->options;
}
public function setValue($value)
{
$this->value = $value;
}
public function getValue()
{
return $this->value;
}
public function isActive()
{
$values = $this->getValue();
return isset($values['value'])
&& false !== $values['value']
&&''!== $values['value'];
}
public function setCondition($condition)
{
$this->condition = $condition;
}
public function getCondition()
{
return $this->condition;
}
public function getTranslationDomain()
{
return $this->getOption('translation_domain');
}
}
}
namespace Sonata\AdminBundle\Filter
{
interface FilterFactoryInterface
{
public function create($name, $type, array $options = []);
}
}
namespace Sonata\AdminBundle\Filter
{
use Symfony\Component\DependencyInjection\ContainerInterface;
class FilterFactory implements FilterFactoryInterface
{
protected $container;
protected $types;
public function __construct(ContainerInterface $container, array $types = [])
{
$this->container = $container;
$this->types = $types;
}
public function create($name, $type, array $options = [])
{
if (!$type) {
throw new \RuntimeException('The type must be defined');
}
$id = isset($this->types[$type]) ? $this->types[$type] : false;
if ($id) {
$filter = $this->container->get($id);
} elseif (class_exists($type)) {
$filter = new $type();
} else {
throw new \RuntimeException(sprintf('No attached service to type named `%s`', $type));
}
if (!$filter instanceof FilterInterface) {
throw new \RuntimeException(sprintf('The service `%s` must implement `FilterInterface`', $type));
}
$filter->initialize($name, $options);
return $filter;
}
}
}
namespace Symfony\Component\Form
{
use Symfony\Component\Form\Exception\TransformationFailedException;
interface DataTransformerInterface
{
public function transform($value);
public function reverseTransform($value);
}
}
namespace Sonata\AdminBundle\Form\DataTransformer
{
use Sonata\AdminBundle\Model\ModelManagerInterface;
use Symfony\Component\Form\DataTransformerInterface;
class ArrayToModelTransformer implements DataTransformerInterface
{
protected $modelManager;
protected $className;
public function __construct(ModelManagerInterface $modelManager, $className)
{
$this->modelManager = $modelManager;
$this->className = $className;
}
public function reverseTransform($array)
{
if ($array instanceof $this->className) {
return $array;
}
$instance = new $this->className();
if (!\is_array($array)) {
return $instance;
}
return $this->modelManager->modelReverseTransform($this->className, $array);
}
public function transform($value)
{
return $value;
}
}
}
namespace Sonata\AdminBundle\Form\DataTransformer
{
use Doctrine\Common\Util\ClassUtils;
use Sonata\AdminBundle\Form\ChoiceList\ModelChoiceList;
use Sonata\AdminBundle\Form\ChoiceList\ModelChoiceLoader;
use Sonata\AdminBundle\Model\ModelManagerInterface;
use Sonata\CoreBundle\Model\Adapter\AdapterInterface;
use Symfony\Component\Form\ChoiceList\LazyChoiceList;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\RuntimeException;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Symfony\Component\Form\Exception\UnexpectedTypeException;
class ModelsToArrayTransformer implements DataTransformerInterface
{
protected $modelManager;
protected $class;
protected $choiceList;
public function __construct($choiceList, $modelManager, $class = null)
{
$args = \func_get_args();
if (3 == \func_num_args()) {
$this->legacyConstructor($args);
} else {
$this->modelManager = $args[0];
$this->class = $args[1];
}
}
public function __get($name)
{
if ('choiceList'=== $name) {
$this->triggerDeprecation();
}
return $this->$name;
}
public function __set($name, $value)
{
if ('choiceList'=== $name) {
$this->triggerDeprecation();
}
$this->$name = $value;
}
public function __isset($name)
{
if ('choiceList'=== $name) {
$this->triggerDeprecation();
}
return isset($this->$name);
}
public function __unset($name)
{
if ('choiceList'=== $name) {
$this->triggerDeprecation();
}
unset($this->$name);
}
public function transform($collection)
{
if (null === $collection) {
return [];
}
$array = [];
foreach ($collection as $key => $entity) {
$id = implode(AdapterInterface::ID_SEPARATOR, $this->getIdentifierValues($entity));
$array[] = $id;
}
return $array;
}
public function reverseTransform($keys)
{
if (!\is_array($keys)) {
throw new UnexpectedTypeException($keys,'array');
}
$collection = $this->modelManager->getModelCollectionInstance($this->class);
$notFound = [];
foreach ($keys as $key) {
if ($entity = $this->modelManager->find($this->class, $key)) {
$collection[] = $entity;
} else {
$notFound[] = $key;
}
}
if (\count($notFound) > 0) {
throw new TransformationFailedException(sprintf('The entities with keys "%s" could not be found', implode('", "', $notFound)));
}
return $collection;
}
private function legacyConstructor($args)
{
$choiceList = $args[0];
if (!$choiceList instanceof ModelChoiceList
&& !$choiceList instanceof ModelChoiceLoader
&& !$choiceList instanceof LazyChoiceList) {
throw new RuntimeException('First param passed to ModelsToArrayTransformer should be instance of
                ModelChoiceLoader or ModelChoiceList or LazyChoiceList');
}
$this->choiceList = $choiceList;
$this->modelManager = $args[1];
$this->class = $args[2];
}
private function getIdentifierValues($entity)
{
try {
return $this->modelManager->getIdentifierValues($entity);
} catch (\Exception $e) {
throw new \InvalidArgumentException(sprintf('Unable to retrieve the identifier values for entity %s', ClassUtils::getClass($entity)), 0, $e);
}
}
private function triggerDeprecation()
{
@trigger_error(sprintf('Using the "%s::$choiceList" property is deprecated since version 3.12 and will be removed in 4.0.',
__CLASS__),
E_USER_DEPRECATED)
;
}
}
}
namespace Sonata\AdminBundle\Form\DataTransformer
{
use Sonata\AdminBundle\Model\ModelManagerInterface;
use Symfony\Component\Form\DataTransformerInterface;
class ModelToIdTransformer implements DataTransformerInterface
{
protected $modelManager;
protected $className;
public function __construct(ModelManagerInterface $modelManager, $className)
{
$this->modelManager = $modelManager;
$this->className = $className;
}
public function reverseTransform($newId)
{
if (empty($newId) && !\in_array($newId, ['0', 0], true)) {
return;
}
return $this->modelManager->find($this->className, $newId);
}
public function transform($entity)
{
if (empty($entity)) {
return;
}
return $this->modelManager->getNormalizedIdentifier($entity);
}
}
}
namespace Sonata\AdminBundle\Form\EventListener
{
use Sonata\AdminBundle\Model\ModelManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
class MergeCollectionListener implements EventSubscriberInterface
{
protected $modelManager;
public function __construct(ModelManagerInterface $modelManager)
{
$this->modelManager = $modelManager;
}
public static function getSubscribedEvents()
{
return [
FormEvents::SUBMIT => ['onBind', 10],
];
}
public function onBind(FormEvent $event)
{
$collection = $event->getForm()->getData();
$data = $event->getData();
$event->stopPropagation();
if (!$collection) {
$collection = $data;
} elseif (0 === \count($data)) {
$this->modelManager->collectionClear($collection);
} else {
foreach ($collection as $entity) {
if (!$this->modelManager->collectionHasElement($data, $entity)) {
$this->modelManager->collectionRemoveElement($collection, $entity);
} else {
$this->modelManager->collectionRemoveElement($data, $entity);
}
}
foreach ($data as $entity) {
$this->modelManager->collectionAddElement($collection, $entity);
}
}
$event->setData($collection);
}
}
}
namespace Sonata\AdminBundle\Form\Extension\Field\Type
{
use Sonata\AdminBundle\Admin\FieldDescriptionInterface;
use Sonata\AdminBundle\Exception\NoValueException;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
class FormTypeFieldExtension extends AbstractTypeExtension
{
protected $defaultClasses = [];
protected $options;
public function __construct(array $defaultClasses, array $options)
{
$this->defaultClasses = $defaultClasses;
$this->options = $options;
}
public function buildForm(FormBuilderInterface $builder, array $options)
{
$sonataAdmin = ['name'=> null,'admin'=> null,'value'=> null,'edit'=>'standard','inline'=>'natural','field_description'=> null,'block_name'=> false,'options'=> $this->options,
];
$builder->setAttribute('sonata_admin_enabled', false);
$builder->setAttribute('sonata_help', false);
if ($options['sonata_field_description'] instanceof FieldDescriptionInterface) {
$fieldDescription = $options['sonata_field_description'];
$sonataAdmin['admin'] = $fieldDescription->getAdmin();
$sonataAdmin['field_description'] = $fieldDescription;
$sonataAdmin['name'] = $fieldDescription->getName();
$sonataAdmin['edit'] = $fieldDescription->getOption('edit','standard');
$sonataAdmin['inline'] = $fieldDescription->getOption('inline','natural');
$sonataAdmin['block_name'] = $fieldDescription->getOption('block_name', false);
$sonataAdmin['class'] = $this->getClass($builder);
$builder->setAttribute('sonata_admin_enabled', true);
}
$builder->setAttribute('sonata_admin', $sonataAdmin);
}
public function buildView(FormView $view, FormInterface $form, array $options)
{
$sonataAdmin = $form->getConfig()->getAttribute('sonata_admin');
$sonataAdminHelp = isset($options['sonata_help']) ? $options['sonata_help'] : null;
if ($view->parent && $view->parent->vars['sonata_admin_enabled'] && !$sonataAdmin['admin']) {
$blockPrefixes = $view->vars['block_prefixes'];
$baseName = str_replace('.','_', $view->parent->vars['sonata_admin_code']);
$baseType = $blockPrefixes[\count($blockPrefixes) - 2];
$blockSuffix = preg_replace('#^_([a-z0-9]{14})_(.++)$#','$2', array_pop($blockPrefixes));
$blockPrefixes[] = sprintf('%s_%s', $baseName, $baseType);
$blockPrefixes[] = sprintf('%s_%s_%s_%s', $baseName, $baseType, $view->parent->vars['name'], $view->vars['name']);
$blockPrefixes[] = sprintf('%s_%s_%s_%s', $baseName, $baseType, $view->parent->vars['name'], $blockSuffix);
$view->vars['block_prefixes'] = $blockPrefixes;
$view->vars['sonata_admin_enabled'] = true;
$view->vars['sonata_admin'] = ['admin'=> false,'field_description'=> false,'name'=> false,'edit'=>'standard','inline'=>'natural','block_name'=> false,'class'=> false,'options'=> $this->options,
];
$view->vars['sonata_help'] = $sonataAdminHelp;
$view->vars['sonata_admin_code'] = $view->parent->vars['sonata_admin_code'];
return;
}
if ($sonataAdmin && $form->getConfig()->getAttribute('sonata_admin_enabled', true)) {
$sonataAdmin['value'] = $form->getData();
$blockPrefixes = $view->vars['block_prefixes'];
$baseName = str_replace('.','_', $sonataAdmin['admin']->getCode());
$baseType = $blockPrefixes[\count($blockPrefixes) - 2];
$blockSuffix = preg_replace('#^_([a-z0-9]{14})_(.++)$#','$2', array_pop($blockPrefixes));
$blockPrefixes[] = sprintf('%s_%s', $baseName, $baseType);
$blockPrefixes[] = sprintf('%s_%s_%s', $baseName, $sonataAdmin['name'], $baseType);
$blockPrefixes[] = sprintf('%s_%s_%s_%s', $baseName, $sonataAdmin['name'], $baseType, $blockSuffix);
if (isset($sonataAdmin['block_name']) && false !== $sonataAdmin['block_name']) {
$blockPrefixes[] = $sonataAdmin['block_name'];
}
$view->vars['block_prefixes'] = $blockPrefixes;
$view->vars['sonata_admin_enabled'] = true;
$view->vars['sonata_admin'] = $sonataAdmin;
$view->vars['sonata_admin_code'] = $sonataAdmin['admin']->getCode();
$attr = $view->vars['attr'];
if (!isset($attr['class']) && isset($sonataAdmin['class'])) {
$attr['class'] = $sonataAdmin['class'];
}
$view->vars['attr'] = $attr;
} else {
$view->vars['sonata_admin_enabled'] = false;
}
$view->vars['sonata_help'] = $sonataAdminHelp;
$view->vars['sonata_admin'] = $sonataAdmin;
}
public function getExtendedType()
{
return FormType::class;
}
public function setDefaultOptions(OptionsResolverInterface $resolver)
{
$this->configureOptions($resolver);
}
public function configureOptions(OptionsResolver $resolver)
{
$resolver->setDefaults(['sonata_admin'=> null,'sonata_field_description'=> null,'label_render'=> true,'sonata_help'=> null,
]);
}
public function getValueFromFieldDescription($object, FieldDescriptionInterface $fieldDescription)
{
$value = null;
if (!$object) {
return $value;
}
try {
$value = $fieldDescription->getValue($object);
} catch (NoValueException $e) {
if ($fieldDescription->getAssociationAdmin()) {
$value = $fieldDescription->getAssociationAdmin()->getNewInstance();
}
}
return $value;
}
protected function getClass(FormBuilderInterface $formBuilder)
{
foreach ($this->getTypes($formBuilder) as $type) {
if (!method_exists($type,'getName')) {
$name = \get_class($type);
} else {
$name = $type->getName();
}
if (isset($this->defaultClasses[$name])) {
return $this->defaultClasses[$name];
}
}
return'';
}
protected function getTypes(FormBuilderInterface $formBuilder)
{
$types = [];
for ($type = $formBuilder->getType(); null !== $type; $type = $type->getParent()) {
array_unshift($types, $type->getInnerType());
}
return $types;
}
}
}
namespace Sonata\AdminBundle\Mapper
{
use Sonata\AdminBundle\Admin\AbstractAdmin;
abstract class BaseGroupedMapper extends BaseMapper
{
protected $currentGroup;
protected $currentTab;
protected $apply;
public function with($name, array $options = [])
{
$defaultOptions = ['collapsed'=> false,'class'=> false,'description'=> false,'label'=> $name,'translation_domain'=> null,'name'=> $name,'box_class'=>'box box-primary',
];
if ($this->admin instanceof AbstractAdmin && $pool = $this->admin->getConfigurationPool()) {
if ($pool->getContainer()->getParameter('sonata.admin.configuration.translate_group_label')) {
$defaultOptions['label'] = $this->admin->getLabelTranslatorStrategy()->getLabel($name, $this->getName(),'group');
}
}
$code = $name;
if (array_key_exists('tab', $options) && $options['tab']) {
$tabs = $this->getTabs();
if ($this->currentTab) {
if (isset($tabs[$this->currentTab]['auto_created']) && true === $tabs[$this->currentTab]['auto_created']) {
throw new \RuntimeException('New tab was added automatically when you have added field or group. You should close current tab before adding new one OR add tabs before adding groups and fields.');
}
throw new \RuntimeException(sprintf('You should close previous tab "%s" with end() before adding new tab "%s".', $this->currentTab, $name));
} elseif ($this->currentGroup) {
throw new \RuntimeException(sprintf('You should open tab before adding new group "%s".', $name));
}
if (!isset($tabs[$name])) {
$tabs[$name] = [];
}
$tabs[$code] = array_merge($defaultOptions, ['auto_created'=> false,'groups'=> [],
], $tabs[$code], $options);
$this->currentTab = $code;
} else {
if ($this->currentGroup) {
throw new \RuntimeException(sprintf('You should close previous group "%s" with end() before adding new tab "%s".', $this->currentGroup, $name));
}
if (!$this->currentTab) {
$this->with('default', ['tab'=> true,'auto_created'=> true,'translation_domain'=> isset($options['translation_domain']) ? $options['translation_domain'] : null,
]); }
if ('default'!== $this->currentTab) {
$code = $this->currentTab.'.'.$name; }
$groups = $this->getGroups();
if (!isset($groups[$code])) {
$groups[$code] = [];
}
$groups[$code] = array_merge($defaultOptions, ['fields'=> [],
], $groups[$code], $options);
$this->currentGroup = $code;
$this->setGroups($groups);
$tabs = $this->getTabs();
}
if ($this->currentGroup && isset($tabs[$this->currentTab]) && !\in_array($this->currentGroup, $tabs[$this->currentTab]['groups'])) {
$tabs[$this->currentTab]['groups'][] = $this->currentGroup;
}
$this->setTabs($tabs);
return $this;
}
public function ifTrue($bool)
{
if (null !== $this->apply) {
throw new \RuntimeException('Cannot nest ifTrue or ifFalse call');
}
$this->apply = (true === $bool);
return $this;
}
public function ifFalse($bool)
{
if (null !== $this->apply) {
throw new \RuntimeException('Cannot nest ifTrue or ifFalse call');
}
$this->apply = (false === $bool);
return $this;
}
public function ifEnd()
{
$this->apply = null;
return $this;
}
public function tab($name, array $options = [])
{
return $this->with($name, array_merge($options, ['tab'=> true]));
}
public function end()
{
if (null !== $this->currentGroup) {
$this->currentGroup = null;
} elseif (null !== $this->currentTab) {
$this->currentTab = null;
} else {
throw new \RuntimeException('No open tabs or groups, you cannot use end()');
}
return $this;
}
public function hasOpenTab()
{
return null !== $this->currentTab;
}
abstract protected function getGroups();
abstract protected function getTabs();
abstract protected function setGroups(array $groups);
abstract protected function setTabs(array $tabs);
protected function getName()
{
@trigger_error(__METHOD__.' should be implemented and will be abstract in 4.0.', E_USER_DEPRECATED);
return'default';
}
protected function addFieldToCurrentGroup($fieldName)
{
$currentGroup = $this->getCurrentGroupName();
$groups = $this->getGroups();
$groups[$currentGroup]['fields'][$fieldName] = $fieldName;
$this->setGroups($groups);
return $groups[$currentGroup];
}
protected function getCurrentGroupName()
{
if (!$this->currentGroup) {
$this->with($this->admin->getLabel(), ['auto_created'=> true]);
}
return $this->currentGroup;
}
}
}
namespace Sonata\AdminBundle\Form
{
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Builder\FormContractorInterface;
use Sonata\AdminBundle\Form\Type\CollectionType;
use Sonata\AdminBundle\Mapper\BaseGroupedMapper;
use Symfony\Component\Form\Extension\Core\Type\CollectionType as SymfonyCollectionType;
use Symfony\Component\Form\FormBuilderInterface;
class FormMapper extends BaseGroupedMapper
{
protected $formBuilder;
public function __construct(
FormContractorInterface $formContractor,
FormBuilderInterface $formBuilder,
AdminInterface $admin
) {
parent::__construct($formContractor, $admin);
$this->formBuilder = $formBuilder;
}
public function reorder(array $keys)
{
$this->admin->reorderFormGroup($this->getCurrentGroupName(), $keys);
return $this;
}
public function add($name, $type = null, array $options = [], array $fieldDescriptionOptions = [])
{
if (null !== $this->apply && !$this->apply) {
return $this;
}
if ($name instanceof FormBuilderInterface) {
$fieldName = $name->getName();
} else {
$fieldName = $name;
}
if (!$name instanceof FormBuilderInterface && !isset($options['property_path'])) {
$options['property_path'] = $fieldName;
$fieldName = $this->sanitizeFieldName($fieldName);
}
if ('collection'=== $type || SymfonyCollectionType::class === $type) {
$type = CollectionType::class;
}
$label = $fieldName;
$group = $this->addFieldToCurrentGroup($label);
if ($name instanceof FormBuilderInterface && null === $type) {
$fieldDescriptionOptions['type'] = \get_class($name->getType()->getInnerType());
}
if (!isset($fieldDescriptionOptions['type']) && \is_string($type)) {
$fieldDescriptionOptions['type'] = $type;
}
if ($group['translation_domain'] && !isset($fieldDescriptionOptions['translation_domain'])) {
$fieldDescriptionOptions['translation_domain'] = $group['translation_domain'];
}
$fieldDescription = $this->admin->getModelManager()->getNewFieldDescriptionInstance(
$this->admin->getClass(),
$name instanceof FormBuilderInterface ? $name->getName() : $name,
$fieldDescriptionOptions
);
$this->builder->fixFieldDescription($this->admin, $fieldDescription, $fieldDescriptionOptions);
if ($fieldName != $name) {
$fieldDescription->setName($fieldName);
}
$this->admin->addFormFieldDescription($fieldName, $fieldDescription);
if ($name instanceof FormBuilderInterface) {
$this->formBuilder->add($name);
} else {
$options = array_replace_recursive($this->builder->getDefaultOptions($type, $fieldDescription), $options);
if (!isset($options['label_render'])) {
$options['label_render'] = false;
}
if (!isset($options['label'])) {
$options['label'] = $this->admin->getLabelTranslatorStrategy()->getLabel($fieldDescription->getName(),'form','label');
}
$help = null;
if (isset($options['help'])) {
$help = $options['help'];
unset($options['help']);
}
$this->formBuilder->add($fieldDescription->getName(), $type, $options);
if (null !== $help) {
$this->admin->getFormFieldDescription($fieldDescription->getName())->setHelp($help);
}
}
return $this;
}
public function get($name)
{
$name = $this->sanitizeFieldName($name);
return $this->formBuilder->get($name);
}
public function has($key)
{
$key = $this->sanitizeFieldName($key);
return $this->formBuilder->has($key);
}
final public function keys()
{
return array_keys($this->formBuilder->all());
}
public function remove($key)
{
$key = $this->sanitizeFieldName($key);
$this->admin->removeFormFieldDescription($key);
$this->admin->removeFieldFromFormGroup($key);
$this->formBuilder->remove($key);
return $this;
}
public function removeGroup($group, $tab ='default', $deleteEmptyTab = false)
{
$groups = $this->getGroups();
if ('default'!== $tab) {
$group = $tab.'.'.$group;
}
if (isset($groups[$group])) {
foreach ($groups[$group]['fields'] as $field) {
$this->remove($field);
}
}
unset($groups[$group]);
$tabs = $this->getTabs();
$key = array_search($group, $tabs[$tab]['groups']);
if (false !== $key) {
unset($tabs[$tab]['groups'][$key]);
}
if ($deleteEmptyTab && 0 == \count($tabs[$tab]['groups'])) {
unset($tabs[$tab]);
}
$this->setTabs($tabs);
$this->setGroups($groups);
return $this;
}
public function getFormBuilder()
{
return $this->formBuilder;
}
public function create($name, $type = null, array $options = [])
{
return $this->formBuilder->create($name, $type, $options);
}
public function setHelps(array $helps = [])
{
foreach ($helps as $name => $help) {
$this->addHelp($name, $help);
}
return $this;
}
public function addHelp($name, $help)
{
if ($this->admin->hasFormFieldDescription($name)) {
$this->admin->getFormFieldDescription($name)->setHelp($help);
}
return $this;
}
protected function sanitizeFieldName($fieldName)
{
return str_replace(['__','.'], ['____','__'], $fieldName);
}
protected function getGroups()
{
return $this->admin->getFormGroups();
}
protected function setGroups(array $groups)
{
$this->admin->setFormGroups($groups);
}
protected function getTabs()
{
return $this->admin->getFormTabs();
}
protected function setTabs(array $tabs)
{
$this->admin->setFormTabs($tabs);
}
protected function getName()
{
return'form';
}
}
}
namespace Sonata\AdminBundle\Form\Type
{
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Admin\FieldDescriptionInterface;
use Sonata\AdminBundle\Form\DataTransformer\ArrayToModelTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\PropertyAccess\Exception\NoSuchIndexException;
use Symfony\Component\PropertyAccess\PropertyAccessor;
class AdminType extends AbstractType
{
public function buildForm(FormBuilderInterface $builder, array $options)
{
$admin = clone $this->getAdmin($options);
if ($admin->hasParentFieldDescription()) {
$admin->getParentFieldDescription()->setAssociationAdmin($admin);
}
if ($options['delete'] && $admin->hasAccess('delete')) {
if (!array_key_exists('translation_domain', $options['delete_options']['type_options'])) {
$options['delete_options']['type_options']['translation_domain'] = $admin->getTranslationDomain();
}
$builder->add('_delete', $options['delete_options']['type'], $options['delete_options']['type_options']);
}
if (null === $builder->getData()) {
$p = new PropertyAccessor(false, true);
try {
$parentSubject = $admin->getParentFieldDescription()->getAdmin()->getSubject();
if (null !== $parentSubject && false !== $parentSubject) {
if ($this->getFieldDescription($options)->getFieldName() === $options['property_path']) {
$path = $options['property_path'];
} else {
$path = $this->getFieldDescription($options)->getFieldName().$options['property_path'];
}
$subject = $p->getValue($parentSubject, $path);
$builder->setData($subject);
}
} catch (NoSuchIndexException $e) {
}
}
$admin->setSubject($builder->getData());
$admin->defineFormBuilder($builder);
$builder->addModelTransformer(new ArrayToModelTransformer($admin->getModelManager(), $admin->getClass()));
}
public function buildView(FormView $view, FormInterface $form, array $options)
{
$view->vars['btn_add'] = $options['btn_add'];
$view->vars['btn_list'] = $options['btn_list'];
$view->vars['btn_delete'] = $options['btn_delete'];
$view->vars['btn_catalogue'] = $options['btn_catalogue'];
}
public function setDefaultOptions(OptionsResolverInterface $resolver)
{
$this->configureOptions($resolver);
}
public function configureOptions(OptionsResolver $resolver)
{
$resolver->setDefaults(['delete'=> function (Options $options) {
return false !== $options['btn_delete'];
},'delete_options'=> ['type'=> CheckboxType::class,'type_options'=> ['required'=> false,'mapped'=> false,
],
],'auto_initialize'=> false,'btn_add'=>'link_add','btn_list'=>'link_list','btn_delete'=>'link_delete','btn_catalogue'=>'SonataAdminBundle',
]);
}
public function getName()
{
return $this->getBlockPrefix();
}
public function getBlockPrefix()
{
return'sonata_type_admin';
}
protected function getFieldDescription(array $options)
{
if (!isset($options['sonata_field_description'])) {
throw new \RuntimeException('Please provide a valid `sonata_field_description` option');
}
return $options['sonata_field_description'];
}
protected function getAdmin(array $options)
{
return $this->getFieldDescription($options)->getAssociationAdmin();
}
}
}
namespace Sonata\AdminBundle\Form\Type\Filter
{
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType as FormChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Translation\TranslatorInterface;
class ChoiceType extends AbstractType
{
const TYPE_CONTAINS = 1;
const TYPE_NOT_CONTAINS = 2;
const TYPE_EQUAL = 3;
protected $translator;
public function __construct(TranslatorInterface $translator)
{
$this->translator = $translator;
}
public function getName()
{
return $this->getBlockPrefix();
}
public function getBlockPrefix()
{
return'sonata_type_filter_choice';
}
public function buildForm(FormBuilderInterface $builder, array $options)
{
$choices = ['label_type_contains'=> self::TYPE_CONTAINS,'label_type_not_contains'=> self::TYPE_NOT_CONTAINS,'label_type_equals'=> self::TYPE_EQUAL,
];
$operatorChoices = [];
if ('hidden'!== $options['operator_type'] && HiddenType::class !== $options['operator_type']) {
$operatorChoices['choice_translation_domain'] ='SonataAdminBundle';
if (method_exists(FormTypeInterface::class,'setDefaultOptions')) {
$operatorChoices['choices_as_values'] = true;
}
$operatorChoices['choices'] = $choices;
}
$builder
->add('type', $options['operator_type'], array_merge(['required'=> false], $options['operator_options'], $operatorChoices))
->add('value', $options['field_type'], array_merge(['required'=> false], $options['field_options']))
;
}
public function setDefaultOptions(OptionsResolverInterface $resolver)
{
$this->configureOptions($resolver);
}
public function configureOptions(OptionsResolver $resolver)
{
$resolver->setDefaults(['field_type'=> FormChoiceType::class,'field_options'=> [],'operator_type'=> FormChoiceType::class,'operator_options'=> [],
]);
}
}
}
namespace Sonata\AdminBundle\Form\Type\Filter
{
use Sonata\CoreBundle\Form\Type\DateRangeType as FormDateRangeType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType as FormChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Translation\TranslatorInterface;
class DateRangeType extends AbstractType
{
const TYPE_BETWEEN = 1;
const TYPE_NOT_BETWEEN = 2;
protected $translator;
public function __construct(TranslatorInterface $translator)
{
$this->translator = $translator;
}
public function getName()
{
return $this->getBlockPrefix();
}
public function getBlockPrefix()
{
return'sonata_type_filter_date_range';
}
public function buildForm(FormBuilderInterface $builder, array $options)
{
$choices = ['label_date_type_between'=> self::TYPE_BETWEEN,'label_date_type_not_between'=> self::TYPE_NOT_BETWEEN,
];
$choiceOptions = ['required'=> false,
];
$choiceOptions['choice_translation_domain'] ='SonataAdminBundle';
if (method_exists(FormTypeInterface::class,'setDefaultOptions')) {
$choiceOptions['choices_as_values'] = true;
}
$choiceOptions['choices'] = $choices;
$builder
->add('type', FormChoiceType::class, $choiceOptions)
->add('value', $options['field_type'], $options['field_options'])
;
}
public function setDefaultOptions(OptionsResolverInterface $resolver)
{
$this->configureOptions($resolver);
}
public function configureOptions(OptionsResolver $resolver)
{
$resolver->setDefaults(['field_type'=> FormDateRangeType::class,'field_options'=> ['format'=>'yyyy-MM-dd'],
]);
}
}
}
namespace Sonata\AdminBundle\Form\Type\Filter
{
use Sonata\CoreBundle\Form\Type\DateTimeRangeType as FormDateTimeRangeType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType as FormChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Translation\TranslatorInterface;
class DateTimeRangeType extends AbstractType
{
const TYPE_BETWEEN = 1;
const TYPE_NOT_BETWEEN = 2;
protected $translator;
public function __construct(TranslatorInterface $translator)
{
$this->translator = $translator;
}
public function getName()
{
return $this->getBlockPrefix();
}
public function getBlockPrefix()
{
return'sonata_type_filter_datetime_range';
}
public function buildForm(FormBuilderInterface $builder, array $options)
{
$choices = ['label_date_type_between'=> self::TYPE_BETWEEN,'label_date_type_not_between'=> self::TYPE_NOT_BETWEEN,
];
$choiceOptions = ['required'=> false,
];
$choiceOptions['choice_translation_domain'] ='SonataAdminBundle';
if (method_exists(FormTypeInterface::class,'setDefaultOptions')) {
$choiceOptions['choices_as_values'] = true;
}
$choiceOptions['choices'] = $choices;
$builder
->add('type', FormChoiceType::class, $choiceOptions)
->add('value', $options['field_type'], $options['field_options'])
;
}
public function setDefaultOptions(OptionsResolverInterface $resolver)
{
$this->configureOptions($resolver);
}
public function configureOptions(OptionsResolver $resolver)
{
$resolver->setDefaults(['field_type'=> FormDateTimeRangeType::class,'field_options'=> ['date_format'=>'yyyy-MM-dd'],
]);
}
}
}
namespace Sonata\AdminBundle\Form\Type\Filter
{
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType as FormChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType as FormDateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Translation\TranslatorInterface;
class DateTimeType extends AbstractType
{
const TYPE_GREATER_EQUAL = 1;
const TYPE_GREATER_THAN = 2;
const TYPE_EQUAL = 3;
const TYPE_LESS_EQUAL = 4;
const TYPE_LESS_THAN = 5;
const TYPE_NULL = 6;
const TYPE_NOT_NULL = 7;
protected $translator;
public function __construct(TranslatorInterface $translator)
{
$this->translator = $translator;
}
public function getName()
{
return $this->getBlockPrefix();
}
public function getBlockPrefix()
{
return'sonata_type_filter_datetime';
}
public function buildForm(FormBuilderInterface $builder, array $options)
{
$choices = ['label_date_type_equal'=> self::TYPE_EQUAL,'label_date_type_greater_equal'=> self::TYPE_GREATER_EQUAL,'label_date_type_greater_than'=> self::TYPE_GREATER_THAN,'label_date_type_less_equal'=> self::TYPE_LESS_EQUAL,'label_date_type_less_than'=> self::TYPE_LESS_THAN,'label_date_type_null'=> self::TYPE_NULL,'label_date_type_not_null'=> self::TYPE_NOT_NULL,
];
$choiceOptions = ['required'=> false,
];
$choiceOptions['choice_translation_domain'] ='SonataAdminBundle';
if (method_exists(FormTypeInterface::class,'setDefaultOptions')) {
$choiceOptions['choices_as_values'] = true;
}
$choiceOptions['choices'] = $choices;
$builder
->add('type', FormChoiceType::class, $choiceOptions)
->add('value', $options['field_type'], array_merge(['required'=> false], $options['field_options']))
;
}
public function setDefaultOptions(OptionsResolverInterface $resolver)
{
$this->configureOptions($resolver);
}
public function configureOptions(OptionsResolver $resolver)
{
$resolver->setDefaults(['field_type'=> FormDateTimeType::class,'field_options'=> ['date_format'=>'yyyy-MM-dd'],
]);
}
}
}
namespace Sonata\AdminBundle\Form\Type\Filter
{
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType as FormChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType as FormDateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Translation\TranslatorInterface;
class DateType extends AbstractType
{
const TYPE_GREATER_EQUAL = 1;
const TYPE_GREATER_THAN = 2;
const TYPE_EQUAL = 3;
const TYPE_LESS_EQUAL = 4;
const TYPE_LESS_THAN = 5;
const TYPE_NULL = 6;
const TYPE_NOT_NULL = 7;
protected $translator;
public function __construct(TranslatorInterface $translator)
{
$this->translator = $translator;
}
public function getName()
{
return $this->getBlockPrefix();
}
public function getBlockPrefix()
{
return'sonata_type_filter_date';
}
public function buildForm(FormBuilderInterface $builder, array $options)
{
$choices = ['label_date_type_equal'=> self::TYPE_EQUAL,'label_date_type_greater_equal'=> self::TYPE_GREATER_EQUAL,'label_date_type_greater_than'=> self::TYPE_GREATER_THAN,'label_date_type_less_equal'=> self::TYPE_LESS_EQUAL,'label_date_type_less_than'=> self::TYPE_LESS_THAN,'label_date_type_null'=> self::TYPE_NULL,'label_date_type_not_null'=> self::TYPE_NOT_NULL,
];
$choiceOptions = ['required'=> false,
];
$choiceOptions['choice_translation_domain'] ='SonataAdminBundle';
if (method_exists(FormTypeInterface::class,'setDefaultOptions')) {
$choiceOptions['choices_as_values'] = true;
}
$choiceOptions['choices'] = $choices;
$builder
->add('type', FormChoiceType::class, $choiceOptions)
->add('value', $options['field_type'], array_merge(['required'=> false], $options['field_options']))
;
}
public function setDefaultOptions(OptionsResolverInterface $resolver)
{
$this->configureOptions($resolver);
}
public function configureOptions(OptionsResolver $resolver)
{
$resolver->setDefaults(['field_type'=> FormDateType::class,'field_options'=> ['date_format'=>'yyyy-MM-dd'],
]);
}
}
}
namespace Sonata\AdminBundle\Form\Type\Filter
{
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
class DefaultType extends AbstractType
{
public function getName()
{
return $this->getBlockPrefix();
}
public function getBlockPrefix()
{
return'sonata_type_filter_default';
}
public function buildForm(FormBuilderInterface $builder, array $options)
{
$builder
->add('type', $options['operator_type'], array_merge(['required'=> false], $options['operator_options']))
->add('value', $options['field_type'], array_merge(['required'=> false], $options['field_options']))
;
}
public function setDefaultOptions(OptionsResolverInterface $resolver)
{
$this->configureOptions($resolver);
}
public function configureOptions(OptionsResolver $resolver)
{
$resolver->setDefaults(['operator_type'=> HiddenType::class,'operator_options'=> [],'field_type'=> TextType::class,'field_options'=> [],
]);
}
}
}
namespace Sonata\AdminBundle\Form\Type\Filter
{
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType as FormChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType as FormNumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Translation\TranslatorInterface;
class NumberType extends AbstractType
{
const TYPE_GREATER_EQUAL = 1;
const TYPE_GREATER_THAN = 2;
const TYPE_EQUAL = 3;
const TYPE_LESS_EQUAL = 4;
const TYPE_LESS_THAN = 5;
protected $translator;
public function __construct(TranslatorInterface $translator)
{
$this->translator = $translator;
}
public function getName()
{
return $this->getBlockPrefix();
}
public function getBlockPrefix()
{
return'sonata_type_filter_number';
}
public function buildForm(FormBuilderInterface $builder, array $options)
{
$choices = ['label_type_equal'=> self::TYPE_EQUAL,'label_type_greater_equal'=> self::TYPE_GREATER_EQUAL,'label_type_greater_than'=> self::TYPE_GREATER_THAN,'label_type_less_equal'=> self::TYPE_LESS_EQUAL,'label_type_less_than'=> self::TYPE_LESS_THAN,
];
$choiceOptions = ['required'=> false,
];
$choiceOptions['choice_translation_domain'] ='SonataAdminBundle';
if (method_exists(FormTypeInterface::class,'setDefaultOptions')) {
$choiceOptions['choices_as_values'] = true;
}
$choiceOptions['choices'] = $choices;
$builder
->add('type', FormChoiceType::class, $choiceOptions)
->add('value', $options['field_type'], array_merge(['required'=> false], $options['field_options']))
;
}
public function setDefaultOptions(OptionsResolverInterface $resolver)
{
$this->configureOptions($resolver);
}
public function configureOptions(OptionsResolver $resolver)
{
$resolver->setDefaults(['field_type'=> FormNumberType::class,'field_options'=> [],
]);
}
}
}
namespace Sonata\AdminBundle\Form\Type
{
use Sonata\AdminBundle\Form\DataTransformer\ModelToIdTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
class ModelReferenceType extends AbstractType
{
public function buildForm(FormBuilderInterface $builder, array $options)
{
$builder->addModelTransformer(new ModelToIdTransformer($options['model_manager'], $options['class']));
}
public function setDefaultOptions(OptionsResolverInterface $resolver)
{
\assert($resolver instanceof OptionsResolver);
$this->configureOptions($resolver);
}
public function configureOptions(OptionsResolver $resolver)
{
$resolver->setDefaults(['compound'=> false,'model_manager'=> null,'class'=> null,
]);
}
public function getParent()
{
return TextType::class;
}
public function getName()
{
return $this->getBlockPrefix();
}
public function getBlockPrefix()
{
return'sonata_type_model_reference';
}
}
}
namespace Sonata\AdminBundle\Form\Type
{
use Sonata\AdminBundle\Form\ChoiceList\ModelChoiceLoader;
use Sonata\AdminBundle\Form\DataTransformer\ModelsToArrayTransformer;
use Sonata\AdminBundle\Form\DataTransformer\ModelToIdTransformer;
use Sonata\AdminBundle\Form\EventListener\MergeCollectionListener;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;
class ModelType extends AbstractType
{
protected $propertyAccessor;
public function __construct(PropertyAccessorInterface $propertyAccessor)
{
$this->propertyAccessor = $propertyAccessor;
}
public function buildForm(FormBuilderInterface $builder, array $options)
{
if ($options['multiple']) {
$builder->addViewTransformer(
new ModelsToArrayTransformer($options['model_manager'], $options['class']),
true
);
$builder
->addEventSubscriber(new MergeCollectionListener($options['model_manager']))
;
} else {
$builder
->addViewTransformer(new ModelToIdTransformer($options['model_manager'], $options['class']), true)
;
}
}
public function buildView(FormView $view, FormInterface $form, array $options)
{
$view->vars['btn_add'] = $options['btn_add'];
$view->vars['btn_list'] = $options['btn_list'];
$view->vars['btn_delete'] = $options['btn_delete'];
$view->vars['btn_catalogue'] = $options['btn_catalogue'];
}
public function setDefaultOptions(OptionsResolverInterface $resolver)
{
$this->configureOptions($resolver);
}
public function configureOptions(OptionsResolver $resolver)
{
$options = [];
$propertyAccessor = $this->propertyAccessor;
$options['choice_loader'] = function (Options $options, $previousValue) use ($propertyAccessor) {
if ($previousValue && \count($choices = $previousValue->getChoices())) {
return $choices;
}
return new ModelChoiceLoader(
$options['model_manager'],
$options['class'],
$options['property'],
$options['query'],
$options['choices'],
$propertyAccessor
);
};
if (method_exists(FormTypeInterface::class,'setDefaultOptions')) {
$options['choices_as_values'] = true;
}
$resolver->setDefaults(array_merge($options, ['compound'=> function (Options $options) {
if (isset($options['multiple']) && $options['multiple']) {
if (isset($options['expanded']) && $options['expanded']) {
return true;
}
return false;
}
if (isset($options['expanded']) && $options['expanded']) {
return true;
}
return false;
},'template'=>'choice','multiple'=> false,'expanded'=> false,'model_manager'=> null,'class'=> null,'property'=> null,'query'=> null,'choices'=> [],'preferred_choices'=> [],'btn_add'=>'link_add','btn_list'=>'link_list','btn_delete'=>'link_delete','btn_catalogue'=>'SonataAdminBundle',
]));
}
public function getParent()
{
return ChoiceType::class;
}
public function getName()
{
return $this->getBlockPrefix();
}
public function getBlockPrefix()
{
return'sonata_type_model';
}
}
}
namespace Sonata\AdminBundle\Form\Type
{
use Sonata\AdminBundle\Form\DataTransformer\ModelToIdTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
class ModelListType extends AbstractType
{
public function buildForm(FormBuilderInterface $builder, array $options)
{
$builder
->resetViewTransformers()
->addViewTransformer(new ModelToIdTransformer($options['model_manager'], $options['class']));
}
public function buildView(FormView $view, FormInterface $form, array $options)
{
if (isset($view->vars['sonata_admin'])) {
$view->vars['sonata_admin']['edit'] ='list';
}
$view->vars['btn_add'] = $options['btn_add'];
$view->vars['btn_edit'] = $options['btn_edit'];
$view->vars['btn_list'] = $options['btn_list'];
$view->vars['btn_delete'] = $options['btn_delete'];
$view->vars['btn_catalogue'] = $options['btn_catalogue'];
}
public function setDefaultOptions(OptionsResolverInterface $resolver)
{
$this->configureOptions($resolver);
}
public function configureOptions(OptionsResolver $resolver)
{
$resolver->setDefaults(['model_manager'=> null,'class'=> null,'btn_add'=>'link_add','btn_edit'=>'link_edit','btn_list'=>'link_list','btn_delete'=>'link_delete','btn_catalogue'=>'SonataAdminBundle',
]);
}
public function getParent()
{
return TextType::class;
}
public function getName()
{
return $this->getBlockPrefix();
}
public function getBlockPrefix()
{
return'sonata_type_model_list';
}
}
}
namespace Sonata\AdminBundle\Guesser
{
use Sonata\AdminBundle\Model\ModelManagerInterface;
interface TypeGuesserInterface
{
public function guessType($class, $property, ModelManagerInterface $modelManager);
}
}
namespace Sonata\AdminBundle\Guesser
{
use Sonata\AdminBundle\Model\ModelManagerInterface;
use Symfony\Component\Form\Exception\UnexpectedTypeException;
use Symfony\Component\Form\Guess\Guess;
class TypeGuesserChain implements TypeGuesserInterface
{
protected $guessers = [];
public function __construct(array $guessers)
{
foreach ($guessers as $guesser) {
if (!$guesser instanceof TypeGuesserInterface) {
throw new UnexpectedTypeException($guesser, TypeGuesserInterface::class);
}
if ($guesser instanceof self) {
$this->guessers = array_merge($this->guessers, $guesser->guessers);
} else {
$this->guessers[] = $guesser;
}
}
}
public function guessType($class, $property, ModelManagerInterface $modelManager)
{
return $this->guess(function ($guesser) use ($class, $property, $modelManager) {
return $guesser->guessType($class, $property, $modelManager);
});
}
private function guess(\Closure $closure)
{
$guesses = [];
foreach ($this->guessers as $guesser) {
if ($guess = $closure($guesser)) {
$guesses[] = $guess;
}
}
return Guess::getBestGuess($guesses);
}
}
}
namespace Sonata\AdminBundle\Model
{
interface AuditManagerInterface
{
public function setReader($serviceId, array $classes);
public function hasReader($class);
public function getReader($class);
}
}
namespace Sonata\AdminBundle\Model
{
use Symfony\Component\DependencyInjection\ContainerInterface;
class AuditManager implements AuditManagerInterface
{
protected $classes = [];
protected $readers = [];
protected $container;
public function __construct(ContainerInterface $container)
{
$this->container = $container;
}
public function setReader($serviceId, array $classes)
{
$this->readers[$serviceId] = $classes;
}
public function hasReader($class)
{
foreach ($this->readers as $classes) {
if (\in_array($class, $classes)) {
return true;
}
}
return false;
}
public function getReader($class)
{
foreach ($this->readers as $readerId => $classes) {
if (\in_array($class, $classes)) {
return $this->container->get($readerId);
}
}
throw new \RuntimeException(sprintf('The class "%s" does not have any reader manager', $class));
}
}
}
namespace Sonata\AdminBundle\Model
{
interface AuditReaderInterface
{
public function find($className, $id, $revision);
public function findRevisionHistory($className, $limit = 20, $offset = 0);
public function findRevision($classname, $revision);
public function findRevisions($className, $id);
public function diff($className, $id, $oldRevision, $newRevision);
}
}
namespace Sonata\AdminBundle\Model
{
use Exporter\Source\SourceIteratorInterface;
use Sonata\AdminBundle\Admin\FieldDescriptionInterface;
use Sonata\AdminBundle\Datagrid\DatagridInterface;
use Sonata\AdminBundle\Datagrid\ProxyQueryInterface;
use Sonata\AdminBundle\Exception\ModelManagerException;
interface ModelManagerInterface
{
public function getNewFieldDescriptionInstance($class, $name, array $options = []);
public function create($object);
public function update($object);
public function delete($object);
public function findBy($class, array $criteria = []);
public function findOneBy($class, array $criteria = []);
public function find($class, $id);
public function batchDelete($class, ProxyQueryInterface $queryProxy);
public function getParentFieldDescription($parentAssociationMapping, $class);
public function createQuery($class, $alias ='o');
public function getModelIdentifier($class);
public function getIdentifierValues($model);
public function getIdentifierFieldNames($class);
public function getNormalizedIdentifier($model);
public function getUrlsafeIdentifier($model);
public function getModelInstance($class);
public function getModelCollectionInstance($class);
public function collectionRemoveElement(&$collection, &$element);
public function collectionAddElement(&$collection, &$element);
public function collectionHasElement(&$collection, &$element);
public function collectionClear(&$collection);
public function getSortParameters(FieldDescriptionInterface $fieldDescription, DatagridInterface $datagrid);
public function getDefaultSortValues($class);
public function modelReverseTransform($class, array $array = []);
public function modelTransform($class, $instance);
public function executeQuery($query);
public function getDataSourceIterator(
DatagridInterface $datagrid,
array $fields,
$firstResult = null,
$maxResult = null
);
public function getExportFields($class);
public function getPaginationParameters(DatagridInterface $datagrid, $page);
public function addIdentifiersToQuery($class, ProxyQueryInterface $query, array $idx);
}
}
namespace Sonata\AdminBundle\Route
{
use Sonata\AdminBundle\Admin\Pool;
use Symfony\Component\Config\Loader\Loader;
use Symfony\Component\Config\Resource\FileResource;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Routing\RouteCollection as SymfonyRouteCollection;
class AdminPoolLoader extends Loader
{
const ROUTE_TYPE_NAME ='sonata_admin';
protected $pool;
protected $adminServiceIds = [];
protected $container;
public function __construct(Pool $pool, array $adminServiceIds, ContainerInterface $container)
{
$this->pool = $pool;
$this->adminServiceIds = $adminServiceIds;
$this->container = $container;
}
public function supports($resource, $type = null)
{
return self::ROUTE_TYPE_NAME === $type;
}
public function load($resource, $type = null)
{
$collection = new SymfonyRouteCollection();
foreach ($this->adminServiceIds as $id) {
$admin = $this->pool->getInstance($id);
foreach ($admin->getRoutes()->getElements() as $code => $route) {
$collection->add($route->getDefault('_sonata_name'), $route);
}
$reflection = new \ReflectionObject($admin);
if (file_exists($reflection->getFileName())) {
$collection->addResource(new FileResource($reflection->getFileName()));
}
}
$reflection = new \ReflectionObject($this->container);
if (file_exists($reflection->getFileName())) {
$collection->addResource(new FileResource($reflection->getFileName()));
}
return $collection;
}
}
}
namespace Sonata\AdminBundle\Route
{
use Sonata\AdminBundle\Admin\AdminInterface;
interface RouteGeneratorInterface
{
public function generateUrl(AdminInterface $admin, $name, array $parameters = [], $absolute = false);
public function generateMenuUrl(AdminInterface $admin, $name, array $parameters = [], $absolute = false);
public function generate($name, array $parameters = [], $absolute = false);
public function hasAdminRoute(AdminInterface $admin, $name);
}
}
namespace Sonata\AdminBundle\Route
{
use Sonata\AdminBundle\Admin\AdminInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\RouterInterface;
class DefaultRouteGenerator implements RouteGeneratorInterface
{
private $router;
private $cache;
private $caches = [];
private $loaded = [];
public function __construct(RouterInterface $router, RoutesCache $cache)
{
$this->router = $router;
$this->cache = $cache;
}
public function generate($name, array $parameters = [], $absolute = UrlGeneratorInterface::ABSOLUTE_PATH)
{
return $this->router->generate($name, $parameters, $absolute);
}
public function generateUrl(
AdminInterface $admin,
$name,
array $parameters = [],
$absolute = UrlGeneratorInterface::ABSOLUTE_PATH
) {
$arrayRoute = $this->generateMenuUrl($admin, $name, $parameters, $absolute);
return $this->router->generate($arrayRoute['route'], $arrayRoute['routeParameters'], $arrayRoute['routeAbsolute']);
}
public function generateMenuUrl(
AdminInterface $admin,
$name,
array $parameters = [],
$absolute = UrlGeneratorInterface::ABSOLUTE_PATH
) {
if ($admin->isChild() && $admin->hasRequest()) {
if (isset($parameters['id'])) {
$parameters[$admin->getIdParameter()] = $parameters['id'];
unset($parameters['id']);
}
for ($parentAdmin = $admin->getParent(); null !== $parentAdmin; $parentAdmin = $parentAdmin->getParent()) {
$parameters[$parentAdmin->getIdParameter()] = $admin->getRequest()->attributes->get($parentAdmin->getIdParameter());
}
}
if ($admin->hasParentFieldDescription()) {
$parameters = array_merge($parameters, $admin->getParentFieldDescription()->getOption('link_parameters', []));
$parameters['uniqid'] = $admin->getUniqid();
$parameters['code'] = $admin->getCode();
$parameters['pcode'] = $admin->getParentFieldDescription()->getAdmin()->getCode();
$parameters['puniqid'] = $admin->getParentFieldDescription()->getAdmin()->getUniqid();
}
if ('update'== $name ||'|update'== substr($name, -7)) {
$parameters['uniqid'] = $admin->getUniqid();
$parameters['code'] = $admin->getCode();
}
if ($admin->hasRequest()) {
$parameters = array_merge($admin->getPersistentParameters(), $parameters);
}
$code = $this->getCode($admin, $name);
if (!array_key_exists($code, $this->caches)) {
throw new \RuntimeException(sprintf('unable to find the route `%s`', $code));
}
return ['route'=> $this->caches[$code],'routeParameters'=> $parameters,'routeAbsolute'=> $absolute,
];
}
public function hasAdminRoute(AdminInterface $admin, $name)
{
return array_key_exists($this->getCode($admin, $name), $this->caches);
}
private function getCode(AdminInterface $admin, $name)
{
$this->loadCache($admin);
if (!$admin->isChild() && array_key_exists($name, $this->caches)) {
return $name;
}
$codePrefix = $admin->getCode();
if ($admin->isChild()) {
$codePrefix = $admin->getBaseCodeRoute();
}
if (strpos($name,'.')) {
return $codePrefix.'|'.$name;
}
return $codePrefix.'.'.$name;
}
private function loadCache(AdminInterface $admin)
{
if ($admin->isChild()) {
$this->loadCache($admin->getParent());
} else {
if (\in_array($admin->getCode(), $this->loaded)) {
return;
}
$this->caches = array_merge($this->cache->load($admin), $this->caches);
$this->loaded[] = $admin->getCode();
}
}
}
}
namespace Sonata\AdminBundle\Route
{
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Builder\RouteBuilderInterface;
use Sonata\AdminBundle\Model\AuditManagerInterface;
class PathInfoBuilder implements RouteBuilderInterface
{
protected $manager;
public function __construct(AuditManagerInterface $manager)
{
$this->manager = $manager;
}
public function build(AdminInterface $admin, RouteCollection $collection)
{
$collection->add('list');
$collection->add('create');
$collection->add('batch');
$collection->add('edit', $admin->getRouterIdParameter().'/edit');
$collection->add('delete', $admin->getRouterIdParameter().'/delete');
$collection->add('show', $admin->getRouterIdParameter().'/show');
$collection->add('export');
if ($this->manager->hasReader($admin->getClass())) {
$collection->add('history', $admin->getRouterIdParameter().'/history');
$collection->add('history_view_revision', $admin->getRouterIdParameter().'/history/{revision}/view');
$collection->add('history_compare_revisions', $admin->getRouterIdParameter().'/history/{base_revision}/{compare_revision}/compare');
}
if ($admin->isAclEnabled()) {
$collection->add('acl', $admin->getRouterIdParameter().'/acl');
}
foreach ($admin->getChildren() as $children) {
$collection->addCollection($children->getRoutes());
}
}
}
}
namespace Sonata\AdminBundle\Route
{
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Builder\RouteBuilderInterface;
use Sonata\AdminBundle\Model\AuditManagerInterface;
class QueryStringBuilder implements RouteBuilderInterface
{
protected $manager;
public function __construct(AuditManagerInterface $manager)
{
$this->manager = $manager;
}
public function build(AdminInterface $admin, RouteCollection $collection)
{
$collection->add('list');
$collection->add('create');
$collection->add('batch');
$collection->add('edit');
$collection->add('delete');
$collection->add('show');
$collection->add('export');
if ($this->manager->hasReader($admin->getClass())) {
$collection->add('history','/audit-history');
$collection->add('history_view_revision','/audit-history-view');
$collection->add('history_compare_revisions','/audit-history-compare');
}
if ($admin->isAclEnabled()) {
$collection->add('acl', $admin->getRouterIdParameter().'/acl');
}
if ($admin->getParent()) {
return;
}
foreach ($admin->getChildren() as $children) {
$collection->addCollection($children->getRoutes());
}
}
}
}
namespace Sonata\AdminBundle\Route
{
use Symfony\Component\Routing\Route;
class RouteCollection
{
protected $elements = [];
protected $baseCodeRoute;
protected $baseRouteName;
protected $baseControllerName;
protected $baseRoutePattern;
public function __construct($baseCodeRoute, $baseRouteName, $baseRoutePattern, $baseControllerName)
{
$this->baseCodeRoute = $baseCodeRoute;
$this->baseRouteName = $baseRouteName;
$this->baseRoutePattern = $baseRoutePattern;
$this->baseControllerName = $baseControllerName;
}
public function add(
$name,
$pattern = null,
array $defaults = [],
array $requirements = [],
array $options = [],
$host ='',
array $schemes = [],
array $methods = [],
$condition ='') {
$pattern = $this->baseRoutePattern.'/'.($pattern ?: $name);
$code = $this->getCode($name);
$routeName = $this->baseRouteName.'_'.$name;
if (!isset($defaults['_controller'])) {
$defaults['_controller'] = $this->baseControllerName.':'.$this->actionify($code);
}
if (!isset($defaults['_sonata_admin'])) {
$defaults['_sonata_admin'] = $this->baseCodeRoute;
}
$defaults['_sonata_name'] = $routeName;
$this->elements[$this->getCode($name)] = function () use (
$pattern, $defaults, $requirements, $options, $host, $schemes, $methods, $condition) {
return new Route($pattern, $defaults, $requirements, $options, $host, $schemes, $methods, $condition);
};
return $this;
}
public function getCode($name)
{
if (false !== strrpos($name,'.')) {
return $name;
}
return $this->baseCodeRoute.'.'.$name;
}
public function addCollection(self $collection)
{
foreach ($collection->getElements() as $code => $route) {
$this->elements[$code] = $route;
}
return $this;
}
public function getElements()
{
foreach ($this->elements as $name => $element) {
$this->elements[$name] = $this->resolve($element);
}
return $this->elements;
}
public function has($name)
{
return array_key_exists($this->getCode($name), $this->elements);
}
public function get($name)
{
if ($this->has($name)) {
$code = $this->getCode($name);
$this->elements[$code] = $this->resolve($this->elements[$code]);
return $this->elements[$code];
}
throw new \InvalidArgumentException(sprintf('Element "%s" does not exist.', $name));
}
public function remove($name)
{
unset($this->elements[$this->getCode($name)]);
return $this;
}
public function clearExcept($routeList)
{
if (!\is_array($routeList)) {
$routeList = [$routeList];
}
$routeCodeList = [];
foreach ($routeList as $name) {
$routeCodeList[] = $this->getCode($name);
}
$elements = $this->elements;
foreach ($elements as $key => $element) {
if (!\in_array($key, $routeCodeList)) {
unset($this->elements[$key]);
}
}
return $this;
}
public function clear()
{
$this->elements = [];
return $this;
}
public function actionify($action)
{
if (false !== ($pos = strrpos($action,'.'))) {
$action = substr($action, $pos + 1);
}
if (false === strpos($this->baseControllerName,':')) {
$action .='Action';
}
return lcfirst(str_replace(' ','', ucwords(strtr($action,'_-','  '))));
}
public function getBaseCodeRoute()
{
return $this->baseCodeRoute;
}
public function getBaseControllerName()
{
return $this->baseControllerName;
}
public function getBaseRouteName()
{
return $this->baseRouteName;
}
public function getBaseRoutePattern()
{
return $this->baseRoutePattern;
}
private function resolve($element)
{
if (\is_callable($element)) {
return \call_user_func($element);
}
return $element;
}
}
}
namespace Symfony\Component\Security\Acl\Permission
{
interface PermissionMapInterface
{
public function getMasks($permission, $object);
public function contains($permission);
}
}
namespace Sonata\AdminBundle\Security\Acl\Permission
{
use Symfony\Component\Security\Acl\Permission\PermissionMapInterface;
class AdminPermissionMap implements PermissionMapInterface
{
const PERMISSION_VIEW ='VIEW';
const PERMISSION_EDIT ='EDIT';
const PERMISSION_CREATE ='CREATE';
const PERMISSION_DELETE ='DELETE';
const PERMISSION_UNDELETE ='UNDELETE';
const PERMISSION_LIST ='LIST';
const PERMISSION_EXPORT ='EXPORT';
const PERMISSION_OPERATOR ='OPERATOR';
const PERMISSION_MASTER ='MASTER';
const PERMISSION_OWNER ='OWNER';
private $map = [
self::PERMISSION_VIEW => [
MaskBuilder::MASK_VIEW,
MaskBuilder::MASK_LIST,
MaskBuilder::MASK_EDIT,
MaskBuilder::MASK_OPERATOR,
MaskBuilder::MASK_MASTER,
MaskBuilder::MASK_OWNER,
],
self::PERMISSION_EDIT => [
MaskBuilder::MASK_EDIT,
MaskBuilder::MASK_OPERATOR,
MaskBuilder::MASK_MASTER,
MaskBuilder::MASK_OWNER,
],
self::PERMISSION_CREATE => [
MaskBuilder::MASK_CREATE,
MaskBuilder::MASK_OPERATOR,
MaskBuilder::MASK_MASTER,
MaskBuilder::MASK_OWNER,
],
self::PERMISSION_DELETE => [
MaskBuilder::MASK_DELETE,
MaskBuilder::MASK_OPERATOR,
MaskBuilder::MASK_MASTER,
MaskBuilder::MASK_OWNER,
],
self::PERMISSION_UNDELETE => [
MaskBuilder::MASK_UNDELETE,
MaskBuilder::MASK_OPERATOR,
MaskBuilder::MASK_MASTER,
MaskBuilder::MASK_OWNER,
],
self::PERMISSION_LIST => [
MaskBuilder::MASK_LIST,
MaskBuilder::MASK_OPERATOR,
MaskBuilder::MASK_MASTER,
MaskBuilder::MASK_OWNER,
],
self::PERMISSION_EXPORT => [
MaskBuilder::MASK_EXPORT,
MaskBuilder::MASK_OPERATOR,
MaskBuilder::MASK_MASTER,
MaskBuilder::MASK_OWNER,
],
self::PERMISSION_OPERATOR => [
MaskBuilder::MASK_OPERATOR,
MaskBuilder::MASK_MASTER,
MaskBuilder::MASK_OWNER,
],
self::PERMISSION_MASTER => [
MaskBuilder::MASK_MASTER,
MaskBuilder::MASK_OWNER,
],
self::PERMISSION_OWNER => [
MaskBuilder::MASK_OWNER,
],
];
public function getMasks($permission, $object)
{
if (!isset($this->map[$permission])) {
return;
}
return $this->map[$permission];
}
public function contains($permission)
{
return isset($this->map[$permission]);
}
}
}
namespace Symfony\Component\Security\Acl\Permission
{
interface MaskBuilderInterface
{
public function set($mask);
public function get();
public function add($mask);
public function remove($mask);
public function reset();
public function resolveMask($code);
}
}
namespace Symfony\Component\Security\Acl\Permission
{
abstract class AbstractMaskBuilder implements MaskBuilderInterface
{
protected $mask;
public function __construct($mask = 0)
{
$this->set($mask);
}
public function set($mask)
{
if (!is_int($mask)) {
throw new \InvalidArgumentException('$mask must be an integer.');
}
$this->mask = $mask;
return $this;
}
public function get()
{
return $this->mask;
}
public function add($mask)
{
$this->mask |= $this->resolveMask($mask);
return $this;
}
public function remove($mask)
{
$this->mask &= ~$this->resolveMask($mask);
return $this;
}
public function reset()
{
$this->mask = 0;
return $this;
}
}
}
namespace Symfony\Component\Security\Acl\Permission
{
class MaskBuilder extends AbstractMaskBuilder
{
const MASK_VIEW = 1; const MASK_CREATE = 2; const MASK_EDIT = 4; const MASK_DELETE = 8; const MASK_UNDELETE = 16; const MASK_OPERATOR = 32; const MASK_MASTER = 64; const MASK_OWNER = 128; const MASK_IDDQD = 1073741823;
const CODE_VIEW ='V';
const CODE_CREATE ='C';
const CODE_EDIT ='E';
const CODE_DELETE ='D';
const CODE_UNDELETE ='U';
const CODE_OPERATOR ='O';
const CODE_MASTER ='M';
const CODE_OWNER ='N';
const ALL_OFF ='................................';
const OFF ='.';
const ON ='*';
public function getPattern()
{
$pattern = self::ALL_OFF;
$length = strlen($pattern);
$bitmask = str_pad(decbin($this->mask), $length,'0', STR_PAD_LEFT);
for ($i = $length - 1; $i >= 0; --$i) {
if ('1'=== $bitmask[$i]) {
try {
$pattern[$i] = self::getCode(1 << ($length - $i - 1));
} catch (\Exception $e) {
$pattern[$i] = self::ON;
}
}
}
return $pattern;
}
public static function getCode($mask)
{
if (!is_int($mask)) {
throw new \InvalidArgumentException('$mask must be an integer.');
}
$reflection = new \ReflectionClass(get_called_class());
foreach ($reflection->getConstants() as $name => $cMask) {
if (0 !== strpos($name,'MASK_') || $mask !== $cMask) {
continue;
}
if (!defined($cName ='static::CODE_'.substr($name, 5))) {
throw new \RuntimeException('There was no code defined for this mask.');
}
return constant($cName);
}
throw new \InvalidArgumentException(sprintf('The mask "%d" is not supported.', $mask));
}
public function resolveMask($code)
{
if (is_string($code)) {
if (!defined($name = sprintf('static::MASK_%s', strtoupper($code)))) {
throw new \InvalidArgumentException(sprintf('The code "%s" is not supported', $code));
}
return constant($name);
}
if (!is_int($code)) {
throw new \InvalidArgumentException('$code must be an integer.');
}
return $code;
}
}
}
namespace Sonata\AdminBundle\Security\Acl\Permission
{
use Symfony\Component\Security\Acl\Permission\MaskBuilder as BaseMaskBuilder;
class MaskBuilder extends BaseMaskBuilder
{
const MASK_LIST = 4096; const MASK_EXPORT = 8192;
const CODE_LIST ='L';
const CODE_EXPORT ='E';
}
}
namespace Sonata\AdminBundle\Security\Handler
{
use Sonata\AdminBundle\Admin\AdminInterface;
interface SecurityHandlerInterface
{
public function isGranted(AdminInterface $admin, $attributes, $object = null);
public function getBaseRole(AdminInterface $admin);
public function buildSecurityInformation(AdminInterface $admin);
public function createObjectSecurity(AdminInterface $admin, $object);
public function deleteObjectSecurity(AdminInterface $admin, $object);
}
}
namespace Sonata\AdminBundle\Security\Handler
{
use Symfony\Component\Security\Acl\Domain\UserSecurityIdentity;
use Symfony\Component\Security\Acl\Model\AclInterface;
use Symfony\Component\Security\Acl\Model\ObjectIdentityInterface;
interface AclSecurityHandlerInterface extends SecurityHandlerInterface
{
public function setAdminPermissions(array $permissions);
public function getAdminPermissions();
public function setObjectPermissions(array $permissions);
public function getObjectPermissions();
public function getObjectAcl(ObjectIdentityInterface $objectIdentity);
public function findObjectAcls(\Traversable $oids, array $sids = []);
public function addObjectOwner(AclInterface $acl, UserSecurityIdentity $securityIdentity = null);
public function addObjectClassAces(AclInterface $acl, array $roleInformation = []);
public function createAcl(ObjectIdentityInterface $objectIdentity);
public function updateAcl(AclInterface $acl);
public function deleteAcl(ObjectIdentityInterface $objectIdentity);
public function findClassAceIndexByRole(AclInterface $acl, $role);
public function findClassAceIndexByUsername(AclInterface $acl, $username);
}
}
namespace Sonata\AdminBundle\Security\Handler
{
use Sonata\AdminBundle\Admin\AdminInterface;
use Symfony\Component\Security\Acl\Domain\ObjectIdentity;
use Symfony\Component\Security\Acl\Domain\RoleSecurityIdentity;
use Symfony\Component\Security\Acl\Domain\UserSecurityIdentity;
use Symfony\Component\Security\Acl\Exception\AclNotFoundException;
use Symfony\Component\Security\Acl\Exception\NotAllAclsFoundException;
use Symfony\Component\Security\Acl\Model\AclInterface;
use Symfony\Component\Security\Acl\Model\MutableAclProviderInterface;
use Symfony\Component\Security\Acl\Model\ObjectIdentityInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationCredentialsNotFoundException;
class AclSecurityHandler implements AclSecurityHandlerInterface
{
protected $tokenStorage;
protected $authorizationChecker;
protected $aclProvider;
protected $superAdminRoles;
protected $adminPermissions;
protected $objectPermissions;
protected $maskBuilderClass;
public function __construct(
$tokenStorage,
$authorizationChecker,
MutableAclProviderInterface $aclProvider,
$maskBuilderClass,
array $superAdminRoles
) {
if (!$tokenStorage instanceof TokenStorageInterface) {
throw new \InvalidArgumentException('Argument 1 should be an instance of Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface');
}
if (!$authorizationChecker instanceof AuthorizationCheckerInterface) {
throw new \InvalidArgumentException('Argument 2 should be an instance of Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface');
}
$this->tokenStorage = $tokenStorage;
$this->authorizationChecker = $authorizationChecker;
$this->aclProvider = $aclProvider;
$this->maskBuilderClass = $maskBuilderClass;
$this->superAdminRoles = $superAdminRoles;
}
public function setAdminPermissions(array $permissions)
{
$this->adminPermissions = $permissions;
}
public function getAdminPermissions()
{
return $this->adminPermissions;
}
public function setObjectPermissions(array $permissions)
{
$this->objectPermissions = $permissions;
}
public function getObjectPermissions()
{
return $this->objectPermissions;
}
public function isGranted(AdminInterface $admin, $attributes, $object = null)
{
if (!\is_array($attributes)) {
$attributes = [$attributes];
}
try {
return $this->authorizationChecker->isGranted($this->superAdminRoles) || $this->authorizationChecker->isGranted($attributes, $object);
} catch (AuthenticationCredentialsNotFoundException $e) {
return false;
}
}
public function getBaseRole(AdminInterface $admin)
{
return'ROLE_'.str_replace('.','_', strtoupper($admin->getCode())).'_%s';
}
public function buildSecurityInformation(AdminInterface $admin)
{
$baseRole = $this->getBaseRole($admin);
$results = [];
foreach ($admin->getSecurityInformation() as $role => $permissions) {
$results[sprintf($baseRole, $role)] = $permissions;
}
return $results;
}
public function createObjectSecurity(AdminInterface $admin, $object)
{
$objectIdentity = ObjectIdentity::fromDomainObject($object);
$acl = $this->getObjectAcl($objectIdentity);
if (null === $acl) {
$acl = $this->createAcl($objectIdentity);
}
$user = $this->tokenStorage->getToken()->getUser();
$securityIdentity = UserSecurityIdentity::fromAccount($user);
$this->addObjectOwner($acl, $securityIdentity);
$this->addObjectClassAces($acl, $this->buildSecurityInformation($admin));
$this->updateAcl($acl);
}
public function deleteObjectSecurity(AdminInterface $admin, $object)
{
$objectIdentity = ObjectIdentity::fromDomainObject($object);
$this->deleteAcl($objectIdentity);
}
public function getObjectAcl(ObjectIdentityInterface $objectIdentity)
{
try {
$acl = $this->aclProvider->findAcl($objectIdentity);
} catch (AclNotFoundException $e) {
return;
}
return $acl;
}
public function findObjectAcls(\Traversable $oids, array $sids = [])
{
try {
$acls = $this->aclProvider->findAcls(iterator_to_array($oids), $sids);
} catch (NotAllAclsFoundException $e) {
$acls = $e->getPartialResult();
} catch (AclNotFoundException $e) { $acls = new \SplObjectStorage();
}
return $acls;
}
public function addObjectOwner(AclInterface $acl, UserSecurityIdentity $securityIdentity = null)
{
if (false === $this->findClassAceIndexByUsername($acl, $securityIdentity->getUsername())) {
$acl->insertObjectAce($securityIdentity, \constant("$this->maskBuilderClass::MASK_OWNER"));
}
}
public function addObjectClassAces(AclInterface $acl, array $roleInformation = [])
{
$builder = new $this->maskBuilderClass();
foreach ($roleInformation as $role => $permissions) {
$aceIndex = $this->findClassAceIndexByRole($acl, $role);
$hasRole = false;
foreach ($permissions as $permission) {
if (\in_array($permission, $this->getObjectPermissions())) {
$builder->add($permission);
$hasRole = true;
}
}
if ($hasRole) {
if (false === $aceIndex) {
$acl->insertClassAce(new RoleSecurityIdentity($role), $builder->get());
} else {
$acl->updateClassAce($aceIndex, $builder->get());
}
$builder->reset();
} elseif (false !== $aceIndex) {
$acl->deleteClassAce($aceIndex);
}
}
}
public function createAcl(ObjectIdentityInterface $objectIdentity)
{
return $this->aclProvider->createAcl($objectIdentity);
}
public function updateAcl(AclInterface $acl)
{
$this->aclProvider->updateAcl($acl);
}
public function deleteAcl(ObjectIdentityInterface $objectIdentity)
{
$this->aclProvider->deleteAcl($objectIdentity);
}
public function findClassAceIndexByRole(AclInterface $acl, $role)
{
foreach ($acl->getClassAces() as $index => $entry) {
if ($entry->getSecurityIdentity() instanceof RoleSecurityIdentity && $entry->getSecurityIdentity()->getRole() === $role) {
return $index;
}
}
return false;
}
public function findClassAceIndexByUsername(AclInterface $acl, $username)
{
foreach ($acl->getClassAces() as $index => $entry) {
if ($entry->getSecurityIdentity() instanceof UserSecurityIdentity && $entry->getSecurityIdentity()->getUsername() === $username) {
return $index;
}
}
return false;
}
}
}
namespace Sonata\AdminBundle\Security\Handler
{
use Sonata\AdminBundle\Admin\AdminInterface;
class NoopSecurityHandler implements SecurityHandlerInterface
{
public function isGranted(AdminInterface $admin, $attributes, $object = null)
{
return true;
}
public function getBaseRole(AdminInterface $admin)
{
return'';
}
public function buildSecurityInformation(AdminInterface $admin)
{
return [];
}
public function createObjectSecurity(AdminInterface $admin, $object)
{
}
public function deleteObjectSecurity(AdminInterface $admin, $object)
{
}
}
}
namespace Sonata\AdminBundle\Security\Handler
{
use Sonata\AdminBundle\Admin\AdminInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationCredentialsNotFoundException;
class RoleSecurityHandler implements SecurityHandlerInterface
{
protected $authorizationChecker;
protected $superAdminRoles;
public function __construct($authorizationChecker, array $superAdminRoles)
{
if (!$authorizationChecker instanceof AuthorizationCheckerInterface) {
throw new \InvalidArgumentException('Argument 1 should be an instance of Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface');
}
$this->authorizationChecker = $authorizationChecker;
$this->superAdminRoles = $superAdminRoles;
}
public function isGranted(AdminInterface $admin, $attributes, $object = null)
{
if (!\is_array($attributes)) {
$attributes = [$attributes];
}
foreach ($attributes as $pos => $attribute) {
$attributes[$pos] = sprintf($this->getBaseRole($admin), $attribute);
}
$allRole = sprintf($this->getBaseRole($admin),'ALL');
try {
return $this->authorizationChecker->isGranted($this->superAdminRoles)
|| $this->authorizationChecker->isGranted($attributes, $object)
|| $this->authorizationChecker->isGranted([$allRole], $object);
} catch (AuthenticationCredentialsNotFoundException $e) {
return false;
}
}
public function getBaseRole(AdminInterface $admin)
{
return'ROLE_'.str_replace('.','_', strtoupper($admin->getCode())).'_%s';
}
public function buildSecurityInformation(AdminInterface $admin)
{
return [];
}
public function createObjectSecurity(AdminInterface $admin, $object)
{
}
public function deleteObjectSecurity(AdminInterface $admin, $object)
{
}
}
}
namespace Sonata\AdminBundle\Show
{
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Admin\FieldDescriptionCollection;
use Sonata\AdminBundle\Admin\FieldDescriptionInterface;
use Sonata\AdminBundle\Builder\ShowBuilderInterface;
use Sonata\AdminBundle\Mapper\BaseGroupedMapper;
class ShowMapper extends BaseGroupedMapper
{
protected $list;
public function __construct(
ShowBuilderInterface $showBuilder,
FieldDescriptionCollection $list,
AdminInterface $admin
) {
parent::__construct($showBuilder, $admin);
$this->list = $list;
}
public function add($name, $type = null, array $fieldDescriptionOptions = [])
{
if (null !== $this->apply && !$this->apply) {
return $this;
}
$fieldKey = ($name instanceof FieldDescriptionInterface) ? $name->getName() : $name;
$this->addFieldToCurrentGroup($fieldKey);
if ($name instanceof FieldDescriptionInterface) {
$fieldDescription = $name;
$fieldDescription->mergeOptions($fieldDescriptionOptions);
} elseif (\is_string($name)) {
if (!$this->admin->hasShowFieldDescription($name)) {
$fieldDescription = $this->admin->getModelManager()->getNewFieldDescriptionInstance(
$this->admin->getClass(),
$name,
$fieldDescriptionOptions
);
} else {
throw new \RuntimeException(sprintf('Duplicate field name "%s" in show mapper. Names should be unique.', $name));
}
} else {
throw new \RuntimeException('invalid state');
}
if (!$fieldDescription->getLabel() && false !== $fieldDescription->getOption('label')) {
$fieldDescription->setOption('label', $this->admin->getLabelTranslatorStrategy()->getLabel($fieldDescription->getName(),'show','label'));
}
$fieldDescription->setOption('safe', $fieldDescription->getOption('safe', false));
$this->builder->addField($this->list, $type, $fieldDescription, $this->admin);
return $this;
}
public function get($name)
{
return $this->list->get($name);
}
public function has($key)
{
return $this->list->has($key);
}
public function remove($key)
{
$this->admin->removeShowFieldDescription($key);
$this->list->remove($key);
return $this;
}
public function removeGroup($group, $tab ='default', $deleteEmptyTab = false)
{
$groups = $this->getGroups();
if ('default'!== $tab) {
$group = $tab.'.'.$group;
}
if (isset($groups[$group])) {
foreach ($groups[$group]['fields'] as $field) {
$this->remove($field);
}
}
unset($groups[$group]);
$tabs = $this->getTabs();
$key = array_search($group, $tabs[$tab]['groups']);
if (false !== $key) {
unset($tabs[$tab]['groups'][$key]);
}
if ($deleteEmptyTab && 0 == \count($tabs[$tab]['groups'])) {
unset($tabs[$tab]);
}
$this->setTabs($tabs);
$this->setGroups($groups);
return $this;
}
final public function keys()
{
return array_keys($this->list->getElements());
}
public function reorder(array $keys)
{
$this->admin->reorderShowGroup($this->getCurrentGroupName(), $keys);
return $this;
}
protected function getGroups()
{
return $this->admin->getShowGroups();
}
protected function setGroups(array $groups)
{
$this->admin->setShowGroups($groups);
}
protected function getTabs()
{
return $this->admin->getShowTabs();
}
protected function setTabs(array $tabs)
{
$this->admin->setShowTabs($tabs);
}
protected function getName()
{
return'show';
}
}
}
namespace Sonata\AdminBundle\Translator
{
interface LabelTranslatorStrategyInterface
{
public function getLabel($label, $context ='', $type ='');
}
}
namespace Sonata\AdminBundle\Translator
{
class BCLabelTranslatorStrategy implements LabelTranslatorStrategyInterface
{
public function getLabel($label, $context ='', $type ='')
{
if ('breadcrumb'== $context) {
return sprintf('%s.%s_%s', $context, $type, strtolower($label));
}
return ucfirst(strtolower($label));
}
}
}
namespace Sonata\AdminBundle\Translator
{
class FormLabelTranslatorStrategy implements LabelTranslatorStrategyInterface
{
public function getLabel($label, $context ='', $type ='')
{
return ucfirst(strtolower($label));
}
}
}
namespace Sonata\AdminBundle\Translator
{
class NativeLabelTranslatorStrategy implements LabelTranslatorStrategyInterface
{
public function getLabel($label, $context ='', $type ='')
{
$label = str_replace(['_','.'],' ', $label);
$label = strtolower(preg_replace('~(?<=\\w)([A-Z])~','_$1', $label));
return trim(ucwords(str_replace('_',' ', $label)));
}
}
}
namespace Sonata\AdminBundle\Translator
{
class NoopLabelTranslatorStrategy implements LabelTranslatorStrategyInterface
{
public function getLabel($label, $context ='', $type ='')
{
return $label;
}
}
}
namespace Sonata\AdminBundle\Translator
{
class UnderscoreLabelTranslatorStrategy implements LabelTranslatorStrategyInterface
{
public function getLabel($label, $context ='', $type ='')
{
$label = str_replace('.','_', $label);
return sprintf('%s.%s_%s', $context, $type, strtolower(preg_replace('~(?<=\\w)([A-Z])~','_$1', $label)));
}
}
}
namespace Sonata\AdminBundle\Twig\Extension
{
use Doctrine\Common\Util\ClassUtils;
use Psr\Log\LoggerInterface;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Admin\FieldDescriptionInterface;
use Sonata\AdminBundle\Admin\Pool;
use Sonata\AdminBundle\Exception\NoValueException;
use Sonata\AdminBundle\Templating\TemplateRegistryInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\ServiceCircularReferenceException;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;
use Symfony\Component\Security\Acl\Voter\FieldVote;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationCredentialsNotFoundException;
use Symfony\Component\Translation\TranslatorInterface;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Extension\AbstractExtension;
use Twig\Template;
use Twig\TemplateWrapper;
use Twig\TwigFilter;
use Twig\TwigFunction;
class SonataAdminExtension extends AbstractExtension
{
protected $pool;
protected $logger;
protected $translator;
private $xEditableTypeMapping = [];
private $templateRegistries;
private $securityChecker;
public function __construct(
Pool $pool,
LoggerInterface $logger = null,
TranslatorInterface $translator = null,
ContainerInterface $templateRegistries = null,
AuthorizationCheckerInterface $securityChecker = null
) {
if (null === $translator) {
@trigger_error('The $translator parameter will be required fields with the 4.0 release.',
E_USER_DEPRECATED
);
}
$this->pool = $pool;
$this->logger = $logger;
$this->translator = $translator;
$this->templateRegistries = $templateRegistries;
$this->securityChecker = $securityChecker;
}
public function getFilters()
{
return [
new TwigFilter('render_list_element',
[$this,'renderListElement'],
['is_safe'=> ['html'],'needs_environment'=> true,
]
),
new TwigFilter('render_view_element',
[$this,'renderViewElement'],
['is_safe'=> ['html'],'needs_environment'=> true,
]
),
new TwigFilter('render_view_element_compare',
[$this,'renderViewElementCompare'],
['is_safe'=> ['html'],'needs_environment'=> true,
]
),
new TwigFilter('render_relation_element',
[$this,'renderRelationElement']
),
new TwigFilter('sonata_urlsafeid',
[$this,'getUrlsafeIdentifier']
),
new TwigFilter('sonata_xeditable_type',
[$this,'getXEditableType']
),
new TwigFilter('sonata_xeditable_choices',
[$this,'getXEditableChoices']
),
];
}
public function getFunctions()
{
return [
new TwigFunction('canonicalize_locale_for_moment', [$this,'getCanonicalizedLocaleForMoment'], ['needs_context'=> true]),
new TwigFunction('canonicalize_locale_for_select2', [$this,'getCanonicalizedLocaleForSelect2'], ['needs_context'=> true]),
new TwigFunction('is_granted_affirmative', [$this,'isGrantedAffirmative']),
];
}
public function getName()
{
return'sonata_admin';
}
public function renderListElement(
Environment $environment,
$object,
FieldDescriptionInterface $fieldDescription,
$params = []
) {
$template = $this->getTemplate(
$fieldDescription,
$fieldDescription->getAdmin()->getTemplate('base_list_field'),
$environment
);
return $this->render($fieldDescription, $template, array_merge($params, ['admin'=> $fieldDescription->getAdmin(),'object'=> $object,'value'=> $this->getValueFromFieldDescription($object, $fieldDescription),'field_description'=> $fieldDescription,
]), $environment);
}
public function output(
FieldDescriptionInterface $fieldDescription,
Template $template,
array $parameters,
Environment $environment
) {
return $this->render(
$fieldDescription,
new TemplateWrapper($environment, $template),
$parameters,
$environment
);
}
public function getValueFromFieldDescription(
$object,
FieldDescriptionInterface $fieldDescription,
array $params = []
) {
if (isset($params['loop']) && $object instanceof \ArrayAccess) {
throw new \RuntimeException('remove the loop requirement');
}
$value = null;
try {
$value = $fieldDescription->getValue($object);
} catch (NoValueException $e) {
if ($fieldDescription->getAssociationAdmin()) {
$value = $fieldDescription->getAssociationAdmin()->getNewInstance();
}
}
return $value;
}
public function renderViewElement(
Environment $environment,
FieldDescriptionInterface $fieldDescription,
$object
) {
$template = $this->getTemplate(
$fieldDescription,'@SonataAdmin/CRUD/base_show_field.html.twig',
$environment
);
try {
$value = $fieldDescription->getValue($object);
} catch (NoValueException $e) {
$value = null;
}
return $this->render($fieldDescription, $template, ['field_description'=> $fieldDescription,'object'=> $object,'value'=> $value,'admin'=> $fieldDescription->getAdmin(),
], $environment);
}
public function renderViewElementCompare(
Environment $environment,
FieldDescriptionInterface $fieldDescription,
$baseObject,
$compareObject
) {
$template = $this->getTemplate(
$fieldDescription,'@SonataAdmin/CRUD/base_show_field.html.twig',
$environment
);
try {
$baseValue = $fieldDescription->getValue($baseObject);
} catch (NoValueException $e) {
$baseValue = null;
}
try {
$compareValue = $fieldDescription->getValue($compareObject);
} catch (NoValueException $e) {
$compareValue = null;
}
$baseValueOutput = $template->render(['admin'=> $fieldDescription->getAdmin(),'field_description'=> $fieldDescription,'value'=> $baseValue,
]);
$compareValueOutput = $template->render(['field_description'=> $fieldDescription,'admin'=> $fieldDescription->getAdmin(),'value'=> $compareValue,
]);
$isDiff = $baseValueOutput !== $compareValueOutput;
return $this->render($fieldDescription, $template, ['field_description'=> $fieldDescription,'value'=> $baseValue,'value_compare'=> $compareValue,'is_diff'=> $isDiff,'admin'=> $fieldDescription->getAdmin(),
], $environment);
}
public function renderRelationElement($element, FieldDescriptionInterface $fieldDescription)
{
if (!\is_object($element)) {
return $element;
}
$propertyPath = $fieldDescription->getOption('associated_property');
if (null === $propertyPath) {
$method = $fieldDescription->getOption('associated_tostring');
if ($method) {
@trigger_error('Option "associated_tostring" is deprecated since version 2.3 and will be removed in 4.0. '.'Use "associated_property" instead.',
E_USER_DEPRECATED
);
} else {
$method ='__toString';
}
if (!method_exists($element, $method)) {
throw new \RuntimeException(sprintf('You must define an `associated_property` option or '.'create a `%s::__toString` method to the field option %s from service %s is ',
\get_class($element),
$fieldDescription->getName(),
$fieldDescription->getAdmin()->getCode()
));
}
return \call_user_func([$element, $method]);
}
if (\is_callable($propertyPath)) {
return $propertyPath($element);
}
return $this->pool->getPropertyAccessor()->getValue($element, $propertyPath);
}
public function getUrlsafeIdentifier($model, AdminInterface $admin = null)
{
if (null === $admin) {
$admin = $this->pool->getAdminByClass(ClassUtils::getClass($model));
}
return $admin->getUrlsafeIdentifier($model);
}
public function setXEditableTypeMapping($xEditableTypeMapping)
{
$this->xEditableTypeMapping = $xEditableTypeMapping;
}
public function getXEditableType($type)
{
return isset($this->xEditableTypeMapping[$type]) ? $this->xEditableTypeMapping[$type] : false;
}
public function getXEditableChoices(FieldDescriptionInterface $fieldDescription)
{
$choices = $fieldDescription->getOption('choices', []);
$catalogue = $fieldDescription->getOption('catalogue');
$xEditableChoices = [];
if (!empty($choices)) {
reset($choices);
$first = current($choices);
if (\is_array($first) && array_key_exists('value', $first) && array_key_exists('text', $first)) {
$xEditableChoices = $choices;
} else {
foreach ($choices as $value => $text) {
if ($catalogue) {
if (null !== $this->translator) {
$text = $this->translator->trans($text, [], $catalogue);
} elseif (method_exists($fieldDescription->getAdmin(),'trans')) {
$text = $fieldDescription->getAdmin()->trans($text, [], $catalogue);
}
}
$xEditableChoices[] = ['value'=> $value,'text'=> $text,
];
}
}
}
if (false === $fieldDescription->getOption('required', true)
&& false === $fieldDescription->getOption('multiple', false)
) {
$xEditableChoices = array_merge([['value'=>'','text'=>'',
]], $xEditableChoices);
}
return $xEditableChoices;
}
final public function getCanonicalizedLocaleForMoment(array $context)
{
$locale = strtolower(str_replace('_','-', $context['app']->getRequest()->getLocale()));
if (('en'=== $lang = substr($locale, 0, 2)) && !\in_array($locale, ['en-au','en-ca','en-gb','en-ie','en-nz'], true)) {
return null;
}
if ('es'=== $lang && !\in_array($locale, ['es','es-do'], true)) {
$locale ='es';
} elseif ('nl'=== $lang && !\in_array($locale, ['nl','nl-be'], true)) {
$locale ='nl';
}
return $locale;
}
final public function getCanonicalizedLocaleForSelect2(array $context)
{
$locale = str_replace('_','-', $context['app']->getRequest()->getLocale());
if ('en'=== $lang = substr($locale, 0, 2)) {
return null;
}
switch ($locale) {
case'pt':
$locale ='pt-PT';
break;
case'ug':
$locale ='ug-CN';
break;
case'zh':
$locale ='zh-CN';
break;
default:
if (!\in_array($locale, ['pt-BR','pt-PT','ug-CN','zh-CN','zh-TW'], true)) {
$locale = $lang;
}
}
return $locale;
}
public function isGrantedAffirmative($role, $object = null, $field = null)
{
if (null === $this->securityChecker) {
return false;
}
if (null !== $field) {
$object = new FieldVote($object, $field);
}
if (!\is_array($role)) {
$role = [$role];
}
foreach ($role as $oneRole) {
try {
if ($this->securityChecker->isGranted($oneRole, $object)) {
return true;
}
} catch (AuthenticationCredentialsNotFoundException $e) {
}
}
return false;
}
protected function getTemplate(
FieldDescriptionInterface $fieldDescription,
$defaultTemplate,
Environment $environment
) {
$templateName = $fieldDescription->getTemplate() ?: $defaultTemplate;
try {
$template = $environment->load($templateName);
} catch (LoaderError $e) {
@trigger_error('Relying on default template loading on field template loading exception '.'is deprecated since 3.1 and will be removed in 4.0. '.'A \Twig_Error_Loader exception will be thrown instead',
E_USER_DEPRECATED
);
$template = $environment->load($defaultTemplate);
if (null !== $this->logger) {
$this->logger->warning(sprintf('An error occured trying to load the template "%s" for the field "%s", '.'the default template "%s" was used instead.',
$templateName,
$fieldDescription->getFieldName(),
$defaultTemplate
), ['exception'=> $e]);
}
}
return $template;
}
private function render(
FieldDescriptionInterface $fieldDescription,
TemplateWrapper $template,
array $parameters,
Environment $environment
) {
$content = $template->render($parameters);
if ($environment->isDebug()) {
$commentTemplate =<<<'EOT'

<!-- START
    fieldName: %s
    template: %s
    compiled template: %s
    -->
    %s
<!-- END - fieldName: %s -->
EOT
;
return sprintf(
$commentTemplate,
$fieldDescription->getFieldName(),
$fieldDescription->getTemplate(),
$template->getSourceContext()->getName(),
$content,
$fieldDescription->getFieldName()
);
}
return $content;
}
private function getTemplateRegistry($adminCode)
{
$serviceId = $adminCode.'.template_registry';
$templateRegistry = $this->templateRegistries->get($serviceId);
if ($templateRegistry instanceof TemplateRegistryInterface) {
return $templateRegistry;
}
throw new ServiceNotFoundException($serviceId);
}
}
}
namespace Sonata\AdminBundle\Util
{
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Security\Handler\AclSecurityHandlerInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Security\Acl\Model\AclInterface;
interface AdminAclManipulatorInterface
{
public function configureAcls(OutputInterface $output, AdminInterface $admin);
public function addAdminClassAces(
OutputInterface $output,
AclInterface $acl,
AclSecurityHandlerInterface $securityHandler,
array $roleInformation = []
);
}
}
namespace Sonata\AdminBundle\Util
{
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Security\Handler\AclSecurityHandlerInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Security\Acl\Domain\ObjectIdentity;
use Symfony\Component\Security\Acl\Domain\RoleSecurityIdentity;
use Symfony\Component\Security\Acl\Model\AclInterface;
class AdminAclManipulator implements AdminAclManipulatorInterface
{
protected $maskBuilderClass;
public function __construct($maskBuilderClass)
{
$this->maskBuilderClass = $maskBuilderClass;
}
public function configureAcls(OutputInterface $output, AdminInterface $admin)
{
$securityHandler = $admin->getSecurityHandler();
if (!$securityHandler instanceof AclSecurityHandlerInterface) {
$output->writeln(sprintf('Admin `%s` is not configured to use ACL : <info>ignoring</info>', $admin->getCode()));
return;
}
$objectIdentity = ObjectIdentity::fromDomainObject($admin);
$newAcl = false;
if (null === ($acl = $securityHandler->getObjectAcl($objectIdentity))) {
$acl = $securityHandler->createAcl($objectIdentity);
$newAcl = true;
}
$output->writeln(sprintf(' > install ACL for %s', $admin->getCode()));
$configResult = $this->addAdminClassAces($output, $acl, $securityHandler, $securityHandler->buildSecurityInformation($admin));
if ($configResult) {
$securityHandler->updateAcl($acl);
} else {
$output->writeln(sprintf('   - %s , no roles and permissions found', ($newAcl ?'skip':'removed')));
$securityHandler->deleteAcl($objectIdentity);
}
}
public function addAdminClassAces(
OutputInterface $output,
AclInterface $acl,
AclSecurityHandlerInterface $securityHandler,
array $roleInformation = []
) {
if (\count($securityHandler->getAdminPermissions()) > 0) {
$builder = new $this->maskBuilderClass();
foreach ($roleInformation as $role => $permissions) {
$aceIndex = $securityHandler->findClassAceIndexByRole($acl, $role);
$roleAdminPermissions = [];
foreach ($permissions as $permission) {
if (\in_array($permission, $securityHandler->getAdminPermissions())) {
$builder->add($permission);
$roleAdminPermissions[] = $permission;
}
}
if (\count($roleAdminPermissions) > 0) {
if (false === $aceIndex) {
$acl->insertClassAce(new RoleSecurityIdentity($role), $builder->get());
$action ='add';
} else {
$acl->updateClassAce($aceIndex, $builder->get());
$action ='update';
}
if (null !== $output) {
$output->writeln(sprintf('   - %s role: %s, permissions: %s', $action, $role, json_encode($roleAdminPermissions)));
}
$builder->reset();
} elseif (false !== $aceIndex) {
$acl->deleteClassAce($aceIndex);
if (null !== $output) {
$output->writeln(sprintf('   - remove role: %s', $role));
}
}
}
return true;
}
return false;
}
}
}
namespace Sonata\AdminBundle\Util
{
use Symfony\Component\Form\FormBuilderInterface;
class FormBuilderIterator extends \RecursiveArrayIterator
{
protected static $reflection;
protected $formBuilder;
protected $keys = [];
protected $prefix;
protected $iterator;
public function __construct(FormBuilderInterface $formBuilder, $prefix = false)
{
parent::__construct();
$this->formBuilder = $formBuilder;
$this->prefix = $prefix ? $prefix : $formBuilder->getName();
$this->iterator = new \ArrayIterator(self::getKeys($formBuilder));
}
public function rewind()
{
$this->iterator->rewind();
}
public function valid()
{
return $this->iterator->valid();
}
public function key()
{
$name = $this->iterator->current();
return sprintf('%s_%s', $this->prefix, $name);
}
public function next()
{
$this->iterator->next();
}
public function current()
{
return $this->formBuilder->get($this->iterator->current());
}
public function getChildren()
{
return new self($this->formBuilder->get($this->iterator->current()), $this->current());
}
public function hasChildren()
{
return \count(self::getKeys($this->current())) > 0;
}
private static function getKeys(FormBuilderInterface $formBuilder)
{
return array_keys($formBuilder->all());
}
}
}
namespace Sonata\AdminBundle\Util
{
use Symfony\Component\Form\FormView;
class FormViewIterator implements \RecursiveIterator
{
protected $iterator;
public function __construct(FormView $formView)
{
$this->iterator = $formView->getIterator();
}
public function getChildren()
{
return new self($this->current());
}
public function hasChildren()
{
return \count($this->current()->children) > 0;
}
public function current()
{
return $this->iterator->current();
}
public function next()
{
$this->iterator->next();
}
public function key()
{
return $this->current()->vars['id'];
}
public function valid()
{
return $this->iterator->valid();
}
public function rewind()
{
$this->iterator->rewind();
}
}
}
namespace Sonata\AdminBundle\Util
{
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Exception\ModelManagerException;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Security\Acl\Domain\UserSecurityIdentity;
interface ObjectAclManipulatorInterface
{
public function batchConfigureAcls(
OutputInterface $output,
AdminInterface $admin,
UserSecurityIdentity $securityIdentity = null
);
}
}
namespace Sonata\AdminBundle\Util
{
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Security\Handler\AclSecurityHandlerInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Security\Acl\Domain\UserSecurityIdentity;
abstract class ObjectAclManipulator implements ObjectAclManipulatorInterface
{
public function configureAcls(
OutputInterface $output,
AdminInterface $admin,
\Traversable $oids,
UserSecurityIdentity $securityIdentity = null
) {
$countAdded = 0;
$countUpdated = 0;
$securityHandler = $admin->getSecurityHandler();
if (!$securityHandler instanceof AclSecurityHandlerInterface) {
$output->writeln(sprintf('Admin `%s` is not configured to use ACL : <info>ignoring</info>', $admin->getCode()));
return [0, 0];
}
$acls = $securityHandler->findObjectAcls($oids);
foreach ($oids as $oid) {
if ($acls->contains($oid)) {
$acl = $acls->offsetGet($oid);
++$countUpdated;
} else {
$acl = $securityHandler->createAcl($oid);
++$countAdded;
}
if (null !== $securityIdentity) {
$securityHandler->addObjectOwner($acl, $securityIdentity);
}
$securityHandler->addObjectClassAces($acl, $securityHandler->buildSecurityInformation($admin));
try {
$securityHandler->updateAcl($acl);
} catch (\Exception $e) {
$output->writeln(sprintf('Error saving ObjectIdentity (%s, %s) ACL : %s <info>ignoring</info>', $oid->getIdentifier(), $oid->getType(), $e->getMessage()));
}
}
return [$countAdded, $countUpdated];
}
}
}