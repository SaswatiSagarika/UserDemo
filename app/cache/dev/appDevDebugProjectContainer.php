<?php

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\Exception\InactiveScopeException;
use Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;
use Symfony\Component\DependencyInjection\Exception\LogicException;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;
use Symfony\Component\DependencyInjection\ParameterBag\FrozenParameterBag;

/**
 * This class has been auto-generated
 * by the Symfony Dependency Injection Component.
 */
class appDevDebugProjectContainer extends Container
{
    private $parameters;
    private $targetDirs = array();

    public function __construct()
    {
        $dir = __DIR__;
        for ($i = 1; $i <= 5; ++$i) {
            $this->targetDirs[$i] = $dir = dirname($dir);
        }
        $this->parameters = $this->getDefaultParameters();

        $this->services =
        $this->scopedServices =
        $this->scopeStacks = array();
        $this->scopes = array('request' => 'container');
        $this->scopeChildren = array('request' => array());
        $this->methodMap = array(
            'annotation_reader' => 'getAnnotationReaderService',
            'app.validator.e164_number' => 'getApp_Validator_E164NumberService',
            'assets.context' => 'getAssets_ContextService',
            'assets.packages' => 'getAssets_PackagesService',
            'cache_clearer' => 'getCacheClearerService',
            'cache_warmer' => 'getCacheWarmerService',
            'config_cache_factory' => 'getConfigCacheFactoryService',
            'controller_name_converter' => 'getControllerNameConverterService',
            'data_collector.dump' => 'getDataCollector_DumpService',
            'data_collector.form' => 'getDataCollector_FormService',
            'data_collector.form.extractor' => 'getDataCollector_Form_ExtractorService',
            'data_collector.request' => 'getDataCollector_RequestService',
            'data_collector.router' => 'getDataCollector_RouterService',
            'data_collector.translation' => 'getDataCollector_TranslationService',
            'debug.controller_resolver' => 'getDebug_ControllerResolverService',
            'debug.debug_handlers_listener' => 'getDebug_DebugHandlersListenerService',
            'debug.dump_listener' => 'getDebug_DumpListenerService',
            'debug.event_dispatcher' => 'getDebug_EventDispatcherService',
            'debug.stopwatch' => 'getDebug_StopwatchService',
            'doctrine' => 'getDoctrineService',
            'doctrine.cache_clear_metadata_command' => 'getDoctrine_CacheClearMetadataCommandService',
            'doctrine.cache_clear_query_cache_command' => 'getDoctrine_CacheClearQueryCacheCommandService',
            'doctrine.cache_clear_result_command' => 'getDoctrine_CacheClearResultCommandService',
            'doctrine.cache_collection_region_command' => 'getDoctrine_CacheCollectionRegionCommandService',
            'doctrine.clear_entity_region_command' => 'getDoctrine_ClearEntityRegionCommandService',
            'doctrine.clear_query_region_command' => 'getDoctrine_ClearQueryRegionCommandService',
            'doctrine.database_create_command' => 'getDoctrine_DatabaseCreateCommandService',
            'doctrine.database_drop_command' => 'getDoctrine_DatabaseDropCommandService',
            'doctrine.database_import_command' => 'getDoctrine_DatabaseImportCommandService',
            'doctrine.dbal.connection_factory' => 'getDoctrine_Dbal_ConnectionFactoryService',
            'doctrine.dbal.default_connection' => 'getDoctrine_Dbal_DefaultConnectionService',
            'doctrine.dbal.logger.profiling.default' => 'getDoctrine_Dbal_Logger_Profiling_DefaultService',
            'doctrine.ensure_production_settings_command' => 'getDoctrine_EnsureProductionSettingsCommandService',
            'doctrine.generate_entities_command' => 'getDoctrine_GenerateEntitiesCommandService',
            'doctrine.mapping_convert_command' => 'getDoctrine_MappingConvertCommandService',
            'doctrine.mapping_import_command' => 'getDoctrine_MappingImportCommandService',
            'doctrine.mapping_info_command' => 'getDoctrine_MappingInfoCommandService',
            'doctrine.orm.default_entity_listener_resolver' => 'getDoctrine_Orm_DefaultEntityListenerResolverService',
            'doctrine.orm.default_entity_manager' => 'getDoctrine_Orm_DefaultEntityManagerService',
            'doctrine.orm.default_entity_manager.property_info_extractor' => 'getDoctrine_Orm_DefaultEntityManager_PropertyInfoExtractorService',
            'doctrine.orm.default_listeners.attach_entity_listeners' => 'getDoctrine_Orm_DefaultListeners_AttachEntityListenersService',
            'doctrine.orm.default_manager_configurator' => 'getDoctrine_Orm_DefaultManagerConfiguratorService',
            'doctrine.orm.validator.unique' => 'getDoctrine_Orm_Validator_UniqueService',
            'doctrine.orm.validator_initializer' => 'getDoctrine_Orm_ValidatorInitializerService',
            'doctrine.query_dql_command' => 'getDoctrine_QueryDqlCommandService',
            'doctrine.query_sql_command' => 'getDoctrine_QuerySqlCommandService',
            'doctrine.schema_create_command' => 'getDoctrine_SchemaCreateCommandService',
            'doctrine.schema_drop_command' => 'getDoctrine_SchemaDropCommandService',
            'doctrine.schema_update_command' => 'getDoctrine_SchemaUpdateCommandService',
            'doctrine.schema_validate_command' => 'getDoctrine_SchemaValidateCommandService',
            'doctrine_cache.contains_command' => 'getDoctrineCache_ContainsCommandService',
            'doctrine_cache.delete_command' => 'getDoctrineCache_DeleteCommandService',
            'doctrine_cache.flush_command' => 'getDoctrineCache_FlushCommandService',
            'doctrine_cache.providers.doctrine.orm.default_metadata_cache' => 'getDoctrineCache_Providers_Doctrine_Orm_DefaultMetadataCacheService',
            'doctrine_cache.providers.doctrine.orm.default_query_cache' => 'getDoctrineCache_Providers_Doctrine_Orm_DefaultQueryCacheService',
            'doctrine_cache.providers.doctrine.orm.default_result_cache' => 'getDoctrineCache_Providers_Doctrine_Orm_DefaultResultCacheService',
            'doctrine_cache.stats_command' => 'getDoctrineCache_StatsCommandService',
            'doctrine_migrations.diff_command' => 'getDoctrineMigrations_DiffCommandService',
            'doctrine_migrations.execute_command' => 'getDoctrineMigrations_ExecuteCommandService',
            'doctrine_migrations.generate_command' => 'getDoctrineMigrations_GenerateCommandService',
            'doctrine_migrations.latest_command' => 'getDoctrineMigrations_LatestCommandService',
            'doctrine_migrations.migrate_command' => 'getDoctrineMigrations_MigrateCommandService',
            'doctrine_migrations.status_command' => 'getDoctrineMigrations_StatusCommandService',
            'doctrine_migrations.version_command' => 'getDoctrineMigrations_VersionCommandService',
            'file_locator' => 'getFileLocatorService',
            'filesystem' => 'getFilesystemService',
            'form.csrf_provider' => 'getForm_CsrfProviderService',
            'form.extension' => 'getForm_ExtensionService',
            'form.factory' => 'getForm_FactoryService',
            'form.registry' => 'getForm_RegistryService',
            'form.resolved_type_factory' => 'getForm_ResolvedTypeFactoryService',
            'form.server_params' => 'getForm_ServerParamsService',
            'form.type.birthday' => 'getForm_Type_BirthdayService',
            'form.type.button' => 'getForm_Type_ButtonService',
            'form.type.checkbox' => 'getForm_Type_CheckboxService',
            'form.type.choice' => 'getForm_Type_ChoiceService',
            'form.type.collection' => 'getForm_Type_CollectionService',
            'form.type.country' => 'getForm_Type_CountryService',
            'form.type.currency' => 'getForm_Type_CurrencyService',
            'form.type.date' => 'getForm_Type_DateService',
            'form.type.datetime' => 'getForm_Type_DatetimeService',
            'form.type.email' => 'getForm_Type_EmailService',
            'form.type.entity' => 'getForm_Type_EntityService',
            'form.type.file' => 'getForm_Type_FileService',
            'form.type.form' => 'getForm_Type_FormService',
            'form.type.hidden' => 'getForm_Type_HiddenService',
            'form.type.integer' => 'getForm_Type_IntegerService',
            'form.type.language' => 'getForm_Type_LanguageService',
            'form.type.locale' => 'getForm_Type_LocaleService',
            'form.type.money' => 'getForm_Type_MoneyService',
            'form.type.number' => 'getForm_Type_NumberService',
            'form.type.password' => 'getForm_Type_PasswordService',
            'form.type.percent' => 'getForm_Type_PercentService',
            'form.type.radio' => 'getForm_Type_RadioService',
            'form.type.range' => 'getForm_Type_RangeService',
            'form.type.repeated' => 'getForm_Type_RepeatedService',
            'form.type.reset' => 'getForm_Type_ResetService',
            'form.type.search' => 'getForm_Type_SearchService',
            'form.type.submit' => 'getForm_Type_SubmitService',
            'form.type.text' => 'getForm_Type_TextService',
            'form.type.textarea' => 'getForm_Type_TextareaService',
            'form.type.time' => 'getForm_Type_TimeService',
            'form.type.timezone' => 'getForm_Type_TimezoneService',
            'form.type.url' => 'getForm_Type_UrlService',
            'form.type_extension.csrf' => 'getForm_TypeExtension_CsrfService',
            'form.type_extension.form.data_collector' => 'getForm_TypeExtension_Form_DataCollectorService',
            'form.type_extension.form.http_foundation' => 'getForm_TypeExtension_Form_HttpFoundationService',
            'form.type_extension.form.validator' => 'getForm_TypeExtension_Form_ValidatorService',
            'form.type_extension.repeated.validator' => 'getForm_TypeExtension_Repeated_ValidatorService',
            'form.type_extension.submit.validator' => 'getForm_TypeExtension_Submit_ValidatorService',
            'form.type_extension.upload.validator' => 'getForm_TypeExtension_Upload_ValidatorService',
            'form.type_guesser.doctrine' => 'getForm_TypeGuesser_DoctrineService',
            'form.type_guesser.validator' => 'getForm_TypeGuesser_ValidatorService',
            'fos_rest.access_denied_listener' => 'getFosRest_AccessDeniedListenerService',
            'fos_rest.allowed_methods_listener' => 'getFosRest_AllowedMethodsListenerService',
            'fos_rest.allowed_methods_loader' => 'getFosRest_AllowedMethodsLoaderService',
            'fos_rest.body_listener' => 'getFosRest_BodyListenerService',
            'fos_rest.controller.exception' => 'getFosRest_Controller_ExceptionService',
            'fos_rest.decoder.json' => 'getFosRest_Decoder_JsonService',
            'fos_rest.decoder.jsontoform' => 'getFosRest_Decoder_JsontoformService',
            'fos_rest.decoder.xml' => 'getFosRest_Decoder_XmlService',
            'fos_rest.decoder_provider' => 'getFosRest_DecoderProviderService',
            'fos_rest.exception_format_negotiator' => 'getFosRest_ExceptionFormatNegotiatorService',
            'fos_rest.exception_listener' => 'getFosRest_ExceptionListenerService',
            'fos_rest.form.extension.csrf_disable' => 'getFosRest_Form_Extension_CsrfDisableService',
            'fos_rest.format_listener' => 'getFosRest_FormatListenerService',
            'fos_rest.format_negotiator' => 'getFosRest_FormatNegotiatorService',
            'fos_rest.inflector.doctrine' => 'getFosRest_Inflector_DoctrineService',
            'fos_rest.normalizer.camel_keys' => 'getFosRest_Normalizer_CamelKeysService',
            'fos_rest.normalizer.camel_keys_with_leading_underscore' => 'getFosRest_Normalizer_CamelKeysWithLeadingUnderscoreService',
            'fos_rest.param_fetcher_listener' => 'getFosRest_ParamFetcherListenerService',
            'fos_rest.request.param_fetcher' => 'getFosRest_Request_ParamFetcherService',
            'fos_rest.request.param_fetcher.reader' => 'getFosRest_Request_ParamFetcher_ReaderService',
            'fos_rest.request_matcher.0dfc4cce134bee15f08405cb5cea4845b13ff7d8c8f779004218432a2c552bd0cd9f9d27' => 'getFosRest_RequestMatcher_0dfc4cce134bee15f08405cb5cea4845b13ff7d8c8f779004218432a2c552bd0cd9f9d27Service',
            'fos_rest.request_matcher.50d7031fd332f324b33953b2158cded5b34cf57c3cd709fdaa24d6818252fd77ab4624ee' => 'getFosRest_RequestMatcher_50d7031fd332f324b33953b2158cded5b34cf57c3cd709fdaa24d6818252fd77ab4624eeService',
            'fos_rest.routing.loader.controller' => 'getFosRest_Routing_Loader_ControllerService',
            'fos_rest.routing.loader.processor' => 'getFosRest_Routing_Loader_ProcessorService',
            'fos_rest.routing.loader.reader.action' => 'getFosRest_Routing_Loader_Reader_ActionService',
            'fos_rest.routing.loader.reader.controller' => 'getFosRest_Routing_Loader_Reader_ControllerService',
            'fos_rest.routing.loader.xml_collection' => 'getFosRest_Routing_Loader_XmlCollectionService',
            'fos_rest.routing.loader.yaml_collection' => 'getFosRest_Routing_Loader_YamlCollectionService',
            'fos_rest.serializer' => 'getFosRest_SerializerService',
            'fos_rest.serializer.exception_wrapper_normalizer' => 'getFosRest_Serializer_ExceptionWrapperNormalizerService',
            'fos_rest.serializer.exception_wrapper_serialize_handler' => 'getFosRest_Serializer_ExceptionWrapperSerializeHandlerService',
            'fos_rest.view.exception_wrapper_handler' => 'getFosRest_View_ExceptionWrapperHandlerService',
            'fos_rest.view_handler' => 'getFosRest_ViewHandlerService',
            'fos_rest.view_response_listener' => 'getFosRest_ViewResponseListenerService',
            'fos_rest.violation_formatter' => 'getFosRest_ViolationFormatterService',
            'fragment.handler' => 'getFragment_HandlerService',
            'fragment.listener' => 'getFragment_ListenerService',
            'fragment.renderer.hinclude' => 'getFragment_Renderer_HincludeService',
            'fragment.renderer.inline' => 'getFragment_Renderer_InlineService',
            'http_kernel' => 'getHttpKernelService',
            'jms_serializer' => 'getJmsSerializerService',
            'jms_serializer.accessor_strategy' => 'getJmsSerializer_AccessorStrategyService',
            'jms_serializer.array_collection_handler' => 'getJmsSerializer_ArrayCollectionHandlerService',
            'jms_serializer.constraint_violation_handler' => 'getJmsSerializer_ConstraintViolationHandlerService',
            'jms_serializer.datetime_handler' => 'getJmsSerializer_DatetimeHandlerService',
            'jms_serializer.deserialization_context_factory' => 'getJmsSerializer_DeserializationContextFactoryService',
            'jms_serializer.doctrine_proxy_subscriber' => 'getJmsSerializer_DoctrineProxySubscriberService',
            'jms_serializer.expression_evaluator' => 'getJmsSerializer_ExpressionEvaluatorService',
            'jms_serializer.form_error_handler' => 'getJmsSerializer_FormErrorHandlerService',
            'jms_serializer.handler_registry' => 'getJmsSerializer_HandlerRegistryService',
            'jms_serializer.json_deserialization_visitor' => 'getJmsSerializer_JsonDeserializationVisitorService',
            'jms_serializer.json_serialization_visitor' => 'getJmsSerializer_JsonSerializationVisitorService',
            'jms_serializer.metadata_driver' => 'getJmsSerializer_MetadataDriverService',
            'jms_serializer.metadata_factory' => 'getJmsSerializer_MetadataFactoryService',
            'jms_serializer.naming_strategy' => 'getJmsSerializer_NamingStrategyService',
            'jms_serializer.object_constructor' => 'getJmsSerializer_ObjectConstructorService',
            'jms_serializer.php_collection_handler' => 'getJmsSerializer_PhpCollectionHandlerService',
            'jms_serializer.serialization_context_factory' => 'getJmsSerializer_SerializationContextFactoryService',
            'jms_serializer.stopwatch_subscriber' => 'getJmsSerializer_StopwatchSubscriberService',
            'jms_serializer.templating.helper.serializer' => 'getJmsSerializer_Templating_Helper_SerializerService',
            'jms_serializer.unserialize_object_constructor' => 'getJmsSerializer_UnserializeObjectConstructorService',
            'jms_serializer.xml_deserialization_visitor' => 'getJmsSerializer_XmlDeserializationVisitorService',
            'jms_serializer.xml_serialization_visitor' => 'getJmsSerializer_XmlSerializationVisitorService',
            'jms_serializer.yaml_serialization_visitor' => 'getJmsSerializer_YamlSerializationVisitorService',
            'kernel' => 'getKernelService',
            'kernel.class_cache.cache_warmer' => 'getKernel_ClassCache_CacheWarmerService',
            'knp_menu.factory' => 'getKnpMenu_FactoryService',
            'knp_menu.matcher' => 'getKnpMenu_MatcherService',
            'knp_menu.menu_provider' => 'getKnpMenu_MenuProviderService',
            'knp_menu.renderer.list' => 'getKnpMenu_Renderer_ListService',
            'knp_menu.renderer.twig' => 'getKnpMenu_Renderer_TwigService',
            'knp_menu.renderer_provider' => 'getKnpMenu_RendererProviderService',
            'knp_menu.voter.router' => 'getKnpMenu_Voter_RouterService',
            'locale_listener' => 'getLocaleListenerService',
            'logger' => 'getLoggerService',
            'main.admin.blog_post' => 'getMain_Admin_BlogPostService',
            'main.admin.blog_post.template_registry' => 'getMain_Admin_BlogPost_TemplateRegistryService',
            'main.admin.category' => 'getMain_Admin_CategoryService',
            'main.admin.category.template_registry' => 'getMain_Admin_Category_TemplateRegistryService',
            'main.admin.test' => 'getMain_Admin_TestService',
            'main.admin.test.template_registry' => 'getMain_Admin_Test_TemplateRegistryService',
            'monolog.handler.console' => 'getMonolog_Handler_ConsoleService',
            'monolog.handler.debug' => 'getMonolog_Handler_DebugService',
            'monolog.handler.main' => 'getMonolog_Handler_MainService',
            'monolog.handler.null_internal' => 'getMonolog_Handler_NullInternalService',
            'monolog.logger.doctrine' => 'getMonolog_Logger_DoctrineService',
            'monolog.logger.event' => 'getMonolog_Logger_EventService',
            'monolog.logger.php' => 'getMonolog_Logger_PhpService',
            'monolog.logger.profiler' => 'getMonolog_Logger_ProfilerService',
            'monolog.logger.request' => 'getMonolog_Logger_RequestService',
            'monolog.logger.security' => 'getMonolog_Logger_SecurityService',
            'monolog.logger.templating' => 'getMonolog_Logger_TemplatingService',
            'monolog.logger.translation' => 'getMonolog_Logger_TranslationService',
            'monolog.processor.psr_log_message' => 'getMonolog_Processor_PsrLogMessageService',
            'nelmio_api_doc.doc_comment_extractor' => 'getNelmioApiDoc_DocCommentExtractorService',
            'nelmio_api_doc.event_listener.request' => 'getNelmioApiDoc_EventListener_RequestService',
            'nelmio_api_doc.extractor.api_doc_extractor' => 'getNelmioApiDoc_Extractor_ApiDocExtractorService',
            'nelmio_api_doc.form.extension.description_form_type_extension' => 'getNelmioApiDoc_Form_Extension_DescriptionFormTypeExtensionService',
            'nelmio_api_doc.formatter.html_formatter' => 'getNelmioApiDoc_Formatter_HtmlFormatterService',
            'nelmio_api_doc.formatter.markdown_formatter' => 'getNelmioApiDoc_Formatter_MarkdownFormatterService',
            'nelmio_api_doc.formatter.simple_formatter' => 'getNelmioApiDoc_Formatter_SimpleFormatterService',
            'nelmio_api_doc.formatter.swagger_formatter' => 'getNelmioApiDoc_Formatter_SwaggerFormatterService',
            'nelmio_api_doc.parser.collection_parser' => 'getNelmioApiDoc_Parser_CollectionParserService',
            'nelmio_api_doc.parser.form_errors_parser' => 'getNelmioApiDoc_Parser_FormErrorsParserService',
            'nelmio_api_doc.parser.form_type_parser' => 'getNelmioApiDoc_Parser_FormTypeParserService',
            'nelmio_api_doc.parser.jms_metadata_parser' => 'getNelmioApiDoc_Parser_JmsMetadataParserService',
            'nelmio_api_doc.parser.json_serializable_parser' => 'getNelmioApiDoc_Parser_JsonSerializableParserService',
            'nelmio_api_doc.parser.validation_parser' => 'getNelmioApiDoc_Parser_ValidationParserService',
            'nelmio_api_doc.twig.extension.extra_markdown' => 'getNelmioApiDoc_Twig_Extension_ExtraMarkdownService',
            'profiler' => 'getProfilerService',
            'profiler_listener' => 'getProfilerListenerService',
            'property_accessor' => 'getPropertyAccessorService',
            'request' => 'getRequestService',
            'request_stack' => 'getRequestStackService',
            'response_listener' => 'getResponseListenerService',
            'router' => 'getRouterService',
            'router.request_context' => 'getRouter_RequestContextService',
            'router_listener' => 'getRouterListenerService',
            'routing.loader' => 'getRouting_LoaderService',
            'sch_main.import_csv' => 'getSchMain_ImportCsvService',
            'sch_main.phone' => 'getSchMain_PhoneService',
            'security.access.decision_manager' => 'getSecurity_Access_DecisionManagerService',
            'security.access_listener' => 'getSecurity_AccessListenerService',
            'security.access_map' => 'getSecurity_AccessMapService',
            'security.authentication.guard_handler' => 'getSecurity_Authentication_GuardHandlerService',
            'security.authentication.manager' => 'getSecurity_Authentication_ManagerService',
            'security.authentication.session_strategy.main' => 'getSecurity_Authentication_SessionStrategy_MainService',
            'security.authentication.trust_resolver' => 'getSecurity_Authentication_TrustResolverService',
            'security.authentication_utils' => 'getSecurity_AuthenticationUtilsService',
            'security.authorization_checker' => 'getSecurity_AuthorizationCheckerService',
            'security.channel_listener' => 'getSecurity_ChannelListenerService',
            'security.context' => 'getSecurity_ContextService',
            'security.csrf.token_manager' => 'getSecurity_Csrf_TokenManagerService',
            'security.encoder_factory' => 'getSecurity_EncoderFactoryService',
            'security.firewall' => 'getSecurity_FirewallService',
            'security.firewall.map.context.dev' => 'getSecurity_Firewall_Map_Context_DevService',
            'security.firewall.map.context.main' => 'getSecurity_Firewall_Map_Context_MainService',
            'security.firewall.map.context.secured_area' => 'getSecurity_Firewall_Map_Context_SecuredAreaService',
            'security.http_utils' => 'getSecurity_HttpUtilsService',
            'security.logout_url_generator' => 'getSecurity_LogoutUrlGeneratorService',
            'security.password_encoder' => 'getSecurity_PasswordEncoderService',
            'security.rememberme.response_listener' => 'getSecurity_Rememberme_ResponseListenerService',
            'security.role_hierarchy' => 'getSecurity_RoleHierarchyService',
            'security.secure_random' => 'getSecurity_SecureRandomService',
            'security.token_storage' => 'getSecurity_TokenStorageService',
            'security.user.provider.concrete.in_memory' => 'getSecurity_User_Provider_Concrete_InMemoryService',
            'security.user_checker.main' => 'getSecurity_UserChecker_MainService',
            'security.validator.user_password' => 'getSecurity_Validator_UserPasswordService',
            'sensio_distribution.security_checker' => 'getSensioDistribution_SecurityCheckerService',
            'sensio_distribution.security_checker.command' => 'getSensioDistribution_SecurityChecker_CommandService',
            'sensio_distribution.webconfigurator' => 'getSensioDistribution_WebconfiguratorService',
            'sensio_framework_extra.cache.listener' => 'getSensioFrameworkExtra_Cache_ListenerService',
            'sensio_framework_extra.controller.listener' => 'getSensioFrameworkExtra_Controller_ListenerService',
            'sensio_framework_extra.converter.datetime' => 'getSensioFrameworkExtra_Converter_DatetimeService',
            'sensio_framework_extra.converter.doctrine.orm' => 'getSensioFrameworkExtra_Converter_Doctrine_OrmService',
            'sensio_framework_extra.converter.listener' => 'getSensioFrameworkExtra_Converter_ListenerService',
            'sensio_framework_extra.converter.manager' => 'getSensioFrameworkExtra_Converter_ManagerService',
            'sensio_framework_extra.security.listener' => 'getSensioFrameworkExtra_Security_ListenerService',
            'sensio_framework_extra.view.guesser' => 'getSensioFrameworkExtra_View_GuesserService',
            'service_container' => 'getServiceContainerService',
            'session' => 'getSessionService',
            'session.save_listener' => 'getSession_SaveListenerService',
            'session.storage.filesystem' => 'getSession_Storage_FilesystemService',
            'session.storage.metadata_bag' => 'getSession_Storage_MetadataBagService',
            'session.storage.native' => 'getSession_Storage_NativeService',
            'session.storage.php_bridge' => 'getSession_Storage_PhpBridgeService',
            'session_listener' => 'getSessionListenerService',
            'sonata.admin.action.append_form_field_element' => 'getSonata_Admin_Action_AppendFormFieldElementService',
            'sonata.admin.action.get_short_object_description' => 'getSonata_Admin_Action_GetShortObjectDescriptionService',
            'sonata.admin.action.retrieve_autocomplete_items' => 'getSonata_Admin_Action_RetrieveAutocompleteItemsService',
            'sonata.admin.action.retrieve_form_field_element' => 'getSonata_Admin_Action_RetrieveFormFieldElementService',
            'sonata.admin.action.set_object_field_value' => 'getSonata_Admin_Action_SetObjectFieldValueService',
            'sonata.admin.audit.manager' => 'getSonata_Admin_Audit_ManagerService',
            'sonata.admin.block.admin_list' => 'getSonata_Admin_Block_AdminListService',
            'sonata.admin.block.search_result' => 'getSonata_Admin_Block_SearchResultService',
            'sonata.admin.block.stats' => 'getSonata_Admin_Block_StatsService',
            'sonata.admin.breadcrumbs_builder' => 'getSonata_Admin_BreadcrumbsBuilderService',
            'sonata.admin.builder.filter.factory' => 'getSonata_Admin_Builder_Filter_FactoryService',
            'sonata.admin.builder.orm_datagrid' => 'getSonata_Admin_Builder_OrmDatagridService',
            'sonata.admin.builder.orm_form' => 'getSonata_Admin_Builder_OrmFormService',
            'sonata.admin.builder.orm_list' => 'getSonata_Admin_Builder_OrmListService',
            'sonata.admin.builder.orm_show' => 'getSonata_Admin_Builder_OrmShowService',
            'sonata.admin.controller.admin' => 'getSonata_Admin_Controller_AdminService',
            'sonata.admin.doctrine_orm.form.type.choice_field_mask' => 'getSonata_Admin_DoctrineOrm_Form_Type_ChoiceFieldMaskService',
            'sonata.admin.event.extension' => 'getSonata_Admin_Event_ExtensionService',
            'sonata.admin.exporter' => 'getSonata_Admin_ExporterService',
            'sonata.admin.filter_persister.session' => 'getSonata_Admin_FilterPersister_SessionService',
            'sonata.admin.form.extension.choice' => 'getSonata_Admin_Form_Extension_ChoiceService',
            'sonata.admin.form.extension.field' => 'getSonata_Admin_Form_Extension_FieldService',
            'sonata.admin.form.extension.field.mopa' => 'getSonata_Admin_Form_Extension_Field_MopaService',
            'sonata.admin.form.filter.type.choice' => 'getSonata_Admin_Form_Filter_Type_ChoiceService',
            'sonata.admin.form.filter.type.date' => 'getSonata_Admin_Form_Filter_Type_DateService',
            'sonata.admin.form.filter.type.daterange' => 'getSonata_Admin_Form_Filter_Type_DaterangeService',
            'sonata.admin.form.filter.type.datetime' => 'getSonata_Admin_Form_Filter_Type_DatetimeService',
            'sonata.admin.form.filter.type.datetime_range' => 'getSonata_Admin_Form_Filter_Type_DatetimeRangeService',
            'sonata.admin.form.filter.type.default' => 'getSonata_Admin_Form_Filter_Type_DefaultService',
            'sonata.admin.form.filter.type.number' => 'getSonata_Admin_Form_Filter_Type_NumberService',
            'sonata.admin.form.type.admin' => 'getSonata_Admin_Form_Type_AdminService',
            'sonata.admin.form.type.collection' => 'getSonata_Admin_Form_Type_CollectionService',
            'sonata.admin.form.type.model_autocomplete' => 'getSonata_Admin_Form_Type_ModelAutocompleteService',
            'sonata.admin.form.type.model_choice' => 'getSonata_Admin_Form_Type_ModelChoiceService',
            'sonata.admin.form.type.model_hidden' => 'getSonata_Admin_Form_Type_ModelHiddenService',
            'sonata.admin.form.type.model_list' => 'getSonata_Admin_Form_Type_ModelListService',
            'sonata.admin.form.type.model_reference' => 'getSonata_Admin_Form_Type_ModelReferenceService',
            'sonata.admin.global_template_registry' => 'getSonata_Admin_GlobalTemplateRegistryService',
            'sonata.admin.guesser.orm_datagrid' => 'getSonata_Admin_Guesser_OrmDatagridService',
            'sonata.admin.guesser.orm_datagrid_chain' => 'getSonata_Admin_Guesser_OrmDatagridChainService',
            'sonata.admin.guesser.orm_list' => 'getSonata_Admin_Guesser_OrmListService',
            'sonata.admin.guesser.orm_list_chain' => 'getSonata_Admin_Guesser_OrmListChainService',
            'sonata.admin.guesser.orm_show' => 'getSonata_Admin_Guesser_OrmShowService',
            'sonata.admin.guesser.orm_show_chain' => 'getSonata_Admin_Guesser_OrmShowChainService',
            'sonata.admin.helper' => 'getSonata_Admin_HelperService',
            'sonata.admin.label.strategy.bc' => 'getSonata_Admin_Label_Strategy_BcService',
            'sonata.admin.label.strategy.form_component' => 'getSonata_Admin_Label_Strategy_FormComponentService',
            'sonata.admin.label.strategy.native' => 'getSonata_Admin_Label_Strategy_NativeService',
            'sonata.admin.label.strategy.noop' => 'getSonata_Admin_Label_Strategy_NoopService',
            'sonata.admin.label.strategy.underscore' => 'getSonata_Admin_Label_Strategy_UnderscoreService',
            'sonata.admin.manager.orm' => 'getSonata_Admin_Manager_OrmService',
            'sonata.admin.manipulator.acl.admin' => 'getSonata_Admin_Manipulator_Acl_AdminService',
            'sonata.admin.manipulator.acl.object.orm' => 'getSonata_Admin_Manipulator_Acl_Object_OrmService',
            'sonata.admin.menu.matcher.voter.active' => 'getSonata_Admin_Menu_Matcher_Voter_ActiveService',
            'sonata.admin.menu.matcher.voter.admin' => 'getSonata_Admin_Menu_Matcher_Voter_AdminService',
            'sonata.admin.menu.matcher.voter.children' => 'getSonata_Admin_Menu_Matcher_Voter_ChildrenService',
            'sonata.admin.menu_builder' => 'getSonata_Admin_MenuBuilderService',
            'sonata.admin.object.manipulator.acl.admin' => 'getSonata_Admin_Object_Manipulator_Acl_AdminService',
            'sonata.admin.orm.filter.type.boolean' => 'getSonata_Admin_Orm_Filter_Type_BooleanService',
            'sonata.admin.orm.filter.type.callback' => 'getSonata_Admin_Orm_Filter_Type_CallbackService',
            'sonata.admin.orm.filter.type.choice' => 'getSonata_Admin_Orm_Filter_Type_ChoiceService',
            'sonata.admin.orm.filter.type.class' => 'getSonata_Admin_Orm_Filter_Type_ClassService',
            'sonata.admin.orm.filter.type.date' => 'getSonata_Admin_Orm_Filter_Type_DateService',
            'sonata.admin.orm.filter.type.date_range' => 'getSonata_Admin_Orm_Filter_Type_DateRangeService',
            'sonata.admin.orm.filter.type.datetime' => 'getSonata_Admin_Orm_Filter_Type_DatetimeService',
            'sonata.admin.orm.filter.type.datetime_range' => 'getSonata_Admin_Orm_Filter_Type_DatetimeRangeService',
            'sonata.admin.orm.filter.type.model' => 'getSonata_Admin_Orm_Filter_Type_ModelService',
            'sonata.admin.orm.filter.type.model_autocomplete' => 'getSonata_Admin_Orm_Filter_Type_ModelAutocompleteService',
            'sonata.admin.orm.filter.type.number' => 'getSonata_Admin_Orm_Filter_Type_NumberService',
            'sonata.admin.orm.filter.type.string' => 'getSonata_Admin_Orm_Filter_Type_StringService',
            'sonata.admin.orm.filter.type.time' => 'getSonata_Admin_Orm_Filter_Type_TimeService',
            'sonata.admin.pool' => 'getSonata_Admin_PoolService',
            'sonata.admin.route.cache' => 'getSonata_Admin_Route_CacheService',
            'sonata.admin.route.cache_warmup' => 'getSonata_Admin_Route_CacheWarmupService',
            'sonata.admin.route.default_generator' => 'getSonata_Admin_Route_DefaultGeneratorService',
            'sonata.admin.route.path_info' => 'getSonata_Admin_Route_PathInfoService',
            'sonata.admin.route.query_string' => 'getSonata_Admin_Route_QueryStringService',
            'sonata.admin.route_loader' => 'getSonata_Admin_RouteLoaderService',
            'sonata.admin.search.handler' => 'getSonata_Admin_Search_HandlerService',
            'sonata.admin.security.handler' => 'getSonata_Admin_Security_HandlerService',
            'sonata.admin.sidebar_menu' => 'getSonata_Admin_SidebarMenuService',
            'sonata.admin.twig.extension' => 'getSonata_Admin_Twig_ExtensionService',
            'sonata.admin.twig.global' => 'getSonata_Admin_Twig_GlobalService',
            'sonata.admin.validator.inline' => 'getSonata_Admin_Validator_InlineService',
            'sonata.block.cache.handler.default' => 'getSonata_Block_Cache_Handler_DefaultService',
            'sonata.block.cache.handler.noop' => 'getSonata_Block_Cache_Handler_NoopService',
            'sonata.block.context_manager.default' => 'getSonata_Block_ContextManager_DefaultService',
            'sonata.block.exception.filter.debug_only' => 'getSonata_Block_Exception_Filter_DebugOnlyService',
            'sonata.block.exception.filter.ignore_block_exception' => 'getSonata_Block_Exception_Filter_IgnoreBlockExceptionService',
            'sonata.block.exception.filter.keep_all' => 'getSonata_Block_Exception_Filter_KeepAllService',
            'sonata.block.exception.filter.keep_none' => 'getSonata_Block_Exception_Filter_KeepNoneService',
            'sonata.block.exception.renderer.inline' => 'getSonata_Block_Exception_Renderer_InlineService',
            'sonata.block.exception.renderer.inline_debug' => 'getSonata_Block_Exception_Renderer_InlineDebugService',
            'sonata.block.exception.renderer.throw' => 'getSonata_Block_Exception_Renderer_ThrowService',
            'sonata.block.exception.strategy.manager' => 'getSonata_Block_Exception_Strategy_ManagerService',
            'sonata.block.form.type.block' => 'getSonata_Block_Form_Type_BlockService',
            'sonata.block.form.type.container_template' => 'getSonata_Block_Form_Type_ContainerTemplateService',
            'sonata.block.loader.chain' => 'getSonata_Block_Loader_ChainService',
            'sonata.block.loader.service' => 'getSonata_Block_Loader_ServiceService',
            'sonata.block.manager' => 'getSonata_Block_ManagerService',
            'sonata.block.menu.registry' => 'getSonata_Block_Menu_RegistryService',
            'sonata.block.renderer.default' => 'getSonata_Block_Renderer_DefaultService',
            'sonata.block.service.container' => 'getSonata_Block_Service_ContainerService',
            'sonata.block.service.empty' => 'getSonata_Block_Service_EmptyService',
            'sonata.block.service.menu' => 'getSonata_Block_Service_MenuService',
            'sonata.block.service.rss' => 'getSonata_Block_Service_RssService',
            'sonata.block.service.template' => 'getSonata_Block_Service_TemplateService',
            'sonata.block.service.text' => 'getSonata_Block_Service_TextService',
            'sonata.block.templating.helper' => 'getSonata_Block_Templating_HelperService',
            'sonata.block.twig.global' => 'getSonata_Block_Twig_GlobalService',
            'sonata.core.date.moment_format_converter' => 'getSonata_Core_Date_MomentFormatConverterService',
            'sonata.core.flashmessage.manager' => 'getSonata_Core_Flashmessage_ManagerService',
            'sonata.core.flashmessage.twig.extension' => 'getSonata_Core_Flashmessage_Twig_ExtensionService',
            'sonata.core.flashmessage.twig.runtime' => 'getSonata_Core_Flashmessage_Twig_RuntimeService',
            'sonata.core.form.type.array' => 'getSonata_Core_Form_Type_ArrayService',
            'sonata.core.form.type.boolean' => 'getSonata_Core_Form_Type_BooleanService',
            'sonata.core.form.type.collection' => 'getSonata_Core_Form_Type_CollectionService',
            'sonata.core.form.type.color' => 'getSonata_Core_Form_Type_ColorService',
            'sonata.core.form.type.color_selector' => 'getSonata_Core_Form_Type_ColorSelectorService',
            'sonata.core.form.type.date_picker' => 'getSonata_Core_Form_Type_DatePickerService',
            'sonata.core.form.type.date_range' => 'getSonata_Core_Form_Type_DateRangeService',
            'sonata.core.form.type.date_range_picker' => 'getSonata_Core_Form_Type_DateRangePickerService',
            'sonata.core.form.type.datetime_picker' => 'getSonata_Core_Form_Type_DatetimePickerService',
            'sonata.core.form.type.datetime_range' => 'getSonata_Core_Form_Type_DatetimeRangeService',
            'sonata.core.form.type.datetime_range_picker' => 'getSonata_Core_Form_Type_DatetimeRangePickerService',
            'sonata.core.form.type.equal' => 'getSonata_Core_Form_Type_EqualService',
            'sonata.core.form.type.translatable_choice' => 'getSonata_Core_Form_Type_TranslatableChoiceService',
            'sonata.core.model.adapter.chain' => 'getSonata_Core_Model_Adapter_ChainService',
            'sonata.core.slugify.cocur' => 'getSonata_Core_Slugify_CocurService',
            'sonata.core.slugify.native' => 'getSonata_Core_Slugify_NativeService',
            'sonata.core.twig.deprecated_template_extension' => 'getSonata_Core_Twig_DeprecatedTemplateExtensionService',
            'sonata.core.twig.extension.text' => 'getSonata_Core_Twig_Extension_TextService',
            'sonata.core.twig.extension.wrapping' => 'getSonata_Core_Twig_Extension_WrappingService',
            'sonata.core.twig.status_extension' => 'getSonata_Core_Twig_StatusExtensionService',
            'sonata.core.twig.status_runtime' => 'getSonata_Core_Twig_StatusRuntimeService',
            'sonata.core.twig.template_extension' => 'getSonata_Core_Twig_TemplateExtensionService',
            'sonata.core.validator.inline' => 'getSonata_Core_Validator_InlineService',
            'sonata.templating' => 'getSonata_TemplatingService',
            'sonata.templating.locator' => 'getSonata_Templating_LocatorService',
            'sonata.templating.name_parser' => 'getSonata_Templating_NameParserService',
            'sonata\\adminbundle\\action\\dashboardaction' => 'getSonata_Adminbundle_Action_DashboardactionService',
            'sonata\\adminbundle\\action\\searchaction' => 'getSonata_Adminbundle_Action_SearchactionService',
            'sonata\\adminbundle\\command\\createclasscachecommand' => 'getSonata_Adminbundle_Command_CreateclasscachecommandService',
            'sonata\\adminbundle\\command\\explainadmincommand' => 'getSonata_Adminbundle_Command_ExplainadmincommandService',
            'sonata\\adminbundle\\command\\generateadmincommand' => 'getSonata_Adminbundle_Command_GenerateadmincommandService',
            'sonata\\adminbundle\\command\\generateobjectaclcommand' => 'getSonata_Adminbundle_Command_GenerateobjectaclcommandService',
            'sonata\\adminbundle\\command\\listadmincommand' => 'getSonata_Adminbundle_Command_ListadmincommandService',
            'sonata\\adminbundle\\command\\setupaclcommand' => 'getSonata_Adminbundle_Command_SetupaclcommandService',
            'sonata\\blockbundle\\command\\debugblockscommand' => 'getSonata_Blockbundle_Command_DebugblockscommandService',
            'sonata\\corebundle\\command\\sonatadumpdoctrinemetacommand' => 'getSonata_Corebundle_Command_SonatadumpdoctrinemetacommandService',
            'sonata\\corebundle\\command\\sonatalistformmappingcommand' => 'getSonata_Corebundle_Command_SonatalistformmappingcommandService',
            'streamed_response_listener' => 'getStreamedResponseListenerService',
            'swiftmailer.email_sender.listener' => 'getSwiftmailer_EmailSender_ListenerService',
            'swiftmailer.mailer.default' => 'getSwiftmailer_Mailer_DefaultService',
            'swiftmailer.mailer.default.plugin.messagelogger' => 'getSwiftmailer_Mailer_Default_Plugin_MessageloggerService',
            'swiftmailer.mailer.default.spool' => 'getSwiftmailer_Mailer_Default_SpoolService',
            'swiftmailer.mailer.default.transport' => 'getSwiftmailer_Mailer_Default_TransportService',
            'swiftmailer.mailer.default.transport.eventdispatcher' => 'getSwiftmailer_Mailer_Default_Transport_EventdispatcherService',
            'swiftmailer.mailer.default.transport.real' => 'getSwiftmailer_Mailer_Default_Transport_RealService',
            'templating' => 'getTemplatingService',
            'templating.filename_parser' => 'getTemplating_FilenameParserService',
            'templating.helper.assets' => 'getTemplating_Helper_AssetsService',
            'templating.helper.logout_url' => 'getTemplating_Helper_LogoutUrlService',
            'templating.helper.router' => 'getTemplating_Helper_RouterService',
            'templating.helper.security' => 'getTemplating_Helper_SecurityService',
            'templating.loader' => 'getTemplating_LoaderService',
            'templating.locator' => 'getTemplating_LocatorService',
            'templating.name_parser' => 'getTemplating_NameParserService',
            'translation.dumper.csv' => 'getTranslation_Dumper_CsvService',
            'translation.dumper.ini' => 'getTranslation_Dumper_IniService',
            'translation.dumper.json' => 'getTranslation_Dumper_JsonService',
            'translation.dumper.mo' => 'getTranslation_Dumper_MoService',
            'translation.dumper.php' => 'getTranslation_Dumper_PhpService',
            'translation.dumper.po' => 'getTranslation_Dumper_PoService',
            'translation.dumper.qt' => 'getTranslation_Dumper_QtService',
            'translation.dumper.res' => 'getTranslation_Dumper_ResService',
            'translation.dumper.xliff' => 'getTranslation_Dumper_XliffService',
            'translation.dumper.yml' => 'getTranslation_Dumper_YmlService',
            'translation.extractor' => 'getTranslation_ExtractorService',
            'translation.extractor.php' => 'getTranslation_Extractor_PhpService',
            'translation.loader' => 'getTranslation_LoaderService',
            'translation.loader.csv' => 'getTranslation_Loader_CsvService',
            'translation.loader.dat' => 'getTranslation_Loader_DatService',
            'translation.loader.ini' => 'getTranslation_Loader_IniService',
            'translation.loader.json' => 'getTranslation_Loader_JsonService',
            'translation.loader.mo' => 'getTranslation_Loader_MoService',
            'translation.loader.php' => 'getTranslation_Loader_PhpService',
            'translation.loader.po' => 'getTranslation_Loader_PoService',
            'translation.loader.qt' => 'getTranslation_Loader_QtService',
            'translation.loader.res' => 'getTranslation_Loader_ResService',
            'translation.loader.xliff' => 'getTranslation_Loader_XliffService',
            'translation.loader.yml' => 'getTranslation_Loader_YmlService',
            'translation.writer' => 'getTranslation_WriterService',
            'translator' => 'getTranslatorService',
            'translator.default' => 'getTranslator_DefaultService',
            'translator_listener' => 'getTranslatorListenerService',
            'twig' => 'getTwigService',
            'twig.controller.exception' => 'getTwig_Controller_ExceptionService',
            'twig.controller.preview_error' => 'getTwig_Controller_PreviewErrorService',
            'twig.loader' => 'getTwig_LoaderService',
            'twig.profile' => 'getTwig_ProfileService',
            'twig.translation.extractor' => 'getTwig_Translation_ExtractorService',
            'twilio.client' => 'getTwilio_ClientService',
            'uri_signer' => 'getUriSignerService',
            'validate_request_listener' => 'getValidateRequestListenerService',
            'validator' => 'getValidatorService',
            'validator.builder' => 'getValidator_BuilderService',
            'validator.email' => 'getValidator_EmailService',
            'validator.expression' => 'getValidator_ExpressionService',
            'validator.validator_factory' => 'getValidator_ValidatorFactoryService',
            'var_dumper.cli_dumper' => 'getVarDumper_CliDumperService',
            'var_dumper.cloner' => 'getVarDumper_ClonerService',
            'web_profiler.controller.exception' => 'getWebProfiler_Controller_ExceptionService',
            'web_profiler.controller.profiler' => 'getWebProfiler_Controller_ProfilerService',
            'web_profiler.controller.router' => 'getWebProfiler_Controller_RouterService',
            'web_profiler.debug_toolbar' => 'getWebProfiler_DebugToolbarService',
        );
        $this->aliases = array(
            'console.command.doctrine_bundle_doctrinebundle_command_createdatabasedoctrinecommand' => 'doctrine.database_create_command',
            'console.command.doctrine_bundle_doctrinebundle_command_dropdatabasedoctrinecommand' => 'doctrine.database_drop_command',
            'console.command.doctrine_bundle_doctrinebundle_command_generateentitiesdoctrinecommand' => 'doctrine.generate_entities_command',
            'console.command.doctrine_bundle_doctrinebundle_command_importmappingdoctrinecommand' => 'doctrine.mapping_import_command',
            'console.command.doctrine_bundle_doctrinebundle_command_proxy_clearmetadatacachedoctrinecommand' => 'doctrine.cache_clear_metadata_command',
            'console.command.doctrine_bundle_doctrinebundle_command_proxy_clearquerycachedoctrinecommand' => 'doctrine.cache_clear_query_cache_command',
            'console.command.doctrine_bundle_doctrinebundle_command_proxy_clearresultcachedoctrinecommand' => 'doctrine.cache_clear_result_command',
            'console.command.doctrine_bundle_doctrinebundle_command_proxy_collectionregiondoctrinecommand' => 'doctrine.cache_collection_region_command',
            'console.command.doctrine_bundle_doctrinebundle_command_proxy_convertmappingdoctrinecommand' => 'doctrine.mapping_convert_command',
            'console.command.doctrine_bundle_doctrinebundle_command_proxy_createschemadoctrinecommand' => 'doctrine.schema_create_command',
            'console.command.doctrine_bundle_doctrinebundle_command_proxy_dropschemadoctrinecommand' => 'doctrine.schema_drop_command',
            'console.command.doctrine_bundle_doctrinebundle_command_proxy_ensureproductionsettingsdoctrinecommand' => 'doctrine.ensure_production_settings_command',
            'console.command.doctrine_bundle_doctrinebundle_command_proxy_entityregioncachedoctrinecommand' => 'doctrine.clear_entity_region_command',
            'console.command.doctrine_bundle_doctrinebundle_command_proxy_importdoctrinecommand' => 'doctrine.database_import_command',
            'console.command.doctrine_bundle_doctrinebundle_command_proxy_infodoctrinecommand' => 'doctrine.mapping_info_command',
            'console.command.doctrine_bundle_doctrinebundle_command_proxy_queryregioncachedoctrinecommand' => 'doctrine.clear_query_region_command',
            'console.command.doctrine_bundle_doctrinebundle_command_proxy_rundqldoctrinecommand' => 'doctrine.query_dql_command',
            'console.command.doctrine_bundle_doctrinebundle_command_proxy_runsqldoctrinecommand' => 'doctrine.query_sql_command',
            'console.command.doctrine_bundle_doctrinebundle_command_proxy_updateschemadoctrinecommand' => 'doctrine.schema_update_command',
            'console.command.doctrine_bundle_doctrinebundle_command_proxy_validateschemacommand' => 'doctrine.schema_validate_command',
            'console.command.doctrine_bundle_doctrinecachebundle_command_containscommand' => 'doctrine_cache.contains_command',
            'console.command.doctrine_bundle_doctrinecachebundle_command_deletecommand' => 'doctrine_cache.delete_command',
            'console.command.doctrine_bundle_doctrinecachebundle_command_flushcommand' => 'doctrine_cache.flush_command',
            'console.command.doctrine_bundle_doctrinecachebundle_command_statscommand' => 'doctrine_cache.stats_command',
            'console.command.doctrine_bundle_migrationsbundle_command_migrationsdiffdoctrinecommand' => 'doctrine_migrations.diff_command',
            'console.command.doctrine_bundle_migrationsbundle_command_migrationsexecutedoctrinecommand' => 'doctrine_migrations.execute_command',
            'console.command.doctrine_bundle_migrationsbundle_command_migrationsgeneratedoctrinecommand' => 'doctrine_migrations.generate_command',
            'console.command.doctrine_bundle_migrationsbundle_command_migrationslatestdoctrinecommand' => 'doctrine_migrations.latest_command',
            'console.command.doctrine_bundle_migrationsbundle_command_migrationsmigratedoctrinecommand' => 'doctrine_migrations.migrate_command',
            'console.command.doctrine_bundle_migrationsbundle_command_migrationsstatusdoctrinecommand' => 'doctrine_migrations.status_command',
            'console.command.doctrine_bundle_migrationsbundle_command_migrationsversiondoctrinecommand' => 'doctrine_migrations.version_command',
            'console.command.sensiolabs_security_command_securitycheckercommand' => 'sensio_distribution.security_checker.command',
            'console.command.sonata_adminbundle_command_createclasscachecommand' => 'sonata\\adminbundle\\command\\createclasscachecommand',
            'console.command.sonata_adminbundle_command_explainadmincommand' => 'sonata\\adminbundle\\command\\explainadmincommand',
            'console.command.sonata_adminbundle_command_generateadmincommand' => 'sonata\\adminbundle\\command\\generateadmincommand',
            'console.command.sonata_adminbundle_command_generateobjectaclcommand' => 'sonata\\adminbundle\\command\\generateobjectaclcommand',
            'console.command.sonata_adminbundle_command_listadmincommand' => 'sonata\\adminbundle\\command\\listadmincommand',
            'console.command.sonata_adminbundle_command_setupaclcommand' => 'sonata\\adminbundle\\command\\setupaclcommand',
            'console.command.sonata_blockbundle_command_debugblockscommand' => 'sonata\\blockbundle\\command\\debugblockscommand',
            'console.command.sonata_corebundle_command_sonatadumpdoctrinemetacommand' => 'sonata\\corebundle\\command\\sonatadumpdoctrinemetacommand',
            'console.command.sonata_corebundle_command_sonatalistformmappingcommand' => 'sonata\\corebundle\\command\\sonatalistformmappingcommand',
            'database_connection' => 'doctrine.dbal.default_connection',
            'doctrine.orm.default_metadata_cache' => 'doctrine_cache.providers.doctrine.orm.default_metadata_cache',
            'doctrine.orm.default_query_cache' => 'doctrine_cache.providers.doctrine.orm.default_query_cache',
            'doctrine.orm.default_result_cache' => 'doctrine_cache.providers.doctrine.orm.default_result_cache',
            'doctrine.orm.entity_manager' => 'doctrine.orm.default_entity_manager',
            'event_dispatcher' => 'debug.event_dispatcher',
            'fos_rest.exception_handler' => 'fos_rest.view.exception_wrapper_handler',
            'fos_rest.inflector' => 'fos_rest.inflector.doctrine',
            'fos_rest.router' => 'router',
            'fos_rest.templating' => 'templating',
            'jms\\serializer\\arraytransformerinterface' => 'jms_serializer',
            'jms\\serializer\\serializerinterface' => 'jms_serializer',
            'mailer' => 'swiftmailer.mailer.default',
            'security.authentication.session_strategy.secured_area' => 'security.authentication.session_strategy.main',
            'security.user_checker.secured_area' => 'security.user_checker.main',
            'sensio.distribution.webconfigurator' => 'sensio_distribution.webconfigurator',
            'serializer' => 'jms_serializer',
            'session.storage' => 'session.storage.native',
            'sonata.block.cache.handler' => 'sonata.block.cache.handler.default',
            'sonata.block.context_manager' => 'sonata.block.context_manager.default',
            'sonata.block.renderer' => 'sonata.block.renderer.default',
            'sonata\\adminbundle\\admin\\pool' => 'sonata.admin.pool',
            'swiftmailer.mailer' => 'swiftmailer.mailer.default',
            'swiftmailer.plugin.messagelogger' => 'swiftmailer.mailer.default.plugin.messagelogger',
            'swiftmailer.spool' => 'swiftmailer.mailer.default.spool',
            'swiftmailer.transport' => 'swiftmailer.mailer.default.transport',
            'swiftmailer.transport.real' => 'swiftmailer.mailer.default.transport.real',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function compile()
    {
        throw new LogicException('You cannot compile a dumped frozen container.');
    }

    /**
     * {@inheritdoc}
     */
    public function isFrozen()
    {
        return true;
    }

    /**
     * Gets the public 'annotation_reader' shared service.
     *
     * @return \Doctrine\Common\Annotations\CachedReader
     */
    protected function getAnnotationReaderService()
    {
        return $this->services['annotation_reader'] = new \Doctrine\Common\Annotations\CachedReader(new \Doctrine\Common\Annotations\AnnotationReader(), new \Doctrine\Common\Cache\FilesystemCache((__DIR__.'/annotations')), true);
    }

    /**
     * Gets the public 'app.validator.e164_number' shared service.
     *
     * @return \AppBundle\Validator\Constraints\E164NumberValidator
     */
    protected function getApp_Validator_E164NumberService()
    {
        return $this->services['app.validator.e164_number'] = new \AppBundle\Validator\Constraints\E164NumberValidator($this->get('twilio.client'));
    }

    /**
     * Gets the public 'assets.context' shared service.
     *
     * @return \Symfony\Component\Asset\Context\RequestStackContext
     */
    protected function getAssets_ContextService()
    {
        return $this->services['assets.context'] = new \Symfony\Component\Asset\Context\RequestStackContext($this->get('request_stack'));
    }

    /**
     * Gets the public 'assets.packages' shared service.
     *
     * @return \Symfony\Component\Asset\Packages
     */
    protected function getAssets_PackagesService()
    {
        return $this->services['assets.packages'] = new \Symfony\Component\Asset\Packages(new \Symfony\Component\Asset\PathPackage('', new \Symfony\Component\Asset\VersionStrategy\EmptyVersionStrategy(), $this->get('assets.context')), array());
    }

    /**
     * Gets the public 'cache_clearer' shared service.
     *
     * @return \Symfony\Component\HttpKernel\CacheClearer\ChainCacheClearer
     */
    protected function getCacheClearerService()
    {
        return $this->services['cache_clearer'] = new \Symfony\Component\HttpKernel\CacheClearer\ChainCacheClearer(array());
    }

    /**
     * Gets the public 'cache_warmer' shared service.
     *
     * @return \Symfony\Component\HttpKernel\CacheWarmer\CacheWarmerAggregate
     */
    protected function getCacheWarmerService()
    {
        $a = $this->get('kernel');
        $b = $this->get('templating.filename_parser');

        $c = new \Symfony\Bundle\FrameworkBundle\CacheWarmer\TemplateFinder($a, $b, ($this->targetDirs[2].'/Resources'));

        return $this->services['cache_warmer'] = new \Symfony\Component\HttpKernel\CacheWarmer\CacheWarmerAggregate(array(0 => new \Symfony\Bundle\FrameworkBundle\CacheWarmer\TemplatePathsCacheWarmer($c, $this->get('templating.locator')), 1 => $this->get('kernel.class_cache.cache_warmer'), 2 => new \Symfony\Bundle\FrameworkBundle\CacheWarmer\TranslationsCacheWarmer($this->get('translator.default')), 3 => new \Symfony\Bundle\FrameworkBundle\CacheWarmer\RouterCacheWarmer($this->get('router')), 4 => new \Symfony\Bundle\TwigBundle\CacheWarmer\TemplateCacheCacheWarmer($this, $c, array(($this->targetDirs[3].'/vendor/knplabs/knp-menu/src/Knp/Menu/Resources/views') => NULL, ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Bridge/Twig/Resources/views/Form') => NULL)), 5 => new \Symfony\Bundle\TwigBundle\CacheWarmer\TemplateCacheWarmer($this, new \Symfony\Bundle\TwigBundle\TemplateIterator($a, $this->targetDirs[2], array(($this->targetDirs[3].'/vendor/knplabs/knp-menu/src/Knp/Menu/Resources/views') => NULL, ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Bridge/Twig/Resources/views/Form') => NULL))), 6 => new \Symfony\Bridge\Doctrine\CacheWarmer\ProxyCacheWarmer($this->get('doctrine')), 7 => $this->get('fos_rest.allowed_methods_loader'), 8 => $this->get('sonata.admin.route.cache_warmup')));
    }

    /**
     * Gets the public 'config_cache_factory' shared service.
     *
     * @return \Symfony\Component\Config\ResourceCheckerConfigCacheFactory
     */
    protected function getConfigCacheFactoryService()
    {
        return $this->services['config_cache_factory'] = new \Symfony\Component\Config\ResourceCheckerConfigCacheFactory(array(0 => new \Symfony\Component\Config\Resource\SelfCheckingResourceChecker(), 1 => new \Symfony\Component\Config\Resource\BCResourceInterfaceChecker()));
    }

    /**
     * Gets the public 'data_collector.dump' shared service.
     *
     * @return \Symfony\Component\HttpKernel\DataCollector\DumpDataCollector
     */
    protected function getDataCollector_DumpService()
    {
        return $this->services['data_collector.dump'] = new \Symfony\Component\HttpKernel\DataCollector\DumpDataCollector($this->get('debug.stopwatch', ContainerInterface::NULL_ON_INVALID_REFERENCE), NULL, 'UTF-8', $this->get('request_stack'), NULL);
    }

    /**
     * Gets the public 'data_collector.form' shared service.
     *
     * @return \Symfony\Component\Form\Extension\DataCollector\FormDataCollector
     */
    protected function getDataCollector_FormService()
    {
        return $this->services['data_collector.form'] = new \Symfony\Component\Form\Extension\DataCollector\FormDataCollector($this->get('data_collector.form.extractor'));
    }

    /**
     * Gets the public 'data_collector.form.extractor' shared service.
     *
     * @return \Symfony\Component\Form\Extension\DataCollector\FormDataExtractor
     */
    protected function getDataCollector_Form_ExtractorService()
    {
        return $this->services['data_collector.form.extractor'] = new \Symfony\Component\Form\Extension\DataCollector\FormDataExtractor();
    }

    /**
     * Gets the public 'data_collector.request' shared service.
     *
     * @return \Symfony\Component\HttpKernel\DataCollector\RequestDataCollector
     */
    protected function getDataCollector_RequestService()
    {
        return $this->services['data_collector.request'] = new \Symfony\Component\HttpKernel\DataCollector\RequestDataCollector();
    }

    /**
     * Gets the public 'data_collector.router' shared service.
     *
     * @return \Symfony\Bundle\FrameworkBundle\DataCollector\RouterDataCollector
     */
    protected function getDataCollector_RouterService()
    {
        return $this->services['data_collector.router'] = new \Symfony\Bundle\FrameworkBundle\DataCollector\RouterDataCollector();
    }

    /**
     * Gets the public 'data_collector.translation' shared service.
     *
     * @return \Symfony\Component\Translation\DataCollector\TranslationDataCollector
     */
    protected function getDataCollector_TranslationService()
    {
        return $this->services['data_collector.translation'] = new \Symfony\Component\Translation\DataCollector\TranslationDataCollector($this->get('translator'));
    }

    /**
     * Gets the public 'debug.controller_resolver' shared service.
     *
     * @return \Symfony\Component\HttpKernel\Controller\TraceableControllerResolver
     */
    protected function getDebug_ControllerResolverService()
    {
        return $this->services['debug.controller_resolver'] = new \Symfony\Component\HttpKernel\Controller\TraceableControllerResolver(new \Symfony\Bundle\FrameworkBundle\Controller\ControllerResolver($this, $this->get('controller_name_converter'), $this->get('monolog.logger.request', ContainerInterface::NULL_ON_INVALID_REFERENCE)), $this->get('debug.stopwatch'));
    }

    /**
     * Gets the public 'debug.debug_handlers_listener' shared service.
     *
     * @return \Symfony\Component\HttpKernel\EventListener\DebugHandlersListener
     */
    protected function getDebug_DebugHandlersListenerService()
    {
        return $this->services['debug.debug_handlers_listener'] = new \Symfony\Component\HttpKernel\EventListener\DebugHandlersListener(NULL, $this->get('monolog.logger.php', ContainerInterface::NULL_ON_INVALID_REFERENCE), -4182, NULL, true, NULL);
    }

    /**
     * Gets the public 'debug.dump_listener' shared service.
     *
     * @return \Symfony\Component\HttpKernel\EventListener\DumpListener
     */
    protected function getDebug_DumpListenerService()
    {
        return $this->services['debug.dump_listener'] = new \Symfony\Component\HttpKernel\EventListener\DumpListener($this->get('var_dumper.cloner'), $this->get('var_dumper.cli_dumper'));
    }

    /**
     * Gets the public 'debug.event_dispatcher' shared service.
     *
     * @return \Symfony\Component\HttpKernel\Debug\TraceableEventDispatcher
     */
    protected function getDebug_EventDispatcherService()
    {
        $this->services['debug.event_dispatcher'] = $instance = new \Symfony\Component\HttpKernel\Debug\TraceableEventDispatcher(new \Symfony\Component\EventDispatcher\ContainerAwareEventDispatcher($this), $this->get('debug.stopwatch'), $this->get('monolog.logger.event', ContainerInterface::NULL_ON_INVALID_REFERENCE));

        $instance->addListenerService('kernel.controller', array(0 => 'data_collector.router', 1 => 'onKernelController'), 0);
        $instance->addListenerService('kernel.controller', array(0 => 'fos_rest.view_response_listener', 1 => 'onKernelController'), -10);
        $instance->addListenerService('kernel.view', array(0 => 'fos_rest.view_response_listener', 1 => 'onKernelView'), 100);
        $instance->addListenerService('kernel.request', array(0 => 'fos_rest.body_listener', 1 => 'onKernelRequest'), 10);
        $instance->addListenerService('kernel.request', array(0 => 'fos_rest.format_listener', 1 => 'onKernelRequest'), 34);
        $instance->addListenerService('kernel.controller', array(0 => 'fos_rest.param_fetcher_listener', 1 => 'onKernelController'), 5);
        $instance->addListenerService('kernel.response', array(0 => 'fos_rest.allowed_methods_listener', 1 => 'onKernelResponse'), 0);
        $instance->addListenerService('kernel.request', array(0 => 'nelmio_api_doc.event_listener.request', 1 => 'onKernelRequest'), 0);
        $instance->addListenerService('kernel.response', array(0 => 'sonata.block.cache.handler.default', 1 => 'onKernelResponse'), 0);
        $instance->addSubscriberService('response_listener', 'Symfony\\Component\\HttpKernel\\EventListener\\ResponseListener');
        $instance->addSubscriberService('streamed_response_listener', 'Symfony\\Component\\HttpKernel\\EventListener\\StreamedResponseListener');
        $instance->addSubscriberService('locale_listener', 'Symfony\\Component\\HttpKernel\\EventListener\\LocaleListener');
        $instance->addSubscriberService('translator_listener', 'Symfony\\Component\\HttpKernel\\EventListener\\TranslatorListener');
        $instance->addSubscriberService('validate_request_listener', 'Symfony\\Component\\HttpKernel\\EventListener\\ValidateRequestListener');
        $instance->addSubscriberService('session_listener', 'Symfony\\Bundle\\FrameworkBundle\\EventListener\\SessionListener');
        $instance->addSubscriberService('session.save_listener', 'Symfony\\Component\\HttpKernel\\EventListener\\SaveSessionListener');
        $instance->addSubscriberService('fragment.listener', 'Symfony\\Component\\HttpKernel\\EventListener\\FragmentListener');
        $instance->addSubscriberService('profiler_listener', 'Symfony\\Component\\HttpKernel\\EventListener\\ProfilerListener');
        $instance->addSubscriberService('data_collector.request', 'Symfony\\Component\\HttpKernel\\DataCollector\\RequestDataCollector');
        $instance->addSubscriberService('router_listener', 'Symfony\\Component\\HttpKernel\\EventListener\\RouterListener');
        $instance->addSubscriberService('debug.debug_handlers_listener', 'Symfony\\Component\\HttpKernel\\EventListener\\DebugHandlersListener');
        $instance->addSubscriberService('security.firewall', 'Symfony\\Component\\Security\\Http\\Firewall');
        $instance->addSubscriberService('security.rememberme.response_listener', 'Symfony\\Component\\Security\\Http\\RememberMe\\ResponseListener');
        $instance->addSubscriberService('monolog.handler.console', 'Symfony\\Bridge\\Monolog\\Handler\\ConsoleHandler');
        $instance->addSubscriberService('swiftmailer.email_sender.listener', 'Symfony\\Bundle\\SwiftmailerBundle\\EventListener\\EmailSenderListener');
        $instance->addSubscriberService('sensio_framework_extra.controller.listener', 'Sensio\\Bundle\\FrameworkExtraBundle\\EventListener\\ControllerListener');
        $instance->addSubscriberService('sensio_framework_extra.converter.listener', 'Sensio\\Bundle\\FrameworkExtraBundle\\EventListener\\ParamConverterListener');
        $instance->addSubscriberService('sensio_framework_extra.cache.listener', 'Sensio\\Bundle\\FrameworkExtraBundle\\EventListener\\HttpCacheListener');
        $instance->addSubscriberService('sensio_framework_extra.security.listener', 'Sensio\\Bundle\\FrameworkExtraBundle\\EventListener\\SecurityListener');
        $instance->addSubscriberService('fos_rest.exception_listener', 'Symfony\\Component\\HttpKernel\\EventListener\\ExceptionListener');
        $instance->addSubscriberService('fos_rest.access_denied_listener', 'FOS\\RestBundle\\EventListener\\AccessDeniedListener');
        $instance->addSubscriberService('debug.dump_listener', 'Symfony\\Component\\HttpKernel\\EventListener\\DumpListener');
        $instance->addSubscriberService('web_profiler.debug_toolbar', 'Symfony\\Bundle\\WebProfilerBundle\\EventListener\\WebDebugToolbarListener');

        return $instance;
    }

    /**
     * Gets the public 'debug.stopwatch' shared service.
     *
     * @return \Symfony\Component\Stopwatch\Stopwatch
     */
    protected function getDebug_StopwatchService()
    {
        return $this->services['debug.stopwatch'] = new \Symfony\Component\Stopwatch\Stopwatch();
    }

    /**
     * Gets the public 'doctrine' shared service.
     *
     * @return \Doctrine\Bundle\DoctrineBundle\Registry
     */
    protected function getDoctrineService()
    {
        return $this->services['doctrine'] = new \Doctrine\Bundle\DoctrineBundle\Registry($this, array('default' => 'doctrine.dbal.default_connection'), array('default' => 'doctrine.orm.default_entity_manager'), 'default', 'default');
    }

    /**
     * Gets the public 'doctrine.cache_clear_metadata_command' shared service.
     *
     * @return \Doctrine\Bundle\DoctrineBundle\Command\Proxy\ClearMetadataCacheDoctrineCommand
     */
    protected function getDoctrine_CacheClearMetadataCommandService()
    {
        return $this->services['doctrine.cache_clear_metadata_command'] = new \Doctrine\Bundle\DoctrineBundle\Command\Proxy\ClearMetadataCacheDoctrineCommand();
    }

    /**
     * Gets the public 'doctrine.cache_clear_query_cache_command' shared service.
     *
     * @return \Doctrine\Bundle\DoctrineBundle\Command\Proxy\ClearQueryCacheDoctrineCommand
     */
    protected function getDoctrine_CacheClearQueryCacheCommandService()
    {
        return $this->services['doctrine.cache_clear_query_cache_command'] = new \Doctrine\Bundle\DoctrineBundle\Command\Proxy\ClearQueryCacheDoctrineCommand();
    }

    /**
     * Gets the public 'doctrine.cache_clear_result_command' shared service.
     *
     * @return \Doctrine\Bundle\DoctrineBundle\Command\Proxy\ClearResultCacheDoctrineCommand
     */
    protected function getDoctrine_CacheClearResultCommandService()
    {
        return $this->services['doctrine.cache_clear_result_command'] = new \Doctrine\Bundle\DoctrineBundle\Command\Proxy\ClearResultCacheDoctrineCommand();
    }

    /**
     * Gets the public 'doctrine.cache_collection_region_command' shared service.
     *
     * @return \Doctrine\Bundle\DoctrineBundle\Command\Proxy\CollectionRegionDoctrineCommand
     */
    protected function getDoctrine_CacheCollectionRegionCommandService()
    {
        return $this->services['doctrine.cache_collection_region_command'] = new \Doctrine\Bundle\DoctrineBundle\Command\Proxy\CollectionRegionDoctrineCommand();
    }

    /**
     * Gets the public 'doctrine.clear_entity_region_command' shared service.
     *
     * @return \Doctrine\Bundle\DoctrineBundle\Command\Proxy\EntityRegionCacheDoctrineCommand
     */
    protected function getDoctrine_ClearEntityRegionCommandService()
    {
        return $this->services['doctrine.clear_entity_region_command'] = new \Doctrine\Bundle\DoctrineBundle\Command\Proxy\EntityRegionCacheDoctrineCommand();
    }

    /**
     * Gets the public 'doctrine.clear_query_region_command' shared service.
     *
     * @return \Doctrine\Bundle\DoctrineBundle\Command\Proxy\QueryRegionCacheDoctrineCommand
     */
    protected function getDoctrine_ClearQueryRegionCommandService()
    {
        return $this->services['doctrine.clear_query_region_command'] = new \Doctrine\Bundle\DoctrineBundle\Command\Proxy\QueryRegionCacheDoctrineCommand();
    }

    /**
     * Gets the public 'doctrine.database_create_command' shared service.
     *
     * @return \Doctrine\Bundle\DoctrineBundle\Command\CreateDatabaseDoctrineCommand
     */
    protected function getDoctrine_DatabaseCreateCommandService()
    {
        return $this->services['doctrine.database_create_command'] = new \Doctrine\Bundle\DoctrineBundle\Command\CreateDatabaseDoctrineCommand();
    }

    /**
     * Gets the public 'doctrine.database_drop_command' shared service.
     *
     * @return \Doctrine\Bundle\DoctrineBundle\Command\DropDatabaseDoctrineCommand
     */
    protected function getDoctrine_DatabaseDropCommandService()
    {
        return $this->services['doctrine.database_drop_command'] = new \Doctrine\Bundle\DoctrineBundle\Command\DropDatabaseDoctrineCommand();
    }

    /**
     * Gets the public 'doctrine.database_import_command' shared service.
     *
     * @return \Doctrine\Bundle\DoctrineBundle\Command\Proxy\ImportDoctrineCommand
     */
    protected function getDoctrine_DatabaseImportCommandService()
    {
        return $this->services['doctrine.database_import_command'] = new \Doctrine\Bundle\DoctrineBundle\Command\Proxy\ImportDoctrineCommand();
    }

    /**
     * Gets the public 'doctrine.dbal.connection_factory' shared service.
     *
     * @return \Doctrine\Bundle\DoctrineBundle\ConnectionFactory
     */
    protected function getDoctrine_Dbal_ConnectionFactoryService()
    {
        return $this->services['doctrine.dbal.connection_factory'] = new \Doctrine\Bundle\DoctrineBundle\ConnectionFactory(array());
    }

    /**
     * Gets the public 'doctrine.dbal.default_connection' shared service.
     *
     * @return \Doctrine\DBAL\Connection
     */
    protected function getDoctrine_Dbal_DefaultConnectionService()
    {
        $a = new \Doctrine\DBAL\Logging\LoggerChain();
        $a->addLogger(new \Symfony\Bridge\Doctrine\Logger\DbalLogger($this->get('monolog.logger.doctrine', ContainerInterface::NULL_ON_INVALID_REFERENCE), $this->get('debug.stopwatch', ContainerInterface::NULL_ON_INVALID_REFERENCE)));
        $a->addLogger($this->get('doctrine.dbal.logger.profiling.default'));

        $b = new \Doctrine\DBAL\Configuration();
        $b->setSQLLogger($a);

        $c = new \Symfony\Bridge\Doctrine\ContainerAwareEventManager($this);
        $c->addEventListener(array(0 => 'loadClassMetadata'), $this->get('doctrine.orm.default_listeners.attach_entity_listeners'));

        return $this->services['doctrine.dbal.default_connection'] = $this->get('doctrine.dbal.connection_factory')->createConnection(array('driver' => 'pdo_mysql', 'host' => '127.0.0.1', 'port' => NULL, 'dbname' => 'EcommerceNew', 'user' => 'root', 'password' => 'mindfire', 'charset' => 'UTF8', 'driverOptions' => array(), 'defaultTableOptions' => array()), $b, $c, array());
    }

    /**
     * Gets the public 'doctrine.ensure_production_settings_command' shared service.
     *
     * @return \Doctrine\Bundle\DoctrineBundle\Command\Proxy\EnsureProductionSettingsDoctrineCommand
     */
    protected function getDoctrine_EnsureProductionSettingsCommandService()
    {
        return $this->services['doctrine.ensure_production_settings_command'] = new \Doctrine\Bundle\DoctrineBundle\Command\Proxy\EnsureProductionSettingsDoctrineCommand();
    }

    /**
     * Gets the public 'doctrine.generate_entities_command' shared service.
     *
     * @return \Doctrine\Bundle\DoctrineBundle\Command\GenerateEntitiesDoctrineCommand
     */
    protected function getDoctrine_GenerateEntitiesCommandService()
    {
        return $this->services['doctrine.generate_entities_command'] = new \Doctrine\Bundle\DoctrineBundle\Command\GenerateEntitiesDoctrineCommand();
    }

    /**
     * Gets the public 'doctrine.mapping_convert_command' shared service.
     *
     * @return \Doctrine\Bundle\DoctrineBundle\Command\Proxy\ConvertMappingDoctrineCommand
     */
    protected function getDoctrine_MappingConvertCommandService()
    {
        return $this->services['doctrine.mapping_convert_command'] = new \Doctrine\Bundle\DoctrineBundle\Command\Proxy\ConvertMappingDoctrineCommand();
    }

    /**
     * Gets the public 'doctrine.mapping_import_command' shared service.
     *
     * @return \Doctrine\Bundle\DoctrineBundle\Command\ImportMappingDoctrineCommand
     */
    protected function getDoctrine_MappingImportCommandService()
    {
        return $this->services['doctrine.mapping_import_command'] = new \Doctrine\Bundle\DoctrineBundle\Command\ImportMappingDoctrineCommand();
    }

    /**
     * Gets the public 'doctrine.mapping_info_command' shared service.
     *
     * @return \Doctrine\Bundle\DoctrineBundle\Command\Proxy\InfoDoctrineCommand
     */
    protected function getDoctrine_MappingInfoCommandService()
    {
        return $this->services['doctrine.mapping_info_command'] = new \Doctrine\Bundle\DoctrineBundle\Command\Proxy\InfoDoctrineCommand();
    }

    /**
     * Gets the public 'doctrine.orm.default_entity_listener_resolver' shared service.
     *
     * @return \Doctrine\Bundle\DoctrineBundle\Mapping\ContainerAwareEntityListenerResolver
     */
    protected function getDoctrine_Orm_DefaultEntityListenerResolverService()
    {
        return $this->services['doctrine.orm.default_entity_listener_resolver'] = new \Doctrine\Bundle\DoctrineBundle\Mapping\ContainerAwareEntityListenerResolver($this);
    }

    /**
     * Gets the public 'doctrine.orm.default_entity_manager' shared service.
     *
     * @return \Doctrine\ORM\EntityManager
     */
    public function getDoctrine_Orm_DefaultEntityManagerService($lazyLoad = true)
    {
        if ($lazyLoad) {
            $container = $this;

            return $this->services['doctrine.orm.default_entity_manager'] = new DoctrineORMEntityManager_000000000bc6206e000055ee6367fe948665dee8663b3ed20fa65d22263820c0(
                function (&$wrappedInstance, \ProxyManager\Proxy\LazyLoadingInterface $proxy) use ($container) {
                    $wrappedInstance = $container->getDoctrine_Orm_DefaultEntityManagerService(false);

                    $proxy->setProxyInitializer(null);

                    return true;
                }
            );
        }

        $a = new \Doctrine\Common\Persistence\Mapping\Driver\MappingDriverChain();
        $a->addDriver(new \Doctrine\ORM\Mapping\Driver\AnnotationDriver($this->get('annotation_reader'), array(0 => ($this->targetDirs[3].'/src/Sch/MainBundle/Entity'))), 'Sch\\MainBundle\\Entity');

        $b = new \Doctrine\ORM\Configuration();
        $b->setEntityNamespaces(array('MainBundle' => 'Sch\\MainBundle\\Entity'));
        $b->setMetadataCacheImpl($this->get('doctrine_cache.providers.doctrine.orm.default_metadata_cache'));
        $b->setQueryCacheImpl($this->get('doctrine_cache.providers.doctrine.orm.default_query_cache'));
        $b->setResultCacheImpl($this->get('doctrine_cache.providers.doctrine.orm.default_result_cache'));
        $b->setMetadataDriverImpl($a);
        $b->setProxyDir((__DIR__.'/doctrine/orm/Proxies'));
        $b->setProxyNamespace('Proxies');
        $b->setAutoGenerateProxyClasses(true);
        $b->setClassMetadataFactoryName('Doctrine\\ORM\\Mapping\\ClassMetadataFactory');
        $b->setDefaultRepositoryClassName('Doctrine\\ORM\\EntityRepository');
        $b->setNamingStrategy(new \Doctrine\ORM\Mapping\UnderscoreNamingStrategy());
        $b->setQuoteStrategy(new \Doctrine\ORM\Mapping\DefaultQuoteStrategy());
        $b->setEntityListenerResolver($this->get('doctrine.orm.default_entity_listener_resolver'));
        $b->setRepositoryFactory(new \Doctrine\Bundle\DoctrineBundle\Repository\ContainerRepositoryFactory(NULL));

        $instance = \Doctrine\ORM\EntityManager::create($this->get('doctrine.dbal.default_connection'), $b);

        $this->get('doctrine.orm.default_manager_configurator')->configure($instance);

        return $instance;
    }

    /**
     * Gets the public 'doctrine.orm.default_entity_manager.property_info_extractor' shared service.
     *
     * @return \Symfony\Bridge\Doctrine\PropertyInfo\DoctrineExtractor
     */
    protected function getDoctrine_Orm_DefaultEntityManager_PropertyInfoExtractorService()
    {
        return $this->services['doctrine.orm.default_entity_manager.property_info_extractor'] = new \Symfony\Bridge\Doctrine\PropertyInfo\DoctrineExtractor($this->get('doctrine.orm.default_entity_manager')->getMetadataFactory());
    }

    /**
     * Gets the public 'doctrine.orm.default_listeners.attach_entity_listeners' shared service.
     *
     * @return \Doctrine\ORM\Tools\AttachEntityListenersListener
     */
    protected function getDoctrine_Orm_DefaultListeners_AttachEntityListenersService()
    {
        return $this->services['doctrine.orm.default_listeners.attach_entity_listeners'] = new \Doctrine\ORM\Tools\AttachEntityListenersListener();
    }

    /**
     * Gets the public 'doctrine.orm.default_manager_configurator' shared service.
     *
     * @return \Doctrine\Bundle\DoctrineBundle\ManagerConfigurator
     */
    protected function getDoctrine_Orm_DefaultManagerConfiguratorService()
    {
        return $this->services['doctrine.orm.default_manager_configurator'] = new \Doctrine\Bundle\DoctrineBundle\ManagerConfigurator(array(), array());
    }

    /**
     * Gets the public 'doctrine.orm.validator.unique' shared service.
     *
     * @return \Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntityValidator
     */
    protected function getDoctrine_Orm_Validator_UniqueService()
    {
        return $this->services['doctrine.orm.validator.unique'] = new \Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntityValidator($this->get('doctrine'));
    }

    /**
     * Gets the public 'doctrine.orm.validator_initializer' shared service.
     *
     * @return \Symfony\Bridge\Doctrine\Validator\DoctrineInitializer
     */
    protected function getDoctrine_Orm_ValidatorInitializerService()
    {
        return $this->services['doctrine.orm.validator_initializer'] = new \Symfony\Bridge\Doctrine\Validator\DoctrineInitializer($this->get('doctrine'));
    }

    /**
     * Gets the public 'doctrine.query_dql_command' shared service.
     *
     * @return \Doctrine\Bundle\DoctrineBundle\Command\Proxy\RunDqlDoctrineCommand
     */
    protected function getDoctrine_QueryDqlCommandService()
    {
        return $this->services['doctrine.query_dql_command'] = new \Doctrine\Bundle\DoctrineBundle\Command\Proxy\RunDqlDoctrineCommand();
    }

    /**
     * Gets the public 'doctrine.query_sql_command' shared service.
     *
     * @return \Doctrine\Bundle\DoctrineBundle\Command\Proxy\RunSqlDoctrineCommand
     */
    protected function getDoctrine_QuerySqlCommandService()
    {
        return $this->services['doctrine.query_sql_command'] = new \Doctrine\Bundle\DoctrineBundle\Command\Proxy\RunSqlDoctrineCommand();
    }

    /**
     * Gets the public 'doctrine.schema_create_command' shared service.
     *
     * @return \Doctrine\Bundle\DoctrineBundle\Command\Proxy\CreateSchemaDoctrineCommand
     */
    protected function getDoctrine_SchemaCreateCommandService()
    {
        return $this->services['doctrine.schema_create_command'] = new \Doctrine\Bundle\DoctrineBundle\Command\Proxy\CreateSchemaDoctrineCommand();
    }

    /**
     * Gets the public 'doctrine.schema_drop_command' shared service.
     *
     * @return \Doctrine\Bundle\DoctrineBundle\Command\Proxy\DropSchemaDoctrineCommand
     */
    protected function getDoctrine_SchemaDropCommandService()
    {
        return $this->services['doctrine.schema_drop_command'] = new \Doctrine\Bundle\DoctrineBundle\Command\Proxy\DropSchemaDoctrineCommand();
    }

    /**
     * Gets the public 'doctrine.schema_update_command' shared service.
     *
     * @return \Doctrine\Bundle\DoctrineBundle\Command\Proxy\UpdateSchemaDoctrineCommand
     */
    protected function getDoctrine_SchemaUpdateCommandService()
    {
        return $this->services['doctrine.schema_update_command'] = new \Doctrine\Bundle\DoctrineBundle\Command\Proxy\UpdateSchemaDoctrineCommand();
    }

    /**
     * Gets the public 'doctrine.schema_validate_command' shared service.
     *
     * @return \Doctrine\Bundle\DoctrineBundle\Command\Proxy\ValidateSchemaCommand
     */
    protected function getDoctrine_SchemaValidateCommandService()
    {
        return $this->services['doctrine.schema_validate_command'] = new \Doctrine\Bundle\DoctrineBundle\Command\Proxy\ValidateSchemaCommand();
    }

    /**
     * Gets the public 'doctrine_cache.contains_command' shared service.
     *
     * @return \Doctrine\Bundle\DoctrineCacheBundle\Command\ContainsCommand
     */
    protected function getDoctrineCache_ContainsCommandService()
    {
        return $this->services['doctrine_cache.contains_command'] = new \Doctrine\Bundle\DoctrineCacheBundle\Command\ContainsCommand();
    }

    /**
     * Gets the public 'doctrine_cache.delete_command' shared service.
     *
     * @return \Doctrine\Bundle\DoctrineCacheBundle\Command\DeleteCommand
     */
    protected function getDoctrineCache_DeleteCommandService()
    {
        return $this->services['doctrine_cache.delete_command'] = new \Doctrine\Bundle\DoctrineCacheBundle\Command\DeleteCommand();
    }

    /**
     * Gets the public 'doctrine_cache.flush_command' shared service.
     *
     * @return \Doctrine\Bundle\DoctrineCacheBundle\Command\FlushCommand
     */
    protected function getDoctrineCache_FlushCommandService()
    {
        return $this->services['doctrine_cache.flush_command'] = new \Doctrine\Bundle\DoctrineCacheBundle\Command\FlushCommand();
    }

    /**
     * Gets the public 'doctrine_cache.providers.doctrine.orm.default_metadata_cache' shared service.
     *
     * @return \Doctrine\Common\Cache\ArrayCache
     */
    protected function getDoctrineCache_Providers_Doctrine_Orm_DefaultMetadataCacheService()
    {
        $this->services['doctrine_cache.providers.doctrine.orm.default_metadata_cache'] = $instance = new \Doctrine\Common\Cache\ArrayCache();

        $instance->setNamespace('sf_orm_default_a78747a2206fe1c8365d852ecfd51b010122ad8b93d032cef6756f5393211aef');

        return $instance;
    }

    /**
     * Gets the public 'doctrine_cache.providers.doctrine.orm.default_query_cache' shared service.
     *
     * @return \Doctrine\Common\Cache\ArrayCache
     */
    protected function getDoctrineCache_Providers_Doctrine_Orm_DefaultQueryCacheService()
    {
        $this->services['doctrine_cache.providers.doctrine.orm.default_query_cache'] = $instance = new \Doctrine\Common\Cache\ArrayCache();

        $instance->setNamespace('sf_orm_default_a78747a2206fe1c8365d852ecfd51b010122ad8b93d032cef6756f5393211aef');

        return $instance;
    }

    /**
     * Gets the public 'doctrine_cache.providers.doctrine.orm.default_result_cache' shared service.
     *
     * @return \Doctrine\Common\Cache\ArrayCache
     */
    protected function getDoctrineCache_Providers_Doctrine_Orm_DefaultResultCacheService()
    {
        $this->services['doctrine_cache.providers.doctrine.orm.default_result_cache'] = $instance = new \Doctrine\Common\Cache\ArrayCache();

        $instance->setNamespace('sf_orm_default_a78747a2206fe1c8365d852ecfd51b010122ad8b93d032cef6756f5393211aef');

        return $instance;
    }

    /**
     * Gets the public 'doctrine_cache.stats_command' shared service.
     *
     * @return \Doctrine\Bundle\DoctrineCacheBundle\Command\StatsCommand
     */
    protected function getDoctrineCache_StatsCommandService()
    {
        return $this->services['doctrine_cache.stats_command'] = new \Doctrine\Bundle\DoctrineCacheBundle\Command\StatsCommand();
    }

    /**
     * Gets the public 'doctrine_migrations.diff_command' shared service.
     *
     * @return \Doctrine\Bundle\MigrationsBundle\Command\MigrationsDiffDoctrineCommand
     */
    protected function getDoctrineMigrations_DiffCommandService()
    {
        return $this->services['doctrine_migrations.diff_command'] = new \Doctrine\Bundle\MigrationsBundle\Command\MigrationsDiffDoctrineCommand();
    }

    /**
     * Gets the public 'doctrine_migrations.execute_command' shared service.
     *
     * @return \Doctrine\Bundle\MigrationsBundle\Command\MigrationsExecuteDoctrineCommand
     */
    protected function getDoctrineMigrations_ExecuteCommandService()
    {
        return $this->services['doctrine_migrations.execute_command'] = new \Doctrine\Bundle\MigrationsBundle\Command\MigrationsExecuteDoctrineCommand();
    }

    /**
     * Gets the public 'doctrine_migrations.generate_command' shared service.
     *
     * @return \Doctrine\Bundle\MigrationsBundle\Command\MigrationsGenerateDoctrineCommand
     */
    protected function getDoctrineMigrations_GenerateCommandService()
    {
        return $this->services['doctrine_migrations.generate_command'] = new \Doctrine\Bundle\MigrationsBundle\Command\MigrationsGenerateDoctrineCommand();
    }

    /**
     * Gets the public 'doctrine_migrations.latest_command' shared service.
     *
     * @return \Doctrine\Bundle\MigrationsBundle\Command\MigrationsLatestDoctrineCommand
     */
    protected function getDoctrineMigrations_LatestCommandService()
    {
        return $this->services['doctrine_migrations.latest_command'] = new \Doctrine\Bundle\MigrationsBundle\Command\MigrationsLatestDoctrineCommand();
    }

    /**
     * Gets the public 'doctrine_migrations.migrate_command' shared service.
     *
     * @return \Doctrine\Bundle\MigrationsBundle\Command\MigrationsMigrateDoctrineCommand
     */
    protected function getDoctrineMigrations_MigrateCommandService()
    {
        return $this->services['doctrine_migrations.migrate_command'] = new \Doctrine\Bundle\MigrationsBundle\Command\MigrationsMigrateDoctrineCommand();
    }

    /**
     * Gets the public 'doctrine_migrations.status_command' shared service.
     *
     * @return \Doctrine\Bundle\MigrationsBundle\Command\MigrationsStatusDoctrineCommand
     */
    protected function getDoctrineMigrations_StatusCommandService()
    {
        return $this->services['doctrine_migrations.status_command'] = new \Doctrine\Bundle\MigrationsBundle\Command\MigrationsStatusDoctrineCommand();
    }

    /**
     * Gets the public 'doctrine_migrations.version_command' shared service.
     *
     * @return \Doctrine\Bundle\MigrationsBundle\Command\MigrationsVersionDoctrineCommand
     */
    protected function getDoctrineMigrations_VersionCommandService()
    {
        return $this->services['doctrine_migrations.version_command'] = new \Doctrine\Bundle\MigrationsBundle\Command\MigrationsVersionDoctrineCommand();
    }

    /**
     * Gets the public 'file_locator' shared service.
     *
     * @return \Symfony\Component\HttpKernel\Config\FileLocator
     */
    protected function getFileLocatorService()
    {
        return $this->services['file_locator'] = new \Symfony\Component\HttpKernel\Config\FileLocator($this->get('kernel'), ($this->targetDirs[2].'/Resources'));
    }

    /**
     * Gets the public 'filesystem' shared service.
     *
     * @return \Symfony\Component\Filesystem\Filesystem
     */
    protected function getFilesystemService()
    {
        return $this->services['filesystem'] = new \Symfony\Component\Filesystem\Filesystem();
    }

    /**
     * Gets the public 'form.csrf_provider' shared service.
     *
     * @return \Symfony\Component\Form\Extension\Csrf\CsrfProvider\CsrfTokenManagerAdapter
     *
     * @deprecated The "form.csrf_provider" service is deprecated since Symfony 2.4 and will be removed in 3.0. Use the "security.csrf.token_manager" service instead.
     */
    protected function getForm_CsrfProviderService()
    {
        @trigger_error('The "form.csrf_provider" service is deprecated since Symfony 2.4 and will be removed in 3.0. Use the "security.csrf.token_manager" service instead.', E_USER_DEPRECATED);

        return $this->services['form.csrf_provider'] = new \Symfony\Component\Form\Extension\Csrf\CsrfProvider\CsrfTokenManagerAdapter($this->get('security.csrf.token_manager'));
    }

    /**
     * Gets the public 'form.extension' shared service.
     *
     * @return \Sonata\CoreBundle\Form\Extension\DependencyInjectionExtension
     */
    protected function getForm_ExtensionService()
    {
        return $this->services['form.extension'] = new \Sonata\CoreBundle\Form\Extension\DependencyInjectionExtension($this, array('form' => 'form.type.form', 'Symfony\\Component\\Form\\Extension\\Core\\Type\\FormType' => 'form.type.form', 'birthday' => 'form.type.birthday', 'Symfony\\Component\\Form\\Extension\\Core\\Type\\BirthdayType' => 'form.type.birthday', 'checkbox' => 'form.type.checkbox', 'Symfony\\Component\\Form\\Extension\\Core\\Type\\CheckboxType' => 'form.type.checkbox', 'choice' => 'form.type.choice', 'Symfony\\Component\\Form\\Extension\\Core\\Type\\ChoiceType' => 'form.type.choice', 'collection' => 'form.type.collection', 'Symfony\\Component\\Form\\Extension\\Core\\Type\\CollectionType' => 'form.type.collection', 'country' => 'form.type.country', 'Symfony\\Component\\Form\\Extension\\Core\\Type\\CountryType' => 'form.type.country', 'date' => 'form.type.date', 'Symfony\\Component\\Form\\Extension\\Core\\Type\\DateType' => 'form.type.date', 'datetime' => 'form.type.datetime', 'Symfony\\Component\\Form\\Extension\\Core\\Type\\DateTimeType' => 'form.type.datetime', 'email' => 'form.type.email', 'Symfony\\Component\\Form\\Extension\\Core\\Type\\EmailType' => 'form.type.email', 'file' => 'form.type.file', 'Symfony\\Component\\Form\\Extension\\Core\\Type\\FileType' => 'form.type.file', 'hidden' => 'form.type.hidden', 'Symfony\\Component\\Form\\Extension\\Core\\Type\\HiddenType' => 'form.type.hidden', 'integer' => 'form.type.integer', 'Symfony\\Component\\Form\\Extension\\Core\\Type\\IntegerType' => 'form.type.integer', 'language' => 'form.type.language', 'Symfony\\Component\\Form\\Extension\\Core\\Type\\LanguageType' => 'form.type.language', 'locale' => 'form.type.locale', 'Symfony\\Component\\Form\\Extension\\Core\\Type\\LocaleType' => 'form.type.locale', 'money' => 'form.type.money', 'Symfony\\Component\\Form\\Extension\\Core\\Type\\MoneyType' => 'form.type.money', 'number' => 'form.type.number', 'Symfony\\Component\\Form\\Extension\\Core\\Type\\NumberType' => 'form.type.number', 'password' => 'form.type.password', 'Symfony\\Component\\Form\\Extension\\Core\\Type\\PasswordType' => 'form.type.password', 'percent' => 'form.type.percent', 'Symfony\\Component\\Form\\Extension\\Core\\Type\\PercentType' => 'form.type.percent', 'radio' => 'form.type.radio', 'Symfony\\Component\\Form\\Extension\\Core\\Type\\RadioType' => 'form.type.radio', 'range' => 'form.type.range', 'Symfony\\Component\\Form\\Extension\\Core\\Type\\RangeType' => 'form.type.range', 'repeated' => 'form.type.repeated', 'Symfony\\Component\\Form\\Extension\\Core\\Type\\RepeatedType' => 'form.type.repeated', 'search' => 'form.type.search', 'Symfony\\Component\\Form\\Extension\\Core\\Type\\SearchType' => 'form.type.search', 'textarea' => 'form.type.textarea', 'Symfony\\Component\\Form\\Extension\\Core\\Type\\TextareaType' => 'form.type.textarea', 'text' => 'form.type.text', 'Symfony\\Component\\Form\\Extension\\Core\\Type\\TextType' => 'form.type.text', 'time' => 'form.type.time', 'Symfony\\Component\\Form\\Extension\\Core\\Type\\TimeType' => 'form.type.time', 'timezone' => 'form.type.timezone', 'Symfony\\Component\\Form\\Extension\\Core\\Type\\TimezoneType' => 'form.type.timezone', 'url' => 'form.type.url', 'Symfony\\Component\\Form\\Extension\\Core\\Type\\UrlType' => 'form.type.url', 'button' => 'form.type.button', 'Symfony\\Component\\Form\\Extension\\Core\\Type\\ButtonType' => 'form.type.button', 'submit' => 'form.type.submit', 'Symfony\\Component\\Form\\Extension\\Core\\Type\\SubmitType' => 'form.type.submit', 'reset' => 'form.type.reset', 'Symfony\\Component\\Form\\Extension\\Core\\Type\\ResetType' => 'form.type.reset', 'currency' => 'form.type.currency', 'Symfony\\Component\\Form\\Extension\\Core\\Type\\CurrencyType' => 'form.type.currency', 'entity' => 'form.type.entity', 'Symfony\\Bridge\\Doctrine\\Form\\Type\\EntityType' => 'form.type.entity', 'sonata_type_immutable_array' => 'sonata.core.form.type.array', 'Sonata\\CoreBundle\\Form\\Type\\ImmutableArrayType' => 'sonata.core.form.type.array', 'sonata_type_boolean' => 'sonata.core.form.type.boolean', 'Sonata\\CoreBundle\\Form\\Type\\BooleanType' => 'sonata.core.form.type.boolean', 'sonata_type_collection' => 'sonata.core.form.type.collection', 'Sonata\\CoreBundle\\Form\\Type\\CollectionType' => 'sonata.core.form.type.collection', 'sonata_type_translatable_choice' => 'sonata.core.form.type.translatable_choice', 'Sonata\\CoreBundle\\Form\\Type\\TranslatableChoiceType' => 'sonata.core.form.type.translatable_choice', 'sonata_type_date_range' => 'sonata.core.form.type.date_range', 'Sonata\\CoreBundle\\Form\\Type\\DateRangeType' => 'sonata.core.form.type.date_range', 'sonata_type_datetime_range' => 'sonata.core.form.type.datetime_range', 'Sonata\\CoreBundle\\Form\\Type\\DateTimeRangeType' => 'sonata.core.form.type.datetime_range', 'sonata_type_date_picker' => 'sonata.core.form.type.date_picker', 'Sonata\\CoreBundle\\Form\\Type\\DatePickerType' => 'sonata.core.form.type.date_picker', 'sonata_type_datetime_picker' => 'sonata.core.form.type.datetime_picker', 'Sonata\\CoreBundle\\Form\\Type\\DateTimePickerType' => 'sonata.core.form.type.datetime_picker', 'sonata_type_date_range_picker' => 'sonata.core.form.type.date_range_picker', 'Sonata\\CoreBundle\\Form\\Type\\DateRangePickerType' => 'sonata.core.form.type.date_range_picker', 'sonata_type_datetime_range_picker' => 'sonata.core.form.type.datetime_range_picker', 'Sonata\\CoreBundle\\Form\\Type\\DateTimeRangePickerType' => 'sonata.core.form.type.datetime_range_picker', 'sonata_type_equal' => 'sonata.core.form.type.equal', 'Sonata\\CoreBundle\\Form\\Type\\EqualType' => 'sonata.core.form.type.equal', 'sonata_type_color_selector' => 'sonata.core.form.type.color_selector', 'Sonata\\CoreBundle\\Form\\Type\\ColorSelectorType' => 'sonata.core.form.type.color_selector', 'sonata_type_color' => 'sonata.core.form.type.color', 'Sonata\\CoreBundle\\Form\\Type\\ColorType' => 'sonata.core.form.type.color', 'sonata_block_service_choice' => 'sonata.block.form.type.block', 'Sonata\\BlockBundle\\Form\\Type\\ServiceListType' => 'sonata.block.form.type.block', 'sonata_type_container_template_choice' => 'sonata.block.form.type.container_template', 'Sonata\\BlockBundle\\Form\\Type\\ContainerTemplateType' => 'sonata.block.form.type.container_template', 'sonata_type_admin' => 'sonata.admin.form.type.admin', 'Sonata\\AdminBundle\\Form\\Type\\AdminType' => 'sonata.admin.form.type.admin', 'sonata_type_model' => 'sonata.admin.form.type.model_choice', 'Sonata\\AdminBundle\\Form\\Type\\ModelType' => 'sonata.admin.form.type.model_choice', 'sonata_type_model_list' => 'sonata.admin.form.type.model_list', 'Sonata\\AdminBundle\\Form\\Type\\ModelListType' => 'sonata.admin.form.type.model_list', 'sonata_type_model_reference' => 'sonata.admin.form.type.model_reference', 'Sonata\\AdminBundle\\Form\\Type\\ModelReferenceType' => 'sonata.admin.form.type.model_reference', 'sonata_type_model_hidden' => 'sonata.admin.form.type.model_hidden', 'Sonata\\AdminBundle\\Form\\Type\\ModelHiddenType' => 'sonata.admin.form.type.model_hidden', 'sonata_type_model_autocomplete' => 'sonata.admin.form.type.model_autocomplete', 'Sonata\\AdminBundle\\Form\\Type\\ModelAutocompleteType' => 'sonata.admin.form.type.model_autocomplete', 'sonata_type_native_collection' => 'sonata.admin.form.type.collection', 'Sonata\\AdminBundle\\Form\\Type\\CollectionType' => 'sonata.admin.form.type.collection', 'sonata_type_choice_field_mask' => 'sonata.admin.doctrine_orm.form.type.choice_field_mask', 'Sonata\\AdminBundle\\Form\\Type\\ChoiceFieldMaskType' => 'sonata.admin.doctrine_orm.form.type.choice_field_mask', 'sonata_type_filter_number' => 'sonata.admin.form.filter.type.number', 'Sonata\\AdminBundle\\Form\\Type\\Filter\\NumberType' => 'sonata.admin.form.filter.type.number', 'sonata_type_filter_choice' => 'sonata.admin.form.filter.type.choice', 'Sonata\\AdminBundle\\Form\\Type\\Filter\\ChoiceType' => 'sonata.admin.form.filter.type.choice', 'sonata_type_filter_default' => 'sonata.admin.form.filter.type.default', 'Sonata\\AdminBundle\\Form\\Type\\Filter\\DefaultType' => 'sonata.admin.form.filter.type.default', 'sonata_type_filter_date' => 'sonata.admin.form.filter.type.date', 'Sonata\\AdminBundle\\Form\\Type\\Filter\\DateType' => 'sonata.admin.form.filter.type.date', 'sonata_type_filter_date_range' => 'sonata.admin.form.filter.type.daterange', 'Sonata\\AdminBundle\\Form\\Type\\Filter\\DateRangeType' => 'sonata.admin.form.filter.type.daterange', 'sonata_type_filter_datetime' => 'sonata.admin.form.filter.type.datetime', 'Sonata\\AdminBundle\\Form\\Type\\Filter\\DateTimeType' => 'sonata.admin.form.filter.type.datetime', 'sonata_type_filter_datetime_range' => 'sonata.admin.form.filter.type.datetime_range', 'Sonata\\AdminBundle\\Form\\Type\\Filter\\DateTimeRangeType' => 'sonata.admin.form.filter.type.datetime_range'), array('Symfony\\Component\\Form\\Extension\\Core\\Type\\FormType' => array(0 => 'form.type_extension.form.http_foundation', 1 => 'form.type_extension.form.validator', 2 => 'form.type_extension.upload.validator', 3 => 'form.type_extension.csrf', 4 => 'form.type_extension.form.data_collector', 5 => 'fos_rest.form.extension.csrf_disable', 6 => 'nelmio_api_doc.form.extension.description_form_type_extension', 7 => 'sonata.admin.form.extension.field', 8 => 'sonata.admin.form.extension.field.mopa'), 'Symfony\\Component\\Form\\Extension\\Core\\Type\\RepeatedType' => array(0 => 'form.type_extension.repeated.validator'), 'Symfony\\Component\\Form\\Extension\\Core\\Type\\SubmitType' => array(0 => 'form.type_extension.submit.validator'), 'Symfony\\Component\\Form\\Extension\\Core\\Type\\ChoiceType' => array(0 => 'sonata.admin.form.extension.choice')), array(0 => 'form.type_guesser.validator', 1 => 'form.type_guesser.doctrine'), array('form' => 'Symfony\\Component\\Form\\Extension\\Core\\Type\\FormType', 'birthday' => 'Symfony\\Component\\Form\\Extension\\Core\\Type\\BirthdayType', 'checkbox' => 'Symfony\\Component\\Form\\Extension\\Core\\Type\\CheckboxType', 'choice' => 'Symfony\\Component\\Form\\Extension\\Core\\Type\\ChoiceType', 'collection' => 'Symfony\\Component\\Form\\Extension\\Core\\Type\\CollectionType', 'country' => 'Symfony\\Component\\Form\\Extension\\Core\\Type\\CountryType', 'date' => 'Symfony\\Component\\Form\\Extension\\Core\\Type\\DateType', 'datetime' => 'Symfony\\Component\\Form\\Extension\\Core\\Type\\DateTimeType', 'email' => 'Symfony\\Component\\Form\\Extension\\Core\\Type\\EmailType', 'file' => 'Symfony\\Component\\Form\\Extension\\Core\\Type\\FileType', 'hidden' => 'Symfony\\Component\\Form\\Extension\\Core\\Type\\HiddenType', 'integer' => 'Symfony\\Component\\Form\\Extension\\Core\\Type\\IntegerType', 'language' => 'Symfony\\Component\\Form\\Extension\\Core\\Type\\LanguageType', 'locale' => 'Symfony\\Component\\Form\\Extension\\Core\\Type\\LocaleType', 'money' => 'Symfony\\Component\\Form\\Extension\\Core\\Type\\MoneyType', 'number' => 'Symfony\\Component\\Form\\Extension\\Core\\Type\\NumberType', 'password' => 'Symfony\\Component\\Form\\Extension\\Core\\Type\\PasswordType', 'percent' => 'Symfony\\Component\\Form\\Extension\\Core\\Type\\PercentType', 'radio' => 'Symfony\\Component\\Form\\Extension\\Core\\Type\\RadioType', 'repeated' => 'Symfony\\Component\\Form\\Extension\\Core\\Type\\RepeatedType', 'search' => 'Symfony\\Component\\Form\\Extension\\Core\\Type\\SearchType', 'textarea' => 'Symfony\\Component\\Form\\Extension\\Core\\Type\\TextareaType', 'text' => 'Symfony\\Component\\Form\\Extension\\Core\\Type\\TextType', 'time' => 'Symfony\\Component\\Form\\Extension\\Core\\Type\\TimeType', 'timezone' => 'Symfony\\Component\\Form\\Extension\\Core\\Type\\TimezoneType', 'url' => 'Symfony\\Component\\Form\\Extension\\Core\\Type\\UrlType', 'button' => 'Symfony\\Component\\Form\\Extension\\Core\\Type\\ButtonType', 'submit' => 'Symfony\\Component\\Form\\Extension\\Core\\Type\\SubmitType', 'reset' => 'Symfony\\Component\\Form\\Extension\\Core\\Type\\ResetType', 'currency' => 'Symfony\\Component\\Form\\Extension\\Core\\Type\\CurrencyType', 'entity' => 'Symfony\\Bridge\\Doctrine\\Form\\Type\\EntityType', 'sonata_type_immutable_array' => 'Sonata\\CoreBundle\\Form\\Type\\ImmutableArrayType', 'sonata_type_boolean' => 'Sonata\\CoreBundle\\Form\\Type\\BooleanType', 'sonata_type_collection' => 'Sonata\\CoreBundle\\Form\\Type\\CollectionType', 'sonata_type_translatable_choice' => 'Sonata\\CoreBundle\\Form\\Type\\TranslatableChoiceType', 'sonata_type_date_range' => 'Sonata\\CoreBundle\\Form\\Type\\DateRangeType', 'sonata_type_datetime_range' => 'Sonata\\CoreBundle\\Form\\Type\\DateTimeRangeType', 'sonata_type_date_picker' => 'Sonata\\CoreBundle\\Form\\Type\\DatePickerType', 'sonata_type_datetime_picker' => 'Sonata\\CoreBundle\\Form\\Type\\DateTimePickerType', 'sonata_type_date_range_picker' => 'Sonata\\CoreBundle\\Form\\Type\\DateRangePickerType', 'sonata_type_datetime_range_picker' => 'Sonata\\CoreBundle\\Form\\Type\\DateTimeRangePickerType', 'sonata_type_equal' => 'Sonata\\CoreBundle\\Form\\Type\\EqualType', 'sonata_type_color' => 'Sonata\\CoreBundle\\Form\\Type\\ColorType', 'sonata_type_color_selector' => 'Sonata\\CoreBundle\\Form\\Type\\ColorSelectorType', 'sonata_block_service_choice' => 'Sonata\\BlockBundle\\Form\\Type\\ServiceListType', 'sonata_type_container_template_choice' => 'Sonata\\BlockBundle\\Form\\Type\\ContainerTemplateType', 'sonata_type_admin' => 'Sonata\\AdminBundle\\Form\\Type\\AdminType', 'sonata_type_model' => 'Sonata\\AdminBundle\\Form\\Type\\ModelType', 'sonata_type_model_list' => 'Sonata\\AdminBundle\\Form\\Type\\ModelListType', 'sonata_type_model_reference' => 'Sonata\\AdminBundle\\Form\\Type\\ModelReferenceType', 'sonata_type_model_hidden' => 'Sonata\\AdminBundle\\Form\\Type\\ModelHiddenType', 'sonata_type_model_autocomplete' => 'Sonata\\AdminBundle\\Form\\Type\\ModelAutocompleteType', 'sonata_type_native_collection' => 'Sonata\\AdminBundle\\Form\\Type\\CollectionType', 'sonata_type_choice_field_mask' => 'Sonata\\AdminBundle\\Form\\Type\\ChoiceFieldMaskType', 'sonata_type_filter_number' => 'Sonata\\AdminBundle\\Form\\Type\\Filter\\NumberType', 'sonata_type_filter_choice' => 'Sonata\\AdminBundle\\Form\\Type\\Filter\\ChoiceType', 'sonata_type_filter_default' => 'Sonata\\AdminBundle\\Form\\Type\\Filter\\DefaultType', 'sonata_type_filter_date' => 'Sonata\\AdminBundle\\Form\\Type\\Filter\\DateType', 'sonata_type_filter_date_range' => 'Sonata\\AdminBundle\\Form\\Type\\Filter\\DateRangeType', 'sonata_type_filter_datetime' => 'Sonata\\AdminBundle\\Form\\Type\\Filter\\DateTimeType', 'sonata_type_filter_datetime_range' => 'Sonata\\AdminBundle\\Form\\Type\\Filter\\DateTimeRangeType', 'tab' => 'Mopa\\Bundle\\BootstrapBundle\\Form\\Type\\TabType'), array('form' => array(0 => 'form.type_extension.form.http_foundation', 1 => 'form.type_extension.form.validator', 2 => 'form.type_extension.csrf', 3 => 'form.type_extension.form.data_collector', 4 => 'nelmio_api_doc.form.extension.description_form_type_extension', 5 => 'sonata.admin.form.extension.field', 6 => 'mopa_bootstrap.form.type_extension.help', 7 => 'mopa_bootstrap.form.type_extension.legend', 8 => 'mopa_bootstrap.form.type_extension.error', 9 => 'mopa_bootstrap.form.type_extension.widget', 10 => 'mopa_bootstrap.form.type_extension.horizontal', 11 => 'mopa_bootstrap.form.type_extension.widget_collection', 12 => 'mopa_bootstrap.form.type_extension.tabbed', 13 => 'form.type_extension.form.http_foundation', 14 => 'form.type_extension.form.validator', 15 => 'form.type_extension.csrf', 16 => 'form.type_extension.form.data_collector', 17 => 'nelmio_api_doc.form.extension.description_form_type_extension', 18 => 'sonata.admin.form.extension.field', 19 => 'mopa_bootstrap.form.type_extension.help', 20 => 'mopa_bootstrap.form.type_extension.legend', 21 => 'mopa_bootstrap.form.type_extension.error', 22 => 'mopa_bootstrap.form.type_extension.widget', 23 => 'mopa_bootstrap.form.type_extension.horizontal', 24 => 'mopa_bootstrap.form.type_extension.widget_collection', 25 => 'mopa_bootstrap.form.type_extension.tabbed', 26 => 'form.type_extension.form.http_foundation', 27 => 'form.type_extension.form.validator', 28 => 'form.type_extension.csrf', 29 => 'form.type_extension.form.data_collector', 30 => 'nelmio_api_doc.form.extension.description_form_type_extension', 31 => 'sonata.admin.form.extension.field', 32 => 'mopa_bootstrap.form.type_extension.help', 33 => 'mopa_bootstrap.form.type_extension.legend', 34 => 'mopa_bootstrap.form.type_extension.error', 35 => 'mopa_bootstrap.form.type_extension.widget', 36 => 'mopa_bootstrap.form.type_extension.horizontal', 37 => 'mopa_bootstrap.form.type_extension.widget_collection', 38 => 'mopa_bootstrap.form.type_extension.tabbed'), 'repeated' => array(0 => 'form.type_extension.repeated.validator', 1 => 'form.type_extension.repeated.validator', 2 => 'form.type_extension.repeated.validator'), 'submit' => array(0 => 'form.type_extension.submit.validator', 1 => 'form.type_extension.submit.validator', 2 => 'form.type_extension.submit.validator'), 'choice' => array(0 => 'sonata.admin.form.extension.choice', 1 => 'sonata.admin.form.extension.choice', 2 => 'sonata.admin.form.extension.choice'), 'button' => array(0 => 'mopa_bootstrap.form.type_extension.button', 1 => 'mopa_bootstrap.form.type_extension.button', 2 => 'mopa_bootstrap.form.type_extension.button'), 'date' => array(0 => 'mopa_bootstrap.form.type_extension.date', 1 => 'mopa_bootstrap.form.type_extension.date', 2 => 'mopa_bootstrap.form.type_extension.date')), array());
    }

    /**
     * Gets the public 'form.factory' shared service.
     *
     * @return \Symfony\Component\Form\FormFactory
     */
    protected function getForm_FactoryService()
    {
        return $this->services['form.factory'] = new \Symfony\Component\Form\FormFactory($this->get('form.registry'), $this->get('form.resolved_type_factory'));
    }

    /**
     * Gets the public 'form.registry' shared service.
     *
     * @return \Symfony\Component\Form\FormRegistry
     */
    protected function getForm_RegistryService()
    {
        return $this->services['form.registry'] = new \Symfony\Component\Form\FormRegistry(array(0 => $this->get('form.extension')), $this->get('form.resolved_type_factory'));
    }

    /**
     * Gets the public 'form.resolved_type_factory' shared service.
     *
     * @return \Symfony\Component\Form\Extension\DataCollector\Proxy\ResolvedTypeFactoryDataCollectorProxy
     */
    protected function getForm_ResolvedTypeFactoryService()
    {
        return $this->services['form.resolved_type_factory'] = new \Symfony\Component\Form\Extension\DataCollector\Proxy\ResolvedTypeFactoryDataCollectorProxy(new \Symfony\Component\Form\ResolvedFormTypeFactory(), $this->get('data_collector.form'));
    }

    /**
     * Gets the public 'form.type.birthday' shared service.
     *
     * @return \Symfony\Component\Form\Extension\Core\Type\BirthdayType
     */
    protected function getForm_Type_BirthdayService()
    {
        return $this->services['form.type.birthday'] = new \Symfony\Component\Form\Extension\Core\Type\BirthdayType();
    }

    /**
     * Gets the public 'form.type.button' shared service.
     *
     * @return \Symfony\Component\Form\Extension\Core\Type\ButtonType
     */
    protected function getForm_Type_ButtonService()
    {
        return $this->services['form.type.button'] = new \Symfony\Component\Form\Extension\Core\Type\ButtonType();
    }

    /**
     * Gets the public 'form.type.checkbox' shared service.
     *
     * @return \Symfony\Component\Form\Extension\Core\Type\CheckboxType
     */
    protected function getForm_Type_CheckboxService()
    {
        return $this->services['form.type.checkbox'] = new \Symfony\Component\Form\Extension\Core\Type\CheckboxType();
    }

    /**
     * Gets the public 'form.type.choice' shared service.
     *
     * @return \Symfony\Component\Form\Extension\Core\Type\ChoiceType
     */
    protected function getForm_Type_ChoiceService()
    {
        return $this->services['form.type.choice'] = new \Symfony\Component\Form\Extension\Core\Type\ChoiceType(new \Symfony\Component\Form\ChoiceList\Factory\CachingFactoryDecorator(new \Symfony\Component\Form\ChoiceList\Factory\PropertyAccessDecorator(new \Symfony\Component\Form\ChoiceList\Factory\DefaultChoiceListFactory(), $this->get('property_accessor'))));
    }

    /**
     * Gets the public 'form.type.collection' shared service.
     *
     * @return \Symfony\Component\Form\Extension\Core\Type\CollectionType
     */
    protected function getForm_Type_CollectionService()
    {
        return $this->services['form.type.collection'] = new \Symfony\Component\Form\Extension\Core\Type\CollectionType();
    }

    /**
     * Gets the public 'form.type.country' shared service.
     *
     * @return \Symfony\Component\Form\Extension\Core\Type\CountryType
     */
    protected function getForm_Type_CountryService()
    {
        return $this->services['form.type.country'] = new \Symfony\Component\Form\Extension\Core\Type\CountryType();
    }

    /**
     * Gets the public 'form.type.currency' shared service.
     *
     * @return \Symfony\Component\Form\Extension\Core\Type\CurrencyType
     */
    protected function getForm_Type_CurrencyService()
    {
        return $this->services['form.type.currency'] = new \Symfony\Component\Form\Extension\Core\Type\CurrencyType();
    }

    /**
     * Gets the public 'form.type.date' shared service.
     *
     * @return \Symfony\Component\Form\Extension\Core\Type\DateType
     */
    protected function getForm_Type_DateService()
    {
        return $this->services['form.type.date'] = new \Symfony\Component\Form\Extension\Core\Type\DateType();
    }

    /**
     * Gets the public 'form.type.datetime' shared service.
     *
     * @return \Symfony\Component\Form\Extension\Core\Type\DateTimeType
     */
    protected function getForm_Type_DatetimeService()
    {
        return $this->services['form.type.datetime'] = new \Symfony\Component\Form\Extension\Core\Type\DateTimeType();
    }

    /**
     * Gets the public 'form.type.email' shared service.
     *
     * @return \Symfony\Component\Form\Extension\Core\Type\EmailType
     */
    protected function getForm_Type_EmailService()
    {
        return $this->services['form.type.email'] = new \Symfony\Component\Form\Extension\Core\Type\EmailType();
    }

    /**
     * Gets the public 'form.type.entity' shared service.
     *
     * @return \Symfony\Bridge\Doctrine\Form\Type\EntityType
     */
    protected function getForm_Type_EntityService()
    {
        return $this->services['form.type.entity'] = new \Symfony\Bridge\Doctrine\Form\Type\EntityType($this->get('doctrine'));
    }

    /**
     * Gets the public 'form.type.file' shared service.
     *
     * @return \Symfony\Component\Form\Extension\Core\Type\FileType
     */
    protected function getForm_Type_FileService()
    {
        return $this->services['form.type.file'] = new \Symfony\Component\Form\Extension\Core\Type\FileType();
    }

    /**
     * Gets the public 'form.type.form' shared service.
     *
     * @return \Symfony\Component\Form\Extension\Core\Type\FormType
     */
    protected function getForm_Type_FormService()
    {
        return $this->services['form.type.form'] = new \Symfony\Component\Form\Extension\Core\Type\FormType($this->get('property_accessor'));
    }

    /**
     * Gets the public 'form.type.hidden' shared service.
     *
     * @return \Symfony\Component\Form\Extension\Core\Type\HiddenType
     */
    protected function getForm_Type_HiddenService()
    {
        return $this->services['form.type.hidden'] = new \Symfony\Component\Form\Extension\Core\Type\HiddenType();
    }

    /**
     * Gets the public 'form.type.integer' shared service.
     *
     * @return \Symfony\Component\Form\Extension\Core\Type\IntegerType
     */
    protected function getForm_Type_IntegerService()
    {
        return $this->services['form.type.integer'] = new \Symfony\Component\Form\Extension\Core\Type\IntegerType();
    }

    /**
     * Gets the public 'form.type.language' shared service.
     *
     * @return \Symfony\Component\Form\Extension\Core\Type\LanguageType
     */
    protected function getForm_Type_LanguageService()
    {
        return $this->services['form.type.language'] = new \Symfony\Component\Form\Extension\Core\Type\LanguageType();
    }

    /**
     * Gets the public 'form.type.locale' shared service.
     *
     * @return \Symfony\Component\Form\Extension\Core\Type\LocaleType
     */
    protected function getForm_Type_LocaleService()
    {
        return $this->services['form.type.locale'] = new \Symfony\Component\Form\Extension\Core\Type\LocaleType();
    }

    /**
     * Gets the public 'form.type.money' shared service.
     *
     * @return \Symfony\Component\Form\Extension\Core\Type\MoneyType
     */
    protected function getForm_Type_MoneyService()
    {
        return $this->services['form.type.money'] = new \Symfony\Component\Form\Extension\Core\Type\MoneyType();
    }

    /**
     * Gets the public 'form.type.number' shared service.
     *
     * @return \Symfony\Component\Form\Extension\Core\Type\NumberType
     */
    protected function getForm_Type_NumberService()
    {
        return $this->services['form.type.number'] = new \Symfony\Component\Form\Extension\Core\Type\NumberType();
    }

    /**
     * Gets the public 'form.type.password' shared service.
     *
     * @return \Symfony\Component\Form\Extension\Core\Type\PasswordType
     */
    protected function getForm_Type_PasswordService()
    {
        return $this->services['form.type.password'] = new \Symfony\Component\Form\Extension\Core\Type\PasswordType();
    }

    /**
     * Gets the public 'form.type.percent' shared service.
     *
     * @return \Symfony\Component\Form\Extension\Core\Type\PercentType
     */
    protected function getForm_Type_PercentService()
    {
        return $this->services['form.type.percent'] = new \Symfony\Component\Form\Extension\Core\Type\PercentType();
    }

    /**
     * Gets the public 'form.type.radio' shared service.
     *
     * @return \Symfony\Component\Form\Extension\Core\Type\RadioType
     */
    protected function getForm_Type_RadioService()
    {
        return $this->services['form.type.radio'] = new \Symfony\Component\Form\Extension\Core\Type\RadioType();
    }

    /**
     * Gets the public 'form.type.range' shared service.
     *
     * @return \Symfony\Component\Form\Extension\Core\Type\RangeType
     */
    protected function getForm_Type_RangeService()
    {
        return $this->services['form.type.range'] = new \Symfony\Component\Form\Extension\Core\Type\RangeType();
    }

    /**
     * Gets the public 'form.type.repeated' shared service.
     *
     * @return \Symfony\Component\Form\Extension\Core\Type\RepeatedType
     */
    protected function getForm_Type_RepeatedService()
    {
        return $this->services['form.type.repeated'] = new \Symfony\Component\Form\Extension\Core\Type\RepeatedType();
    }

    /**
     * Gets the public 'form.type.reset' shared service.
     *
     * @return \Symfony\Component\Form\Extension\Core\Type\ResetType
     */
    protected function getForm_Type_ResetService()
    {
        return $this->services['form.type.reset'] = new \Symfony\Component\Form\Extension\Core\Type\ResetType();
    }

    /**
     * Gets the public 'form.type.search' shared service.
     *
     * @return \Symfony\Component\Form\Extension\Core\Type\SearchType
     */
    protected function getForm_Type_SearchService()
    {
        return $this->services['form.type.search'] = new \Symfony\Component\Form\Extension\Core\Type\SearchType();
    }

    /**
     * Gets the public 'form.type.submit' shared service.
     *
     * @return \Symfony\Component\Form\Extension\Core\Type\SubmitType
     */
    protected function getForm_Type_SubmitService()
    {
        return $this->services['form.type.submit'] = new \Symfony\Component\Form\Extension\Core\Type\SubmitType();
    }

    /**
     * Gets the public 'form.type.text' shared service.
     *
     * @return \Symfony\Component\Form\Extension\Core\Type\TextType
     */
    protected function getForm_Type_TextService()
    {
        return $this->services['form.type.text'] = new \Symfony\Component\Form\Extension\Core\Type\TextType();
    }

    /**
     * Gets the public 'form.type.textarea' shared service.
     *
     * @return \Symfony\Component\Form\Extension\Core\Type\TextareaType
     */
    protected function getForm_Type_TextareaService()
    {
        return $this->services['form.type.textarea'] = new \Symfony\Component\Form\Extension\Core\Type\TextareaType();
    }

    /**
     * Gets the public 'form.type.time' shared service.
     *
     * @return \Symfony\Component\Form\Extension\Core\Type\TimeType
     */
    protected function getForm_Type_TimeService()
    {
        return $this->services['form.type.time'] = new \Symfony\Component\Form\Extension\Core\Type\TimeType();
    }

    /**
     * Gets the public 'form.type.timezone' shared service.
     *
     * @return \Symfony\Component\Form\Extension\Core\Type\TimezoneType
     */
    protected function getForm_Type_TimezoneService()
    {
        return $this->services['form.type.timezone'] = new \Symfony\Component\Form\Extension\Core\Type\TimezoneType();
    }

    /**
     * Gets the public 'form.type.url' shared service.
     *
     * @return \Symfony\Component\Form\Extension\Core\Type\UrlType
     */
    protected function getForm_Type_UrlService()
    {
        return $this->services['form.type.url'] = new \Symfony\Component\Form\Extension\Core\Type\UrlType();
    }

    /**
     * Gets the public 'form.type_extension.csrf' shared service.
     *
     * @return \Symfony\Component\Form\Extension\Csrf\Type\FormTypeCsrfExtension
     */
    protected function getForm_TypeExtension_CsrfService()
    {
        return $this->services['form.type_extension.csrf'] = new \Symfony\Component\Form\Extension\Csrf\Type\FormTypeCsrfExtension($this->get('security.csrf.token_manager'), true, '_token', $this->get('translator.default'), 'validators', $this->get('form.server_params'));
    }

    /**
     * Gets the public 'form.type_extension.form.data_collector' shared service.
     *
     * @return \Symfony\Component\Form\Extension\DataCollector\Type\DataCollectorTypeExtension
     */
    protected function getForm_TypeExtension_Form_DataCollectorService()
    {
        return $this->services['form.type_extension.form.data_collector'] = new \Symfony\Component\Form\Extension\DataCollector\Type\DataCollectorTypeExtension($this->get('data_collector.form'));
    }

    /**
     * Gets the public 'form.type_extension.form.http_foundation' shared service.
     *
     * @return \Symfony\Component\Form\Extension\HttpFoundation\Type\FormTypeHttpFoundationExtension
     */
    protected function getForm_TypeExtension_Form_HttpFoundationService()
    {
        return $this->services['form.type_extension.form.http_foundation'] = new \Symfony\Component\Form\Extension\HttpFoundation\Type\FormTypeHttpFoundationExtension(new \Symfony\Component\Form\Extension\HttpFoundation\HttpFoundationRequestHandler($this->get('form.server_params')));
    }

    /**
     * Gets the public 'form.type_extension.form.validator' shared service.
     *
     * @return \Symfony\Component\Form\Extension\Validator\Type\FormTypeValidatorExtension
     */
    protected function getForm_TypeExtension_Form_ValidatorService()
    {
        return $this->services['form.type_extension.form.validator'] = new \Symfony\Component\Form\Extension\Validator\Type\FormTypeValidatorExtension($this->get('validator'));
    }

    /**
     * Gets the public 'form.type_extension.repeated.validator' shared service.
     *
     * @return \Symfony\Component\Form\Extension\Validator\Type\RepeatedTypeValidatorExtension
     */
    protected function getForm_TypeExtension_Repeated_ValidatorService()
    {
        return $this->services['form.type_extension.repeated.validator'] = new \Symfony\Component\Form\Extension\Validator\Type\RepeatedTypeValidatorExtension();
    }

    /**
     * Gets the public 'form.type_extension.submit.validator' shared service.
     *
     * @return \Symfony\Component\Form\Extension\Validator\Type\SubmitTypeValidatorExtension
     */
    protected function getForm_TypeExtension_Submit_ValidatorService()
    {
        return $this->services['form.type_extension.submit.validator'] = new \Symfony\Component\Form\Extension\Validator\Type\SubmitTypeValidatorExtension();
    }

    /**
     * Gets the public 'form.type_extension.upload.validator' shared service.
     *
     * @return \Symfony\Component\Form\Extension\Validator\Type\UploadValidatorExtension
     */
    protected function getForm_TypeExtension_Upload_ValidatorService()
    {
        return $this->services['form.type_extension.upload.validator'] = new \Symfony\Component\Form\Extension\Validator\Type\UploadValidatorExtension($this->get('translator'), 'validators');
    }

    /**
     * Gets the public 'form.type_guesser.doctrine' shared service.
     *
     * @return \Symfony\Bridge\Doctrine\Form\DoctrineOrmTypeGuesser
     */
    protected function getForm_TypeGuesser_DoctrineService()
    {
        return $this->services['form.type_guesser.doctrine'] = new \Symfony\Bridge\Doctrine\Form\DoctrineOrmTypeGuesser($this->get('doctrine'));
    }

    /**
     * Gets the public 'form.type_guesser.validator' shared service.
     *
     * @return \Symfony\Component\Form\Extension\Validator\ValidatorTypeGuesser
     */
    protected function getForm_TypeGuesser_ValidatorService()
    {
        return $this->services['form.type_guesser.validator'] = new \Symfony\Component\Form\Extension\Validator\ValidatorTypeGuesser($this->get('validator'));
    }

    /**
     * Gets the public 'fos_rest.access_denied_listener' shared service.
     *
     * @return \FOS\RestBundle\EventListener\AccessDeniedListener
     */
    protected function getFosRest_AccessDeniedListenerService()
    {
        return $this->services['fos_rest.access_denied_listener'] = new \FOS\RestBundle\EventListener\AccessDeniedListener(array('json' => true), NULL, 'twig.controller.exception:showAction', $this->get('monolog.logger.request', ContainerInterface::NULL_ON_INVALID_REFERENCE));
    }

    /**
     * Gets the public 'fos_rest.allowed_methods_listener' shared service.
     *
     * @return \FOS\RestBundle\EventListener\AllowedMethodsListener
     */
    protected function getFosRest_AllowedMethodsListenerService()
    {
        return $this->services['fos_rest.allowed_methods_listener'] = new \FOS\RestBundle\EventListener\AllowedMethodsListener($this->get('fos_rest.allowed_methods_loader'));
    }

    /**
     * Gets the public 'fos_rest.allowed_methods_loader' shared service.
     *
     * @return \FOS\RestBundle\Response\AllowedMethodsLoader\AllowedMethodsRouterLoader
     */
    protected function getFosRest_AllowedMethodsLoaderService()
    {
        return $this->services['fos_rest.allowed_methods_loader'] = new \FOS\RestBundle\Response\AllowedMethodsLoader\AllowedMethodsRouterLoader($this->get('router'), (__DIR__.'/fos_rest'), true);
    }

    /**
     * Gets the public 'fos_rest.body_listener' shared service.
     *
     * @return \FOS\RestBundle\EventListener\BodyListener
     */
    protected function getFosRest_BodyListenerService()
    {
        $this->services['fos_rest.body_listener'] = $instance = new \FOS\RestBundle\EventListener\BodyListener($this->get('fos_rest.decoder_provider'), false);

        $instance->setDefaultFormat(NULL);

        return $instance;
    }

    /**
     * Gets the public 'fos_rest.controller.exception' shared service.
     *
     * @return \FOS\RestBundle\Controller\ExceptionController
     */
    protected function getFosRest_Controller_ExceptionService()
    {
        $this->services['fos_rest.controller.exception'] = $instance = new \FOS\RestBundle\Controller\ExceptionController();

        $instance->setContainer($this);

        return $instance;
    }

    /**
     * Gets the public 'fos_rest.decoder.json' shared service.
     *
     * @return \FOS\RestBundle\Decoder\JsonDecoder
     */
    protected function getFosRest_Decoder_JsonService()
    {
        return $this->services['fos_rest.decoder.json'] = new \FOS\RestBundle\Decoder\JsonDecoder();
    }

    /**
     * Gets the public 'fos_rest.decoder.jsontoform' shared service.
     *
     * @return \FOS\RestBundle\Decoder\JsonToFormDecoder
     */
    protected function getFosRest_Decoder_JsontoformService()
    {
        return $this->services['fos_rest.decoder.jsontoform'] = new \FOS\RestBundle\Decoder\JsonToFormDecoder();
    }

    /**
     * Gets the public 'fos_rest.decoder.xml' shared service.
     *
     * @return \FOS\RestBundle\Decoder\XmlDecoder
     */
    protected function getFosRest_Decoder_XmlService()
    {
        return $this->services['fos_rest.decoder.xml'] = new \FOS\RestBundle\Decoder\XmlDecoder();
    }

    /**
     * Gets the public 'fos_rest.decoder_provider' shared service.
     *
     * @return \FOS\RestBundle\Decoder\ContainerDecoderProvider
     */
    protected function getFosRest_DecoderProviderService()
    {
        $this->services['fos_rest.decoder_provider'] = $instance = new \FOS\RestBundle\Decoder\ContainerDecoderProvider(array('json' => 'fos_rest.decoder.json', 'xml' => 'fos_rest.decoder.xml'));

        $instance->setContainer($this);

        return $instance;
    }

    /**
     * Gets the public 'fos_rest.exception_format_negotiator' shared service.
     *
     * @return \FOS\RestBundle\Negotiation\FormatNegotiator
     */
    protected function getFosRest_ExceptionFormatNegotiatorService()
    {
        $this->services['fos_rest.exception_format_negotiator'] = $instance = new \FOS\RestBundle\Negotiation\FormatNegotiator();

        $instance->add($this->get('fos_rest.request_matcher.50d7031fd332f324b33953b2158cded5b34cf57c3cd709fdaa24d6818252fd77ab4624ee'), array('methods' => NULL, 'priorities' => array(0 => 'html', 1 => 'json'), 'fallback_format' => 'html', 'prefer_extension' => '2.0'));
        $instance->add($this->get('fos_rest.request_matcher.0dfc4cce134bee15f08405cb5cea4845b13ff7d8c8f779004218432a2c552bd0cd9f9d27'), array('priorities' => array(0 => 'json', 1 => 'xml', 2 => 'html'), 'fallback_format' => NULL, 'prefer_extension' => '2.0', 'methods' => NULL, 'stop' => false));

        return $instance;
    }

    /**
     * Gets the public 'fos_rest.exception_listener' shared service.
     *
     * @return \Symfony\Component\HttpKernel\EventListener\ExceptionListener
     */
    protected function getFosRest_ExceptionListenerService()
    {
        return $this->services['fos_rest.exception_listener'] = new \Symfony\Component\HttpKernel\EventListener\ExceptionListener('fos_rest.controller.exception:showAction', $this->get('monolog.logger.request', ContainerInterface::NULL_ON_INVALID_REFERENCE));
    }

    /**
     * Gets the public 'fos_rest.form.extension.csrf_disable' shared service.
     *
     * @return \FOS\RestBundle\Form\Extension\DisableCSRFExtension
     */
    protected function getFosRest_Form_Extension_CsrfDisableService()
    {
        return $this->services['fos_rest.form.extension.csrf_disable'] = new \FOS\RestBundle\Form\Extension\DisableCSRFExtension($this->get('security.token_storage'), 'ROLE_API', $this->get('security.authorization_checker'));
    }

    /**
     * Gets the public 'fos_rest.format_listener' shared service.
     *
     * @return \FOS\RestBundle\EventListener\FormatListener
     */
    protected function getFosRest_FormatListenerService()
    {
        return $this->services['fos_rest.format_listener'] = new \FOS\RestBundle\EventListener\FormatListener($this->get('fos_rest.format_negotiator'));
    }

    /**
     * Gets the public 'fos_rest.format_negotiator' shared service.
     *
     * @return \FOS\RestBundle\Negotiation\FormatNegotiator
     */
    protected function getFosRest_FormatNegotiatorService()
    {
        $this->services['fos_rest.format_negotiator'] = $instance = new \FOS\RestBundle\Negotiation\FormatNegotiator();

        $instance->add($this->get('fos_rest.request_matcher.50d7031fd332f324b33953b2158cded5b34cf57c3cd709fdaa24d6818252fd77ab4624ee'), array('methods' => NULL, 'priorities' => array(0 => 'html', 1 => 'json'), 'fallback_format' => 'html', 'prefer_extension' => '2.0'));
        $instance->add($this->get('fos_rest.request_matcher.0dfc4cce134bee15f08405cb5cea4845b13ff7d8c8f779004218432a2c552bd0cd9f9d27'), array('priorities' => array(0 => 'json', 1 => 'xml', 2 => 'html'), 'fallback_format' => NULL, 'prefer_extension' => '2.0', 'methods' => NULL, 'stop' => false));

        return $instance;
    }

    /**
     * Gets the public 'fos_rest.inflector.doctrine' shared service.
     *
     * @return \FOS\RestBundle\Inflector\DoctrineInflector
     */
    protected function getFosRest_Inflector_DoctrineService()
    {
        return $this->services['fos_rest.inflector.doctrine'] = new \FOS\RestBundle\Inflector\DoctrineInflector();
    }

    /**
     * Gets the public 'fos_rest.normalizer.camel_keys' shared service.
     *
     * @return \FOS\RestBundle\Normalizer\CamelKeysNormalizer
     */
    protected function getFosRest_Normalizer_CamelKeysService()
    {
        return $this->services['fos_rest.normalizer.camel_keys'] = new \FOS\RestBundle\Normalizer\CamelKeysNormalizer();
    }

    /**
     * Gets the public 'fos_rest.normalizer.camel_keys_with_leading_underscore' shared service.
     *
     * @return \FOS\RestBundle\Normalizer\CamelKeysNormalizerWithLeadingUnderscore
     */
    protected function getFosRest_Normalizer_CamelKeysWithLeadingUnderscoreService()
    {
        return $this->services['fos_rest.normalizer.camel_keys_with_leading_underscore'] = new \FOS\RestBundle\Normalizer\CamelKeysNormalizerWithLeadingUnderscore();
    }

    /**
     * Gets the public 'fos_rest.param_fetcher_listener' shared service.
     *
     * @return \FOS\RestBundle\EventListener\ParamFetcherListener
     */
    protected function getFosRest_ParamFetcherListenerService()
    {
        return $this->services['fos_rest.param_fetcher_listener'] = new \FOS\RestBundle\EventListener\ParamFetcherListener($this, false);
    }

    /**
     * Gets the public 'fos_rest.request.param_fetcher' shared service.
     *
     * @return \FOS\RestBundle\Request\ParamFetcher
     */
    protected function getFosRest_Request_ParamFetcherService()
    {
        return $this->services['fos_rest.request.param_fetcher'] = new \FOS\RestBundle\Request\ParamFetcher($this->get('fos_rest.request.param_fetcher.reader'), $this->get('request_stack', ContainerInterface::NULL_ON_INVALID_REFERENCE), $this->get('fos_rest.violation_formatter'), $this->get('validator', ContainerInterface::NULL_ON_INVALID_REFERENCE), false);
    }

    /**
     * Gets the public 'fos_rest.request.param_fetcher.reader' shared service.
     *
     * @return \FOS\RestBundle\Request\ParamReader
     */
    protected function getFosRest_Request_ParamFetcher_ReaderService()
    {
        return $this->services['fos_rest.request.param_fetcher.reader'] = new \FOS\RestBundle\Request\ParamReader($this->get('annotation_reader'));
    }

    /**
     * Gets the public 'fos_rest.routing.loader.controller' shared service.
     *
     * @return \FOS\RestBundle\Routing\Loader\RestRouteLoader
     */
    protected function getFosRest_Routing_Loader_ControllerService()
    {
        return $this->services['fos_rest.routing.loader.controller'] = new \FOS\RestBundle\Routing\Loader\RestRouteLoader($this, $this->get('file_locator'), $this->get('controller_name_converter'), $this->get('fos_rest.routing.loader.reader.controller'), NULL);
    }

    /**
     * Gets the public 'fos_rest.routing.loader.processor' shared service.
     *
     * @return \FOS\RestBundle\Routing\Loader\RestRouteProcessor
     */
    protected function getFosRest_Routing_Loader_ProcessorService()
    {
        return $this->services['fos_rest.routing.loader.processor'] = new \FOS\RestBundle\Routing\Loader\RestRouteProcessor();
    }

    /**
     * Gets the public 'fos_rest.routing.loader.reader.action' shared service.
     *
     * @return \FOS\RestBundle\Routing\Loader\Reader\RestActionReader
     */
    protected function getFosRest_Routing_Loader_Reader_ActionService()
    {
        return $this->services['fos_rest.routing.loader.reader.action'] = new \FOS\RestBundle\Routing\Loader\Reader\RestActionReader($this->get('annotation_reader'), $this->get('fos_rest.request.param_fetcher.reader'), $this->get('fos_rest.inflector.doctrine'), true, array('xml' => false, 'json' => false, 'html' => true));
    }

    /**
     * Gets the public 'fos_rest.routing.loader.reader.controller' shared service.
     *
     * @return \FOS\RestBundle\Routing\Loader\Reader\RestControllerReader
     */
    protected function getFosRest_Routing_Loader_Reader_ControllerService()
    {
        return $this->services['fos_rest.routing.loader.reader.controller'] = new \FOS\RestBundle\Routing\Loader\Reader\RestControllerReader($this->get('fos_rest.routing.loader.reader.action'), $this->get('annotation_reader'));
    }

    /**
     * Gets the public 'fos_rest.routing.loader.xml_collection' shared service.
     *
     * @return \FOS\RestBundle\Routing\Loader\RestXmlCollectionLoader
     */
    protected function getFosRest_Routing_Loader_XmlCollectionService()
    {
        return $this->services['fos_rest.routing.loader.xml_collection'] = new \FOS\RestBundle\Routing\Loader\RestXmlCollectionLoader($this->get('file_locator'), $this->get('fos_rest.routing.loader.processor'), true, array('xml' => false, 'json' => false, 'html' => true), NULL);
    }

    /**
     * Gets the public 'fos_rest.routing.loader.yaml_collection' shared service.
     *
     * @return \FOS\RestBundle\Routing\Loader\RestYamlCollectionLoader
     */
    protected function getFosRest_Routing_Loader_YamlCollectionService()
    {
        return $this->services['fos_rest.routing.loader.yaml_collection'] = new \FOS\RestBundle\Routing\Loader\RestYamlCollectionLoader($this->get('file_locator'), $this->get('fos_rest.routing.loader.processor'), true, array('xml' => false, 'json' => false, 'html' => true), NULL);
    }

    /**
     * Gets the public 'fos_rest.serializer' shared service.
     *
     * @return \FOS\RestBundle\Serializer\JMSSerializerAdapter
     */
    public function getFosRest_SerializerService($lazyLoad = true)
    {
        if ($lazyLoad) {
            $container = $this;

            return $this->services['fos_rest.serializer'] = new FOSRestBundleSerializerJMSSerializerAdapter_000000000bc63710000055ee6367fe948665dee8663b3ed20fa65d22263820c0(
                function (&$wrappedInstance, \ProxyManager\Proxy\LazyLoadingInterface $proxy) use ($container) {
                    $wrappedInstance = $container->getFosRest_SerializerService(false);

                    $proxy->setProxyInitializer(null);

                    return true;
                }
            );
        }

        return new \FOS\RestBundle\Serializer\JMSSerializerAdapter($this->get('jms_serializer'));
    }

    /**
     * Gets the public 'fos_rest.serializer.exception_wrapper_normalizer' shared service.
     *
     * @return \FOS\RestBundle\Serializer\ExceptionWrapperNormalizer
     */
    protected function getFosRest_Serializer_ExceptionWrapperNormalizerService()
    {
        return $this->services['fos_rest.serializer.exception_wrapper_normalizer'] = new \FOS\RestBundle\Serializer\ExceptionWrapperNormalizer($this->get('translator'));
    }

    /**
     * Gets the public 'fos_rest.serializer.exception_wrapper_serialize_handler' shared service.
     *
     * @return \FOS\RestBundle\Serializer\ExceptionWrapperSerializeHandler
     */
    protected function getFosRest_Serializer_ExceptionWrapperSerializeHandlerService()
    {
        return $this->services['fos_rest.serializer.exception_wrapper_serialize_handler'] = new \FOS\RestBundle\Serializer\ExceptionWrapperSerializeHandler();
    }

    /**
     * Gets the public 'fos_rest.view.exception_wrapper_handler' shared service.
     *
     * @return \FOS\RestBundle\View\ExceptionWrapperHandler
     */
    protected function getFosRest_View_ExceptionWrapperHandlerService()
    {
        return $this->services['fos_rest.view.exception_wrapper_handler'] = new \FOS\RestBundle\View\ExceptionWrapperHandler();
    }

    /**
     * Gets the public 'fos_rest.view_handler' shared service.
     *
     * @return \FOS\RestBundle\View\ViewHandler
     */
    protected function getFosRest_ViewHandlerService()
    {
        $this->services['fos_rest.view_handler'] = $instance = new \FOS\RestBundle\View\ViewHandler(array('xml' => false, 'json' => false, 'html' => true), 400, 204, false, array('html' => 302), 'twig');

        $instance->setExclusionStrategyGroups(array());
        $instance->setExclusionStrategyVersion('');
        $instance->setSerializeNullStrategy(false);
        $instance->setContainer($this);

        return $instance;
    }

    /**
     * Gets the public 'fos_rest.view_response_listener' shared service.
     *
     * @return \FOS\RestBundle\EventListener\ViewResponseListener
     */
    protected function getFosRest_ViewResponseListenerService()
    {
        return $this->services['fos_rest.view_response_listener'] = new \FOS\RestBundle\EventListener\ViewResponseListener($this);
    }

    /**
     * Gets the public 'fos_rest.violation_formatter' shared service.
     *
     * @return \FOS\RestBundle\Util\ViolationFormatter
     */
    protected function getFosRest_ViolationFormatterService()
    {
        return $this->services['fos_rest.violation_formatter'] = new \FOS\RestBundle\Util\ViolationFormatter(false);
    }

    /**
     * Gets the public 'fragment.handler' shared service.
     *
     * @return \Symfony\Component\HttpKernel\DependencyInjection\LazyLoadingFragmentHandler
     */
    protected function getFragment_HandlerService()
    {
        $this->services['fragment.handler'] = $instance = new \Symfony\Component\HttpKernel\DependencyInjection\LazyLoadingFragmentHandler($this, $this->get('request_stack'), true);

        $instance->addRendererService('inline', 'fragment.renderer.inline');
        $instance->addRendererService('hinclude', 'fragment.renderer.hinclude');
        $instance->addRendererService('hinclude', 'fragment.renderer.hinclude');

        return $instance;
    }

    /**
     * Gets the public 'fragment.listener' shared service.
     *
     * @return \Symfony\Component\HttpKernel\EventListener\FragmentListener
     */
    protected function getFragment_ListenerService()
    {
        return $this->services['fragment.listener'] = new \Symfony\Component\HttpKernel\EventListener\FragmentListener($this->get('uri_signer'), '/_fragment');
    }

    /**
     * Gets the public 'fragment.renderer.hinclude' shared service.
     *
     * @return \Symfony\Component\HttpKernel\Fragment\HIncludeFragmentRenderer
     */
    protected function getFragment_Renderer_HincludeService()
    {
        $this->services['fragment.renderer.hinclude'] = $instance = new \Symfony\Component\HttpKernel\Fragment\HIncludeFragmentRenderer($this->get('twig'), $this->get('uri_signer'), NULL);

        $instance->setFragmentPath('/_fragment');

        return $instance;
    }

    /**
     * Gets the public 'fragment.renderer.inline' shared service.
     *
     * @return \Symfony\Component\HttpKernel\Fragment\InlineFragmentRenderer
     */
    protected function getFragment_Renderer_InlineService()
    {
        $this->services['fragment.renderer.inline'] = $instance = new \Symfony\Component\HttpKernel\Fragment\InlineFragmentRenderer($this->get('http_kernel'), $this->get('debug.event_dispatcher'));

        $instance->setFragmentPath('/_fragment');

        return $instance;
    }

    /**
     * Gets the public 'http_kernel' shared service.
     *
     * @return \Symfony\Component\HttpKernel\DependencyInjection\ContainerAwareHttpKernel
     */
    protected function getHttpKernelService()
    {
        return $this->services['http_kernel'] = new \Symfony\Component\HttpKernel\DependencyInjection\ContainerAwareHttpKernel($this->get('debug.event_dispatcher'), $this, $this->get('debug.controller_resolver'), $this->get('request_stack'), false);
    }

    /**
     * Gets the public 'jms_serializer' shared service.
     *
     * @return \JMS\Serializer\Serializer
     */
    protected function getJmsSerializerService()
    {
        $a = new \JMS\Serializer\EventDispatcher\LazyEventDispatcher($this);
        $a->setListeners(array('serializer.pre_serialize' => array(0 => array(0 => array(0 => 'jms_serializer.stopwatch_subscriber', 1 => 'onPreSerialize'), 1 => NULL, 2 => NULL), 1 => array(0 => array(0 => 'jms_serializer.doctrine_proxy_subscriber', 1 => 'onPreSerializeTypedProxy'), 1 => NULL, 2 => NULL), 2 => array(0 => array(0 => 'jms_serializer.doctrine_proxy_subscriber', 1 => 'onPreSerialize'), 1 => NULL, 2 => NULL)), 'serializer.post_serialize' => array(0 => array(0 => array(0 => 'jms_serializer.stopwatch_subscriber', 1 => 'onPostSerialize'), 1 => NULL, 2 => NULL))));

        $this->services['jms_serializer'] = $instance = new \JMS\Serializer\Serializer($this->get('jms_serializer.metadata_factory'), $this->get('jms_serializer.handler_registry'), $this->get('jms_serializer.unserialize_object_constructor'), new \PhpCollection\Map(array('json' => $this->get('jms_serializer.json_serialization_visitor'), 'xml' => $this->get('jms_serializer.xml_serialization_visitor'), 'yml' => $this->get('jms_serializer.yaml_serialization_visitor'))), new \PhpCollection\Map(array('json' => $this->get('jms_serializer.json_deserialization_visitor'), 'xml' => $this->get('jms_serializer.xml_deserialization_visitor'))), $a, NULL, $this->get('jms_serializer.expression_evaluator'));

        $instance->setSerializationContextFactory($this->get('jms_serializer.serialization_context_factory'));
        $instance->setDeserializationContextFactory($this->get('jms_serializer.deserialization_context_factory'));

        return $instance;
    }

    /**
     * Gets the public 'jms_serializer.accessor_strategy' shared service.
     *
     * @return \JMS\Serializer\Accessor\ExpressionAccessorStrategy
     */
    protected function getJmsSerializer_AccessorStrategyService()
    {
        return $this->services['jms_serializer.accessor_strategy'] = new \JMS\Serializer\Accessor\ExpressionAccessorStrategy($this->get('jms_serializer.expression_evaluator'), new \JMS\Serializer\Accessor\DefaultAccessorStrategy());
    }

    /**
     * Gets the public 'jms_serializer.array_collection_handler' shared service.
     *
     * @return \JMS\Serializer\Handler\ArrayCollectionHandler
     */
    protected function getJmsSerializer_ArrayCollectionHandlerService()
    {
        return $this->services['jms_serializer.array_collection_handler'] = new \JMS\Serializer\Handler\ArrayCollectionHandler(true);
    }

    /**
     * Gets the public 'jms_serializer.constraint_violation_handler' shared service.
     *
     * @return \JMS\Serializer\Handler\ConstraintViolationHandler
     */
    protected function getJmsSerializer_ConstraintViolationHandlerService()
    {
        return $this->services['jms_serializer.constraint_violation_handler'] = new \JMS\Serializer\Handler\ConstraintViolationHandler();
    }

    /**
     * Gets the public 'jms_serializer.datetime_handler' shared service.
     *
     * @return \JMS\Serializer\Handler\DateHandler
     */
    protected function getJmsSerializer_DatetimeHandlerService()
    {
        return $this->services['jms_serializer.datetime_handler'] = new \JMS\Serializer\Handler\DateHandler('Y-m-d\\TH:i:sO', 'Europe/Amsterdam', true);
    }

    /**
     * Gets the public 'jms_serializer.deserialization_context_factory' shared service.
     *
     * @return \JMS\SerializerBundle\ContextFactory\ConfiguredContextFactory
     */
    protected function getJmsSerializer_DeserializationContextFactoryService()
    {
        return $this->services['jms_serializer.deserialization_context_factory'] = new \JMS\SerializerBundle\ContextFactory\ConfiguredContextFactory();
    }

    /**
     * Gets the public 'jms_serializer.doctrine_proxy_subscriber' shared service.
     *
     * @return \JMS\Serializer\EventDispatcher\Subscriber\DoctrineProxySubscriber
     */
    protected function getJmsSerializer_DoctrineProxySubscriberService()
    {
        return $this->services['jms_serializer.doctrine_proxy_subscriber'] = new \JMS\Serializer\EventDispatcher\Subscriber\DoctrineProxySubscriber(false, true);
    }

    /**
     * Gets the public 'jms_serializer.expression_evaluator' shared service.
     *
     * @return \JMS\Serializer\Expression\ExpressionEvaluator
     */
    protected function getJmsSerializer_ExpressionEvaluatorService()
    {
        $a = new \Symfony\Component\ExpressionLanguage\ExpressionLanguage();
        $a->registerProvider(new \JMS\SerializerBundle\ExpressionLanguage\BasicSerializerFunctionsProvider());

        return $this->services['jms_serializer.expression_evaluator'] = new \JMS\Serializer\Expression\ExpressionEvaluator($a, array('container' => $this));
    }

    /**
     * Gets the public 'jms_serializer.form_error_handler' shared service.
     *
     * @return \JMS\Serializer\Handler\FormErrorHandler
     */
    protected function getJmsSerializer_FormErrorHandlerService()
    {
        return $this->services['jms_serializer.form_error_handler'] = new \JMS\Serializer\Handler\FormErrorHandler($this->get('translator'));
    }

    /**
     * Gets the public 'jms_serializer.handler_registry' shared service.
     *
     * @return \JMS\Serializer\Handler\LazyHandlerRegistry
     */
    protected function getJmsSerializer_HandlerRegistryService()
    {
        return $this->services['jms_serializer.handler_registry'] = new \JMS\Serializer\Handler\LazyHandlerRegistry($this, array(1 => array('FOS\\RestBundle\\Util\\ExceptionWrapper' => array('json' => array(0 => 'fos_rest.serializer.exception_wrapper_serialize_handler', 1 => 'serializeToJson'), 'xml' => array(0 => 'fos_rest.serializer.exception_wrapper_serialize_handler', 1 => 'serializeToXml')), 'DateTime' => array('json' => array(0 => 'jms_serializer.datetime_handler', 1 => 'serializeDateTime'), 'xml' => array(0 => 'jms_serializer.datetime_handler', 1 => 'serializeDateTime'), 'yml' => array(0 => 'jms_serializer.datetime_handler', 1 => 'serializeDateTime')), 'DateTimeImmutable' => array('json' => array(0 => 'jms_serializer.datetime_handler', 1 => 'serializeDateTimeImmutable'), 'xml' => array(0 => 'jms_serializer.datetime_handler', 1 => 'serializeDateTimeImmutable'), 'yml' => array(0 => 'jms_serializer.datetime_handler', 1 => 'serializeDateTimeImmutable')), 'DateInterval' => array('json' => array(0 => 'jms_serializer.datetime_handler', 1 => 'serializeDateInterval'), 'xml' => array(0 => 'jms_serializer.datetime_handler', 1 => 'serializeDateInterval'), 'yml' => array(0 => 'jms_serializer.datetime_handler', 1 => 'serializeDateInterval')), 'ArrayCollection' => array('json' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'serializeCollection'), 'xml' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'serializeCollection'), 'yml' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'serializeCollection')), 'Doctrine\\Common\\Collections\\ArrayCollection' => array('json' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'serializeCollection'), 'xml' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'serializeCollection'), 'yml' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'serializeCollection')), 'Doctrine\\ORM\\PersistentCollection' => array('json' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'serializeCollection'), 'xml' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'serializeCollection'), 'yml' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'serializeCollection')), 'Doctrine\\ODM\\MongoDB\\PersistentCollection' => array('json' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'serializeCollection'), 'xml' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'serializeCollection'), 'yml' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'serializeCollection')), 'Doctrine\\ODM\\PHPCR\\PersistentCollection' => array('json' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'serializeCollection'), 'xml' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'serializeCollection'), 'yml' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'serializeCollection')), 'PhpCollection\\Sequence' => array('json' => array(0 => 'jms_serializer.php_collection_handler', 1 => 'serializeSequence'), 'xml' => array(0 => 'jms_serializer.php_collection_handler', 1 => 'serializeSequence'), 'yml' => array(0 => 'jms_serializer.php_collection_handler', 1 => 'serializeSequence')), 'PhpCollection\\Map' => array('json' => array(0 => 'jms_serializer.php_collection_handler', 1 => 'serializeMap'), 'xml' => array(0 => 'jms_serializer.php_collection_handler', 1 => 'serializeMap'), 'yml' => array(0 => 'jms_serializer.php_collection_handler', 1 => 'serializeMap')), 'Symfony\\Component\\Form\\Form' => array('xml' => array(0 => 'jms_serializer.form_error_handler', 1 => 'serializeFormToxml'), 'json' => array(0 => 'jms_serializer.form_error_handler', 1 => 'serializeFormTojson'), 'yml' => array(0 => 'jms_serializer.form_error_handler', 1 => 'serializeFormToyml')), 'Symfony\\Component\\Form\\FormError' => array('xml' => array(0 => 'jms_serializer.form_error_handler', 1 => 'serializeFormErrorToxml'), 'json' => array(0 => 'jms_serializer.form_error_handler', 1 => 'serializeFormErrorTojson'), 'yml' => array(0 => 'jms_serializer.form_error_handler', 1 => 'serializeFormErrorToyml')), 'Symfony\\Component\\Validator\\ConstraintViolationList' => array('xml' => array(0 => 'jms_serializer.constraint_violation_handler', 1 => 'serializeListToxml'), 'json' => array(0 => 'jms_serializer.constraint_violation_handler', 1 => 'serializeListTojson'), 'yml' => array(0 => 'jms_serializer.constraint_violation_handler', 1 => 'serializeListToyml')), 'Symfony\\Component\\Validator\\ConstraintViolation' => array('xml' => array(0 => 'jms_serializer.constraint_violation_handler', 1 => 'serializeViolationToxml'), 'json' => array(0 => 'jms_serializer.constraint_violation_handler', 1 => 'serializeViolationTojson'), 'yml' => array(0 => 'jms_serializer.constraint_violation_handler', 1 => 'serializeViolationToyml'))), 2 => array('DateTime' => array('json' => array(0 => 'jms_serializer.datetime_handler', 1 => 'deserializeDateTimeFromjson'), 'xml' => array(0 => 'jms_serializer.datetime_handler', 1 => 'deserializeDateTimeFromxml'), 'yml' => array(0 => 'jms_serializer.datetime_handler', 1 => 'deserializeDateTimeFromyml')), 'DateTimeImmutable' => array('json' => array(0 => 'jms_serializer.datetime_handler', 1 => 'deserializeDateTimeImmutableFromjson'), 'xml' => array(0 => 'jms_serializer.datetime_handler', 1 => 'deserializeDateTimeImmutableFromxml'), 'yml' => array(0 => 'jms_serializer.datetime_handler', 1 => 'deserializeDateTimeImmutableFromyml')), 'DateInterval' => array('json' => array(0 => 'jms_serializer.datetime_handler', 1 => 'deserializeDateIntervalFromjson'), 'xml' => array(0 => 'jms_serializer.datetime_handler', 1 => 'deserializeDateIntervalFromxml'), 'yml' => array(0 => 'jms_serializer.datetime_handler', 1 => 'deserializeDateIntervalFromyml')), 'ArrayCollection' => array('json' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'deserializeCollection'), 'xml' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'deserializeCollection'), 'yml' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'deserializeCollection')), 'Doctrine\\Common\\Collections\\ArrayCollection' => array('json' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'deserializeCollection'), 'xml' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'deserializeCollection'), 'yml' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'deserializeCollection')), 'Doctrine\\ORM\\PersistentCollection' => array('json' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'deserializeCollection'), 'xml' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'deserializeCollection'), 'yml' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'deserializeCollection')), 'Doctrine\\ODM\\MongoDB\\PersistentCollection' => array('json' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'deserializeCollection'), 'xml' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'deserializeCollection'), 'yml' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'deserializeCollection')), 'Doctrine\\ODM\\PHPCR\\PersistentCollection' => array('json' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'deserializeCollection'), 'xml' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'deserializeCollection'), 'yml' => array(0 => 'jms_serializer.array_collection_handler', 1 => 'deserializeCollection')), 'PhpCollection\\Sequence' => array('json' => array(0 => 'jms_serializer.php_collection_handler', 1 => 'deserializeSequence'), 'xml' => array(0 => 'jms_serializer.php_collection_handler', 1 => 'deserializeSequence'), 'yml' => array(0 => 'jms_serializer.php_collection_handler', 1 => 'deserializeSequence')), 'PhpCollection\\Map' => array('json' => array(0 => 'jms_serializer.php_collection_handler', 1 => 'deserializeMap'), 'xml' => array(0 => 'jms_serializer.php_collection_handler', 1 => 'deserializeMap'), 'yml' => array(0 => 'jms_serializer.php_collection_handler', 1 => 'deserializeMap')))));
    }

    /**
     * Gets the public 'jms_serializer.json_deserialization_visitor' shared service.
     *
     * @return \JMS\Serializer\JsonDeserializationVisitor
     */
    protected function getJmsSerializer_JsonDeserializationVisitorService()
    {
        return $this->services['jms_serializer.json_deserialization_visitor'] = new \JMS\Serializer\JsonDeserializationVisitor($this->get('jms_serializer.naming_strategy'));
    }

    /**
     * Gets the public 'jms_serializer.json_serialization_visitor' shared service.
     *
     * @return \JMS\Serializer\JsonSerializationVisitor
     */
    protected function getJmsSerializer_JsonSerializationVisitorService()
    {
        $this->services['jms_serializer.json_serialization_visitor'] = $instance = new \JMS\Serializer\JsonSerializationVisitor($this->get('jms_serializer.naming_strategy'), $this->get('jms_serializer.accessor_strategy'));

        $instance->setOptions(0);

        return $instance;
    }

    /**
     * Gets the public 'jms_serializer.metadata_driver' shared service.
     *
     * @return \JMS\Serializer\Metadata\Driver\DoctrineTypeDriver
     */
    protected function getJmsSerializer_MetadataDriverService()
    {
        $a = new \Metadata\Driver\FileLocator(array('Symfony\\Bundle\\FrameworkBundle' => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Bundle/FrameworkBundle/Resources/config/serializer'), 'Symfony\\Bundle\\SecurityBundle' => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Bundle/SecurityBundle/Resources/config/serializer'), 'Symfony\\Bundle\\TwigBundle' => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Bundle/TwigBundle/Resources/config/serializer'), 'Symfony\\Bundle\\MonologBundle' => ($this->targetDirs[3].'/vendor/symfony/monolog-bundle/Resources/config/serializer'), 'Symfony\\Bundle\\SwiftmailerBundle' => ($this->targetDirs[3].'/vendor/symfony/swiftmailer-bundle/Resources/config/serializer'), 'Doctrine\\Bundle\\DoctrineBundle' => ($this->targetDirs[3].'/vendor/doctrine/doctrine-bundle/Resources/config/serializer'), 'Sensio\\Bundle\\FrameworkExtraBundle' => ($this->targetDirs[3].'/vendor/sensio/framework-extra-bundle/Resources/config/serializer'), 'Sch\\MainBundle' => ($this->targetDirs[3].'/src/Sch/MainBundle/Resources/config/serializer'), 'Doctrine\\Bundle\\MigrationsBundle' => ($this->targetDirs[3].'/vendor/doctrine/doctrine-migrations-bundle/Resources/config/serializer'), 'FOS\\RestBundle' => ($this->targetDirs[3].'/vendor/friendsofsymfony/rest-bundle/FOS/RestBundle/Resources/config/serializer'), 'Nelmio\\ApiDocBundle' => ($this->targetDirs[3].'/vendor/nelmio/api-doc-bundle/Nelmio/ApiDocBundle/Resources/config/serializer'), 'JMS\\SerializerBundle' => ($this->targetDirs[3].'/vendor/jms/serializer-bundle/JMS/SerializerBundle/Resources/config/serializer'), 'Sonata\\CoreBundle' => ($this->targetDirs[3].'/vendor/sonata-project/core-bundle/src/Resources/config/serializer'), 'Sonata\\BlockBundle' => ($this->targetDirs[3].'/vendor/sonata-project/block-bundle/src/Resources/config/serializer'), 'Knp\\Bundle\\MenuBundle' => ($this->targetDirs[3].'/vendor/knplabs/knp-menu-bundle/src/Resources/config/serializer'), 'Sonata\\DoctrineORMAdminBundle' => ($this->targetDirs[3].'/vendor/sonata-project/doctrine-orm-admin-bundle/src/Resources/config/serializer'), 'Sonata\\AdminBundle' => ($this->targetDirs[3].'/vendor/sonata-project/admin-bundle/src/Resources/config/serializer'), 'Symfony\\Bundle\\DebugBundle' => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Bundle/DebugBundle/Resources/config/serializer'), 'Symfony\\Bundle\\WebProfilerBundle' => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Bundle/WebProfilerBundle/Resources/config/serializer'), 'Sensio\\Bundle\\DistributionBundle' => ($this->targetDirs[3].'/vendor/sensio/distribution-bundle/Sensio/Bundle/DistributionBundle/Resources/config/serializer'), 'Sensio\\Bundle\\GeneratorBundle' => ($this->targetDirs[3].'/vendor/sensio/generator-bundle/Resources/config/serializer')));

        return $this->services['jms_serializer.metadata_driver'] = new \JMS\Serializer\Metadata\Driver\DoctrineTypeDriver(new \Metadata\Driver\DriverChain(array(0 => new \JMS\Serializer\Metadata\Driver\YamlDriver($a), 1 => new \JMS\Serializer\Metadata\Driver\XmlDriver($a), 2 => new \JMS\Serializer\Metadata\Driver\PhpDriver($a), 3 => new \JMS\Serializer\Metadata\Driver\AnnotationDriver($this->get('annotation_reader')))), $this->get('doctrine'));
    }

    /**
     * Gets the public 'jms_serializer.naming_strategy' shared service.
     *
     * @return \JMS\Serializer\Naming\CacheNamingStrategy
     */
    protected function getJmsSerializer_NamingStrategyService()
    {
        return $this->services['jms_serializer.naming_strategy'] = new \JMS\Serializer\Naming\CacheNamingStrategy(new \JMS\Serializer\Naming\SerializedNameAnnotationStrategy(new \JMS\Serializer\Naming\CamelCaseNamingStrategy('_', true)));
    }

    /**
     * Gets the public 'jms_serializer.object_constructor' shared service.
     *
     * @return \JMS\Serializer\Construction\DoctrineObjectConstructor
     */
    protected function getJmsSerializer_ObjectConstructorService()
    {
        return $this->services['jms_serializer.object_constructor'] = new \JMS\Serializer\Construction\DoctrineObjectConstructor($this->get('doctrine'), $this->get('jms_serializer.unserialize_object_constructor'), 'null');
    }

    /**
     * Gets the public 'jms_serializer.php_collection_handler' shared service.
     *
     * @return \JMS\Serializer\Handler\PhpCollectionHandler
     */
    protected function getJmsSerializer_PhpCollectionHandlerService()
    {
        return $this->services['jms_serializer.php_collection_handler'] = new \JMS\Serializer\Handler\PhpCollectionHandler();
    }

    /**
     * Gets the public 'jms_serializer.serialization_context_factory' shared service.
     *
     * @return \JMS\SerializerBundle\ContextFactory\ConfiguredContextFactory
     */
    protected function getJmsSerializer_SerializationContextFactoryService()
    {
        return $this->services['jms_serializer.serialization_context_factory'] = new \JMS\SerializerBundle\ContextFactory\ConfiguredContextFactory();
    }

    /**
     * Gets the public 'jms_serializer.stopwatch_subscriber' shared service.
     *
     * @return \JMS\SerializerBundle\Serializer\StopwatchEventSubscriber
     */
    protected function getJmsSerializer_StopwatchSubscriberService()
    {
        return $this->services['jms_serializer.stopwatch_subscriber'] = new \JMS\SerializerBundle\Serializer\StopwatchEventSubscriber($this->get('debug.stopwatch'));
    }

    /**
     * Gets the public 'jms_serializer.templating.helper.serializer' shared service.
     *
     * @return \JMS\SerializerBundle\Templating\SerializerHelper
     */
    protected function getJmsSerializer_Templating_Helper_SerializerService()
    {
        return $this->services['jms_serializer.templating.helper.serializer'] = new \JMS\SerializerBundle\Templating\SerializerHelper($this->get('jms_serializer'));
    }

    /**
     * Gets the public 'jms_serializer.xml_deserialization_visitor' shared service.
     *
     * @return \JMS\Serializer\XmlDeserializationVisitor
     */
    protected function getJmsSerializer_XmlDeserializationVisitorService()
    {
        $this->services['jms_serializer.xml_deserialization_visitor'] = $instance = new \JMS\Serializer\XmlDeserializationVisitor($this->get('jms_serializer.naming_strategy'));

        $instance->setDoctypeWhitelist(array());

        return $instance;
    }

    /**
     * Gets the public 'jms_serializer.xml_serialization_visitor' shared service.
     *
     * @return \JMS\Serializer\XmlSerializationVisitor
     */
    protected function getJmsSerializer_XmlSerializationVisitorService()
    {
        $this->services['jms_serializer.xml_serialization_visitor'] = $instance = new \JMS\Serializer\XmlSerializationVisitor($this->get('jms_serializer.naming_strategy'), $this->get('jms_serializer.accessor_strategy'));

        $instance->setFormatOutput(true);

        return $instance;
    }

    /**
     * Gets the public 'jms_serializer.yaml_serialization_visitor' shared service.
     *
     * @return \JMS\Serializer\YamlSerializationVisitor
     */
    protected function getJmsSerializer_YamlSerializationVisitorService()
    {
        return $this->services['jms_serializer.yaml_serialization_visitor'] = new \JMS\Serializer\YamlSerializationVisitor($this->get('jms_serializer.naming_strategy'), $this->get('jms_serializer.accessor_strategy'));
    }

    /**
     * Gets the public 'kernel' shared service.
     *
     * @throws RuntimeException always since this service is expected to be injected dynamically
     */
    protected function getKernelService()
    {
        throw new RuntimeException('You have requested a synthetic service ("kernel"). The DIC does not know how to construct this service.');
    }

    /**
     * Gets the public 'kernel.class_cache.cache_warmer' shared service.
     *
     * @return \Symfony\Bundle\FrameworkBundle\CacheWarmer\ClassCacheCacheWarmer
     */
    protected function getKernel_ClassCache_CacheWarmerService()
    {
        return $this->services['kernel.class_cache.cache_warmer'] = new \Symfony\Bundle\FrameworkBundle\CacheWarmer\ClassCacheCacheWarmer();
    }

    /**
     * Gets the public 'knp_menu.factory' shared service.
     *
     * @return \Knp\Menu\MenuFactory
     */
    protected function getKnpMenu_FactoryService()
    {
        $this->services['knp_menu.factory'] = $instance = new \Knp\Menu\MenuFactory();

        $instance->addExtension(new \Knp\Menu\Integration\Symfony\RoutingExtension($this->get('router')), 0);

        return $instance;
    }

    /**
     * Gets the public 'knp_menu.matcher' shared service.
     *
     * @return \Knp\Menu\Matcher\Matcher
     */
    protected function getKnpMenu_MatcherService()
    {
        return $this->services['knp_menu.matcher'] = new \Knp\Menu\Matcher\Matcher(array(0 => $this->get('knp_menu.voter.router'), 1 => $this->get('sonata.admin.menu.matcher.voter.admin'), 2 => $this->get('sonata.admin.menu.matcher.voter.active')));
    }

    /**
     * Gets the public 'knp_menu.menu_provider' shared service.
     *
     * @return \Knp\Menu\Provider\ChainProvider
     */
    protected function getKnpMenu_MenuProviderService()
    {
        $a = $this->get('knp_menu.factory');

        return $this->services['knp_menu.menu_provider'] = new \Knp\Menu\Provider\ChainProvider(array(0 => new \Knp\Bundle\MenuBundle\Provider\ContainerAwareProvider($this, array('sonata_admin_sidebar' => 'sonata.admin.sidebar_menu')), 1 => new \Knp\Bundle\MenuBundle\Provider\BuilderServiceProvider($this, array()), 2 => new \Knp\Bundle\MenuBundle\Provider\BuilderAliasProvider($this->get('kernel'), $this, $a), 3 => new \Sonata\AdminBundle\Menu\Provider\GroupMenuProvider($a, $this->get('sonata.admin.pool'), $this->get('security.authorization_checker'))));
    }

    /**
     * Gets the public 'knp_menu.renderer.list' shared service.
     *
     * @return \Knp\Menu\Renderer\ListRenderer
     */
    protected function getKnpMenu_Renderer_ListService()
    {
        return $this->services['knp_menu.renderer.list'] = new \Knp\Menu\Renderer\ListRenderer($this->get('knp_menu.matcher'), array(), 'UTF-8');
    }

    /**
     * Gets the public 'knp_menu.renderer.twig' shared service.
     *
     * @return \Knp\Menu\Renderer\TwigRenderer
     */
    protected function getKnpMenu_Renderer_TwigService()
    {
        return $this->services['knp_menu.renderer.twig'] = new \Knp\Menu\Renderer\TwigRenderer($this->get('twig'), '@KnpMenu/menu.html.twig', $this->get('knp_menu.matcher'), array());
    }

    /**
     * Gets the public 'knp_menu.renderer_provider' shared service.
     *
     * @return \Knp\Bundle\MenuBundle\Renderer\ContainerAwareProvider
     */
    protected function getKnpMenu_RendererProviderService()
    {
        return $this->services['knp_menu.renderer_provider'] = new \Knp\Bundle\MenuBundle\Renderer\ContainerAwareProvider($this, 'twig', array('list' => 'knp_menu.renderer.list', 'twig' => 'knp_menu.renderer.twig'), false);
    }

    /**
     * Gets the public 'knp_menu.voter.router' shared service.
     *
     * @return \Knp\Menu\Matcher\Voter\RouteVoter
     */
    protected function getKnpMenu_Voter_RouterService()
    {
        return $this->services['knp_menu.voter.router'] = new \Knp\Menu\Matcher\Voter\RouteVoter($this->get('request_stack'));
    }

    /**
     * Gets the public 'locale_listener' shared service.
     *
     * @return \Symfony\Component\HttpKernel\EventListener\LocaleListener
     */
    protected function getLocaleListenerService()
    {
        return $this->services['locale_listener'] = new \Symfony\Component\HttpKernel\EventListener\LocaleListener($this->get('request_stack'), 'fi', $this->get('router', ContainerInterface::NULL_ON_INVALID_REFERENCE));
    }

    /**
     * Gets the public 'logger' shared service.
     *
     * @return \Symfony\Bridge\Monolog\Logger
     */
    protected function getLoggerService()
    {
        $this->services['logger'] = $instance = new \Symfony\Bridge\Monolog\Logger('app');

        $instance->useMicrosecondTimestamps(true);
        $instance->pushHandler($this->get('monolog.handler.console'));
        $instance->pushHandler($this->get('monolog.handler.main'));
        $instance->pushHandler($this->get('monolog.handler.debug'));

        return $instance;
    }

    /**
     * Gets the public 'main.admin.blog_post' service.
     *
     * @return \Sch\MainBundle\Admin\BlogPostAdmin
     */
    protected function getMain_Admin_BlogPostService()
    {
        $instance = new \Sch\MainBundle\Admin\BlogPostAdmin('main.admin.blog_post', 'Sch\\MainBundle\\Entity\\BlogPost', 'SonataAdminBundle:CRUD');

        $instance->setTranslationDomain('Sch:MainBundle');
        $instance->setFormTheme(array(0 => '@SonataDoctrineORMAdmin/Form/form_admin_fields.html.twig'));
        $instance->setFilterTheme(array(0 => '@SonataDoctrineORMAdmin/Form/filter_admin_fields.html.twig'));
        $instance->setManagerType('orm');
        $instance->setModelManager($this->get('sonata.admin.manager.orm'));
        $instance->setFormContractor($this->get('sonata.admin.builder.orm_form'));
        $instance->setShowBuilder($this->get('sonata.admin.builder.orm_show'));
        $instance->setListBuilder($this->get('sonata.admin.builder.orm_list'));
        $instance->setDatagridBuilder($this->get('sonata.admin.builder.orm_datagrid'));
        $instance->setTranslator($this->get('translator'), false);
        $instance->setConfigurationPool($this->get('sonata.admin.pool'));
        $instance->setRouteGenerator($this->get('sonata.admin.route.default_generator'));
        $instance->setValidator($this->get('validator'));
        $instance->setSecurityHandler($this->get('sonata.admin.security.handler'));
        $instance->setMenuFactory($this->get('knp_menu.factory'));
        $instance->setRouteBuilder($this->get('sonata.admin.route.path_info'));
        $instance->setLabelTranslatorStrategy($this->get('sonata.admin.label.strategy.native'));
        $instance->setPagerType('default');
        $instance->setLabel('Blog Post');
        $instance->showMosaicButton(true);
        $instance->setTemplateRegistry($this->get('main.admin.blog_post.template_registry'));
        $instance->setSecurityInformation(array());
        $instance->initialize();
        $instance->addExtension($this->get('sonata.admin.event.extension'));

        return $instance;
    }

    /**
     * Gets the public 'main.admin.blog_post.template_registry' shared service.
     *
     * @return \Sonata\AdminBundle\Templating\TemplateRegistry
     */
    protected function getMain_Admin_BlogPost_TemplateRegistryService()
    {
        return $this->services['main.admin.blog_post.template_registry'] = new \Sonata\AdminBundle\Templating\TemplateRegistry(array('user_block' => '@SonataAdmin/Core/user_block.html.twig', 'add_block' => '@SonataAdmin/Core/add_block.html.twig', 'layout' => '@SonataAdmin/standard_layout.html.twig', 'ajax' => '@SonataAdmin/ajax_layout.html.twig', 'dashboard' => '@SonataAdmin/Core/dashboard.html.twig', 'search' => '@SonataAdmin/Core/search.html.twig', 'list' => '@SonataAdmin/CRUD/list.html.twig', 'filter' => '@SonataAdmin/Form/filter_admin_fields.html.twig', 'show' => '@SonataAdmin/CRUD/show.html.twig', 'show_compare' => '@SonataAdmin/CRUD/show_compare.html.twig', 'edit' => '@SonataAdmin/CRUD/edit.html.twig', 'preview' => '@SonataAdmin/CRUD/preview.html.twig', 'history' => '@SonataAdmin/CRUD/history.html.twig', 'acl' => '@SonataAdmin/CRUD/acl.html.twig', 'history_revision_timestamp' => '@SonataAdmin/CRUD/history_revision_timestamp.html.twig', 'action' => '@SonataAdmin/CRUD/action.html.twig', 'select' => '@SonataAdmin/CRUD/list__select.html.twig', 'list_block' => '@SonataAdmin/Block/block_admin_list.html.twig', 'search_result_block' => '@SonataAdmin/Block/block_search_result.html.twig', 'short_object_description' => '@SonataAdmin/Helper/short-object-description.html.twig', 'delete' => '@SonataAdmin/CRUD/delete.html.twig', 'batch' => '@SonataAdmin/CRUD/list__batch.html.twig', 'batch_confirmation' => '@SonataAdmin/CRUD/batch_confirmation.html.twig', 'inner_list_row' => '@SonataAdmin/CRUD/list_inner_row.html.twig', 'outer_list_rows_mosaic' => '@SonataAdmin/CRUD/list_outer_rows_mosaic.html.twig', 'outer_list_rows_list' => '@SonataAdmin/CRUD/list_outer_rows_list.html.twig', 'outer_list_rows_tree' => '@SonataAdmin/CRUD/list_outer_rows_tree.html.twig', 'base_list_field' => '@SonataAdmin/CRUD/base_list_field.html.twig', 'pager_links' => '@SonataAdmin/Pager/links.html.twig', 'pager_results' => '@SonataAdmin/Pager/results.html.twig', 'tab_menu_template' => '@SonataAdmin/Core/tab_menu_template.html.twig', 'knp_menu_template' => '@SonataAdmin/Menu/sonata_menu.html.twig', 'action_create' => '@SonataAdmin/CRUD/dashboard__action_create.html.twig', 'button_acl' => '@SonataAdmin/Button/acl_button.html.twig', 'button_create' => '@SonataAdmin/Button/create_button.html.twig', 'button_edit' => '@SonataAdmin/Button/edit_button.html.twig', 'button_history' => '@SonataAdmin/Button/history_button.html.twig', 'button_list' => '@SonataAdmin/Button/list_button.html.twig', 'button_show' => '@SonataAdmin/Button/show_button.html.twig'));
    }

    /**
     * Gets the public 'main.admin.category' service.
     *
     * @return \Sch\MainBundle\Admin\CategoryAdmin
     */
    protected function getMain_Admin_CategoryService()
    {
        $instance = new \Sch\MainBundle\Admin\CategoryAdmin('main.admin.category', 'Sch\\MainBundle\\Entity\\Category', 'SonataAdminBundle:CRUD');

        $instance->setFormTheme(array(0 => '@SonataDoctrineORMAdmin/Form/form_admin_fields.html.twig'));
        $instance->setFilterTheme(array(0 => '@SonataDoctrineORMAdmin/Form/filter_admin_fields.html.twig'));
        $instance->setManagerType('orm');
        $instance->setModelManager($this->get('sonata.admin.manager.orm'));
        $instance->setFormContractor($this->get('sonata.admin.builder.orm_form'));
        $instance->setShowBuilder($this->get('sonata.admin.builder.orm_show'));
        $instance->setListBuilder($this->get('sonata.admin.builder.orm_list'));
        $instance->setDatagridBuilder($this->get('sonata.admin.builder.orm_datagrid'));
        $instance->setTranslator($this->get('translator'), false);
        $instance->setConfigurationPool($this->get('sonata.admin.pool'));
        $instance->setRouteGenerator($this->get('sonata.admin.route.default_generator'));
        $instance->setValidator($this->get('validator'));
        $instance->setSecurityHandler($this->get('sonata.admin.security.handler'));
        $instance->setMenuFactory($this->get('knp_menu.factory'));
        $instance->setRouteBuilder($this->get('sonata.admin.route.path_info'));
        $instance->setLabelTranslatorStrategy($this->get('sonata.admin.label.strategy.native'));
        $instance->setPagerType('default');
        $instance->setLabel('Category');
        $instance->showMosaicButton(true);
        $instance->setTemplateRegistry($this->get('main.admin.category.template_registry'));
        $instance->setSecurityInformation(array());
        $instance->initialize();
        $instance->addExtension($this->get('sonata.admin.event.extension'));

        return $instance;
    }

    /**
     * Gets the public 'main.admin.category.template_registry' shared service.
     *
     * @return \Sonata\AdminBundle\Templating\TemplateRegistry
     */
    protected function getMain_Admin_Category_TemplateRegistryService()
    {
        return $this->services['main.admin.category.template_registry'] = new \Sonata\AdminBundle\Templating\TemplateRegistry(array('user_block' => '@SonataAdmin/Core/user_block.html.twig', 'add_block' => '@SonataAdmin/Core/add_block.html.twig', 'layout' => '@SonataAdmin/standard_layout.html.twig', 'ajax' => '@SonataAdmin/ajax_layout.html.twig', 'dashboard' => '@SonataAdmin/Core/dashboard.html.twig', 'search' => '@SonataAdmin/Core/search.html.twig', 'list' => '@SonataAdmin/CRUD/list.html.twig', 'filter' => '@SonataAdmin/Form/filter_admin_fields.html.twig', 'show' => '@SonataAdmin/CRUD/show.html.twig', 'show_compare' => '@SonataAdmin/CRUD/show_compare.html.twig', 'edit' => '@SonataAdmin/CRUD/edit.html.twig', 'preview' => '@SonataAdmin/CRUD/preview.html.twig', 'history' => '@SonataAdmin/CRUD/history.html.twig', 'acl' => '@SonataAdmin/CRUD/acl.html.twig', 'history_revision_timestamp' => '@SonataAdmin/CRUD/history_revision_timestamp.html.twig', 'action' => '@SonataAdmin/CRUD/action.html.twig', 'select' => '@SonataAdmin/CRUD/list__select.html.twig', 'list_block' => '@SonataAdmin/Block/block_admin_list.html.twig', 'search_result_block' => '@SonataAdmin/Block/block_search_result.html.twig', 'short_object_description' => '@SonataAdmin/Helper/short-object-description.html.twig', 'delete' => '@SonataAdmin/CRUD/delete.html.twig', 'batch' => '@SonataAdmin/CRUD/list__batch.html.twig', 'batch_confirmation' => '@SonataAdmin/CRUD/batch_confirmation.html.twig', 'inner_list_row' => '@SonataAdmin/CRUD/list_inner_row.html.twig', 'outer_list_rows_mosaic' => '@SonataAdmin/CRUD/list_outer_rows_mosaic.html.twig', 'outer_list_rows_list' => '@SonataAdmin/CRUD/list_outer_rows_list.html.twig', 'outer_list_rows_tree' => '@SonataAdmin/CRUD/list_outer_rows_tree.html.twig', 'base_list_field' => '@SonataAdmin/CRUD/base_list_field.html.twig', 'pager_links' => '@SonataAdmin/Pager/links.html.twig', 'pager_results' => '@SonataAdmin/Pager/results.html.twig', 'tab_menu_template' => '@SonataAdmin/Core/tab_menu_template.html.twig', 'knp_menu_template' => '@SonataAdmin/Menu/sonata_menu.html.twig', 'action_create' => '@SonataAdmin/CRUD/dashboard__action_create.html.twig', 'button_acl' => '@SonataAdmin/Button/acl_button.html.twig', 'button_create' => '@SonataAdmin/Button/create_button.html.twig', 'button_edit' => '@SonataAdmin/Button/edit_button.html.twig', 'button_history' => '@SonataAdmin/Button/history_button.html.twig', 'button_list' => '@SonataAdmin/Button/list_button.html.twig', 'button_show' => '@SonataAdmin/Button/show_button.html.twig'));
    }

    /**
     * Gets the public 'main.admin.test' service.
     *
     * @return \Sch\MainBundle\Admin\TestAdmin
     */
    protected function getMain_Admin_TestService()
    {
        $instance = new \Sch\MainBundle\Admin\TestAdmin('main.admin.test', '\\Sch\\MainBundle\\Entity\\Test', 'SonataAdminBundle:CRUD');

        $instance->setFormTheme(array(0 => '@SonataDoctrineORMAdmin/Form/form_admin_fields.html.twig'));
        $instance->setFilterTheme(array(0 => '@SonataDoctrineORMAdmin/Form/filter_admin_fields.html.twig'));
        $instance->setManagerType('orm');
        $instance->setModelManager($this->get('sonata.admin.manager.orm'));
        $instance->setFormContractor($this->get('sonata.admin.builder.orm_form'));
        $instance->setShowBuilder($this->get('sonata.admin.builder.orm_show'));
        $instance->setListBuilder($this->get('sonata.admin.builder.orm_list'));
        $instance->setDatagridBuilder($this->get('sonata.admin.builder.orm_datagrid'));
        $instance->setTranslator($this->get('translator'), false);
        $instance->setConfigurationPool($this->get('sonata.admin.pool'));
        $instance->setRouteGenerator($this->get('sonata.admin.route.default_generator'));
        $instance->setValidator($this->get('validator'));
        $instance->setSecurityHandler($this->get('sonata.admin.security.handler'));
        $instance->setMenuFactory($this->get('knp_menu.factory'));
        $instance->setRouteBuilder($this->get('sonata.admin.route.path_info'));
        $instance->setLabelTranslatorStrategy($this->get('sonata.admin.label.strategy.native'));
        $instance->setPagerType('default');
        $instance->setLabel('Test');
        $instance->showMosaicButton(true);
        $instance->setTemplateRegistry($this->get('main.admin.test.template_registry'));
        $instance->setSecurityInformation(array());
        $instance->initialize();
        $instance->addExtension($this->get('sonata.admin.event.extension'));

        return $instance;
    }

    /**
     * Gets the public 'main.admin.test.template_registry' shared service.
     *
     * @return \Sonata\AdminBundle\Templating\TemplateRegistry
     */
    protected function getMain_Admin_Test_TemplateRegistryService()
    {
        return $this->services['main.admin.test.template_registry'] = new \Sonata\AdminBundle\Templating\TemplateRegistry(array('user_block' => '@SonataAdmin/Core/user_block.html.twig', 'add_block' => '@SonataAdmin/Core/add_block.html.twig', 'layout' => '@SonataAdmin/standard_layout.html.twig', 'ajax' => '@SonataAdmin/ajax_layout.html.twig', 'dashboard' => '@SonataAdmin/Core/dashboard.html.twig', 'search' => '@SonataAdmin/Core/search.html.twig', 'list' => '@SonataAdmin/CRUD/list.html.twig', 'filter' => '@SonataAdmin/Form/filter_admin_fields.html.twig', 'show' => '@SonataAdmin/CRUD/show.html.twig', 'show_compare' => '@SonataAdmin/CRUD/show_compare.html.twig', 'edit' => '@SonataAdmin/CRUD/edit.html.twig', 'preview' => '@SonataAdmin/CRUD/preview.html.twig', 'history' => '@SonataAdmin/CRUD/history.html.twig', 'acl' => '@SonataAdmin/CRUD/acl.html.twig', 'history_revision_timestamp' => '@SonataAdmin/CRUD/history_revision_timestamp.html.twig', 'action' => '@SonataAdmin/CRUD/action.html.twig', 'select' => '@SonataAdmin/CRUD/list__select.html.twig', 'list_block' => '@SonataAdmin/Block/block_admin_list.html.twig', 'search_result_block' => '@SonataAdmin/Block/block_search_result.html.twig', 'short_object_description' => '@SonataAdmin/Helper/short-object-description.html.twig', 'delete' => '@SonataAdmin/CRUD/delete.html.twig', 'batch' => '@SonataAdmin/CRUD/list__batch.html.twig', 'batch_confirmation' => '@SonataAdmin/CRUD/batch_confirmation.html.twig', 'inner_list_row' => '@SonataAdmin/CRUD/list_inner_row.html.twig', 'outer_list_rows_mosaic' => '@SonataAdmin/CRUD/list_outer_rows_mosaic.html.twig', 'outer_list_rows_list' => '@SonataAdmin/CRUD/list_outer_rows_list.html.twig', 'outer_list_rows_tree' => '@SonataAdmin/CRUD/list_outer_rows_tree.html.twig', 'base_list_field' => '@SonataAdmin/CRUD/base_list_field.html.twig', 'pager_links' => '@SonataAdmin/Pager/links.html.twig', 'pager_results' => '@SonataAdmin/Pager/results.html.twig', 'tab_menu_template' => '@SonataAdmin/Core/tab_menu_template.html.twig', 'knp_menu_template' => '@SonataAdmin/Menu/sonata_menu.html.twig', 'action_create' => '@SonataAdmin/CRUD/dashboard__action_create.html.twig', 'button_acl' => '@SonataAdmin/Button/acl_button.html.twig', 'button_create' => '@SonataAdmin/Button/create_button.html.twig', 'button_edit' => '@SonataAdmin/Button/edit_button.html.twig', 'button_history' => '@SonataAdmin/Button/history_button.html.twig', 'button_list' => '@SonataAdmin/Button/list_button.html.twig', 'button_show' => '@SonataAdmin/Button/show_button.html.twig'));
    }

    /**
     * Gets the public 'monolog.handler.console' shared service.
     *
     * @return \Symfony\Bridge\Monolog\Handler\ConsoleHandler
     */
    protected function getMonolog_Handler_ConsoleService()
    {
        $this->services['monolog.handler.console'] = $instance = new \Symfony\Bridge\Monolog\Handler\ConsoleHandler(NULL, true, array());

        $instance->pushProcessor($this->get('monolog.processor.psr_log_message'));

        return $instance;
    }

    /**
     * Gets the public 'monolog.handler.debug' shared service.
     *
     * @return \Symfony\Bridge\Monolog\Handler\DebugHandler
     */
    protected function getMonolog_Handler_DebugService()
    {
        return $this->services['monolog.handler.debug'] = new \Symfony\Bridge\Monolog\Handler\DebugHandler(100, true);
    }

    /**
     * Gets the public 'monolog.handler.main' shared service.
     *
     * @return \Monolog\Handler\StreamHandler
     */
    protected function getMonolog_Handler_MainService()
    {
        $this->services['monolog.handler.main'] = $instance = new \Monolog\Handler\StreamHandler(($this->targetDirs[2].'/logs/dev.log'), 100, true, NULL);

        $instance->pushProcessor($this->get('monolog.processor.psr_log_message'));

        return $instance;
    }

    /**
     * Gets the public 'monolog.handler.null_internal' shared service.
     *
     * @return \Monolog\Handler\NullHandler
     */
    protected function getMonolog_Handler_NullInternalService()
    {
        return $this->services['monolog.handler.null_internal'] = new \Monolog\Handler\NullHandler();
    }

    /**
     * Gets the public 'monolog.logger.doctrine' shared service.
     *
     * @return \Symfony\Bridge\Monolog\Logger
     */
    protected function getMonolog_Logger_DoctrineService()
    {
        $this->services['monolog.logger.doctrine'] = $instance = new \Symfony\Bridge\Monolog\Logger('doctrine');

        $instance->pushHandler($this->get('monolog.handler.main'));
        $instance->pushHandler($this->get('monolog.handler.debug'));

        return $instance;
    }

    /**
     * Gets the public 'monolog.logger.event' shared service.
     *
     * @return \Symfony\Bridge\Monolog\Logger
     */
    protected function getMonolog_Logger_EventService()
    {
        $this->services['monolog.logger.event'] = $instance = new \Symfony\Bridge\Monolog\Logger('event');

        $instance->pushHandler($this->get('monolog.handler.debug'));

        return $instance;
    }

    /**
     * Gets the public 'monolog.logger.php' shared service.
     *
     * @return \Symfony\Bridge\Monolog\Logger
     */
    protected function getMonolog_Logger_PhpService()
    {
        $this->services['monolog.logger.php'] = $instance = new \Symfony\Bridge\Monolog\Logger('php');

        $instance->pushHandler($this->get('monolog.handler.console'));
        $instance->pushHandler($this->get('monolog.handler.main'));
        $instance->pushHandler($this->get('monolog.handler.debug'));

        return $instance;
    }

    /**
     * Gets the public 'monolog.logger.profiler' shared service.
     *
     * @return \Symfony\Bridge\Monolog\Logger
     */
    protected function getMonolog_Logger_ProfilerService()
    {
        $this->services['monolog.logger.profiler'] = $instance = new \Symfony\Bridge\Monolog\Logger('profiler');

        $instance->pushHandler($this->get('monolog.handler.console'));
        $instance->pushHandler($this->get('monolog.handler.main'));
        $instance->pushHandler($this->get('monolog.handler.debug'));

        return $instance;
    }

    /**
     * Gets the public 'monolog.logger.request' shared service.
     *
     * @return \Symfony\Bridge\Monolog\Logger
     */
    protected function getMonolog_Logger_RequestService()
    {
        $this->services['monolog.logger.request'] = $instance = new \Symfony\Bridge\Monolog\Logger('request');

        $instance->pushHandler($this->get('monolog.handler.console'));
        $instance->pushHandler($this->get('monolog.handler.main'));
        $instance->pushHandler($this->get('monolog.handler.debug'));

        return $instance;
    }

    /**
     * Gets the public 'monolog.logger.security' shared service.
     *
     * @return \Symfony\Bridge\Monolog\Logger
     */
    protected function getMonolog_Logger_SecurityService()
    {
        $this->services['monolog.logger.security'] = $instance = new \Symfony\Bridge\Monolog\Logger('security');

        $instance->pushHandler($this->get('monolog.handler.console'));
        $instance->pushHandler($this->get('monolog.handler.main'));
        $instance->pushHandler($this->get('monolog.handler.debug'));

        return $instance;
    }

    /**
     * Gets the public 'monolog.logger.templating' shared service.
     *
     * @return \Symfony\Bridge\Monolog\Logger
     */
    protected function getMonolog_Logger_TemplatingService()
    {
        $this->services['monolog.logger.templating'] = $instance = new \Symfony\Bridge\Monolog\Logger('templating');

        $instance->pushHandler($this->get('monolog.handler.console'));
        $instance->pushHandler($this->get('monolog.handler.main'));
        $instance->pushHandler($this->get('monolog.handler.debug'));

        return $instance;
    }

    /**
     * Gets the public 'monolog.logger.translation' shared service.
     *
     * @return \Symfony\Bridge\Monolog\Logger
     */
    protected function getMonolog_Logger_TranslationService()
    {
        $this->services['monolog.logger.translation'] = $instance = new \Symfony\Bridge\Monolog\Logger('translation');

        $instance->pushHandler($this->get('monolog.handler.console'));
        $instance->pushHandler($this->get('monolog.handler.main'));
        $instance->pushHandler($this->get('monolog.handler.debug'));

        return $instance;
    }

    /**
     * Gets the public 'nelmio_api_doc.doc_comment_extractor' shared service.
     *
     * @return \Nelmio\ApiDocBundle\Util\DocCommentExtractor
     */
    protected function getNelmioApiDoc_DocCommentExtractorService()
    {
        return $this->services['nelmio_api_doc.doc_comment_extractor'] = new \Nelmio\ApiDocBundle\Util\DocCommentExtractor();
    }

    /**
     * Gets the public 'nelmio_api_doc.event_listener.request' shared service.
     *
     * @return \Nelmio\ApiDocBundle\EventListener\RequestListener
     */
    protected function getNelmioApiDoc_EventListener_RequestService()
    {
        return $this->services['nelmio_api_doc.event_listener.request'] = new \Nelmio\ApiDocBundle\EventListener\RequestListener($this->get('nelmio_api_doc.extractor.api_doc_extractor'), $this->get('nelmio_api_doc.formatter.html_formatter'), '_doc');
    }

    /**
     * Gets the public 'nelmio_api_doc.extractor.api_doc_extractor' shared service.
     *
     * @return \Nelmio\ApiDocBundle\Extractor\ApiDocExtractor
     */
    protected function getNelmioApiDoc_Extractor_ApiDocExtractorService()
    {
        $a = $this->get('nelmio_api_doc.doc_comment_extractor');

        $this->services['nelmio_api_doc.extractor.api_doc_extractor'] = $instance = new \Nelmio\ApiDocBundle\Extractor\ApiDocExtractor($this, $this->get('router'), $this->get('annotation_reader'), $a, new \Symfony\Bundle\FrameworkBundle\Controller\ControllerNameParser($this->get('kernel')), array(0 => new \Nelmio\ApiDocBundle\Extractor\Handler\FosRestHandler(), 1 => new \Nelmio\ApiDocBundle\Extractor\Handler\JmsSecurityExtraHandler(), 2 => new \Nelmio\ApiDocBundle\Extractor\Handler\SensioFrameworkExtraHandler(), 3 => new \Nelmio\ApiDocBundle\Extractor\Handler\PhpDocHandler($a)), array());

        $instance->addParser($this->get('nelmio_api_doc.parser.json_serializable_parser'));
        $instance->addParser($this->get('nelmio_api_doc.parser.collection_parser'));
        $instance->addParser($this->get('nelmio_api_doc.parser.form_errors_parser'));
        $instance->addParser($this->get('nelmio_api_doc.parser.form_type_parser'));
        $instance->addParser($this->get('nelmio_api_doc.parser.validation_parser'));
        $instance->addParser($this->get('nelmio_api_doc.parser.jms_metadata_parser'));

        return $instance;
    }

    /**
     * Gets the public 'nelmio_api_doc.form.extension.description_form_type_extension' shared service.
     *
     * @return \Nelmio\ApiDocBundle\Form\Extension\DescriptionFormTypeExtension
     */
    protected function getNelmioApiDoc_Form_Extension_DescriptionFormTypeExtensionService()
    {
        return $this->services['nelmio_api_doc.form.extension.description_form_type_extension'] = new \Nelmio\ApiDocBundle\Form\Extension\DescriptionFormTypeExtension();
    }

    /**
     * Gets the public 'nelmio_api_doc.formatter.html_formatter' shared service.
     *
     * @return \Nelmio\ApiDocBundle\Formatter\HtmlFormatter
     */
    protected function getNelmioApiDoc_Formatter_HtmlFormatterService()
    {
        $this->services['nelmio_api_doc.formatter.html_formatter'] = $instance = new \Nelmio\ApiDocBundle\Formatter\HtmlFormatter();

        $instance->setTemplatingEngine($this->get('templating'));
        $instance->setMotdTemplate('NelmioApiDocBundle::Components/motd.html.twig');
        $instance->setApiName('API documentation');
        $instance->setEnableSandbox(true);
        $instance->setEndpoint(NULL);
        $instance->setRequestFormatMethod('format_param');
        $instance->setRequestFormats(array('json' => 'application/json', 'xml' => 'application/xml'));
        $instance->setDefaultRequestFormat('json');
        $instance->setAcceptType(NULL);
        $instance->setBodyFormats(array(0 => 'form', 1 => 'json'));
        $instance->setDefaultBodyFormat('form');
        $instance->setAuthentication(NULL);
        $instance->setDefaultSectionsOpened(true);

        return $instance;
    }

    /**
     * Gets the public 'nelmio_api_doc.formatter.markdown_formatter' shared service.
     *
     * @return \Nelmio\ApiDocBundle\Formatter\MarkdownFormatter
     */
    protected function getNelmioApiDoc_Formatter_MarkdownFormatterService()
    {
        return $this->services['nelmio_api_doc.formatter.markdown_formatter'] = new \Nelmio\ApiDocBundle\Formatter\MarkdownFormatter();
    }

    /**
     * Gets the public 'nelmio_api_doc.formatter.simple_formatter' shared service.
     *
     * @return \Nelmio\ApiDocBundle\Formatter\SimpleFormatter
     */
    protected function getNelmioApiDoc_Formatter_SimpleFormatterService()
    {
        return $this->services['nelmio_api_doc.formatter.simple_formatter'] = new \Nelmio\ApiDocBundle\Formatter\SimpleFormatter();
    }

    /**
     * Gets the public 'nelmio_api_doc.formatter.swagger_formatter' shared service.
     *
     * @return \Nelmio\ApiDocBundle\Formatter\SwaggerFormatter
     */
    protected function getNelmioApiDoc_Formatter_SwaggerFormatterService()
    {
        $this->services['nelmio_api_doc.formatter.swagger_formatter'] = $instance = new \Nelmio\ApiDocBundle\Formatter\SwaggerFormatter('dot_notation');

        $instance->setBasePath('/api');
        $instance->setApiVersion('0.1');
        $instance->setSwaggerVersion('1.2');
        $instance->setInfo(array('title' => 'Symfony2', 'description' => 'My awesome Symfony2 app!', 'TermsOfServiceUrl' => NULL, 'contact' => NULL, 'license' => NULL, 'licenseUrl' => NULL));

        return $instance;
    }

    /**
     * Gets the public 'nelmio_api_doc.parser.collection_parser' shared service.
     *
     * @return \Nelmio\ApiDocBundle\Parser\CollectionParser
     */
    protected function getNelmioApiDoc_Parser_CollectionParserService()
    {
        return $this->services['nelmio_api_doc.parser.collection_parser'] = new \Nelmio\ApiDocBundle\Parser\CollectionParser();
    }

    /**
     * Gets the public 'nelmio_api_doc.parser.form_errors_parser' shared service.
     *
     * @return \Nelmio\ApiDocBundle\Parser\FormErrorsParser
     */
    protected function getNelmioApiDoc_Parser_FormErrorsParserService()
    {
        return $this->services['nelmio_api_doc.parser.form_errors_parser'] = new \Nelmio\ApiDocBundle\Parser\FormErrorsParser();
    }

    /**
     * Gets the public 'nelmio_api_doc.parser.form_type_parser' shared service.
     *
     * @return \Nelmio\ApiDocBundle\Parser\FormTypeParser
     */
    protected function getNelmioApiDoc_Parser_FormTypeParserService()
    {
        return $this->services['nelmio_api_doc.parser.form_type_parser'] = new \Nelmio\ApiDocBundle\Parser\FormTypeParser($this->get('form.factory'), true);
    }

    /**
     * Gets the public 'nelmio_api_doc.parser.jms_metadata_parser' shared service.
     *
     * @return \Nelmio\ApiDocBundle\Parser\JmsMetadataParser
     */
    protected function getNelmioApiDoc_Parser_JmsMetadataParserService()
    {
        return $this->services['nelmio_api_doc.parser.jms_metadata_parser'] = new \Nelmio\ApiDocBundle\Parser\JmsMetadataParser($this->get('jms_serializer.metadata_factory'), $this->get('jms_serializer.naming_strategy'), $this->get('nelmio_api_doc.doc_comment_extractor'));
    }

    /**
     * Gets the public 'nelmio_api_doc.parser.json_serializable_parser' shared service.
     *
     * @return \Nelmio\ApiDocBundle\Parser\JsonSerializableParser
     */
    protected function getNelmioApiDoc_Parser_JsonSerializableParserService()
    {
        return $this->services['nelmio_api_doc.parser.json_serializable_parser'] = new \Nelmio\ApiDocBundle\Parser\JsonSerializableParser();
    }

    /**
     * Gets the public 'nelmio_api_doc.parser.validation_parser' shared service.
     *
     * @return \Nelmio\ApiDocBundle\Parser\ValidationParser
     */
    protected function getNelmioApiDoc_Parser_ValidationParserService()
    {
        return $this->services['nelmio_api_doc.parser.validation_parser'] = new \Nelmio\ApiDocBundle\Parser\ValidationParser($this->get('validator'));
    }

    /**
     * Gets the public 'nelmio_api_doc.twig.extension.extra_markdown' shared service.
     *
     * @return \Nelmio\ApiDocBundle\Twig\Extension\MarkdownExtension
     */
    protected function getNelmioApiDoc_Twig_Extension_ExtraMarkdownService()
    {
        return $this->services['nelmio_api_doc.twig.extension.extra_markdown'] = new \Nelmio\ApiDocBundle\Twig\Extension\MarkdownExtension();
    }

    /**
     * Gets the public 'profiler' shared service.
     *
     * @return \Symfony\Component\HttpKernel\Profiler\Profiler
     */
    protected function getProfilerService()
    {
        $a = $this->get('monolog.logger.profiler', ContainerInterface::NULL_ON_INVALID_REFERENCE);
        $b = $this->get('kernel', ContainerInterface::NULL_ON_INVALID_REFERENCE);

        $c = new \Doctrine\Bundle\DoctrineBundle\DataCollector\DoctrineDataCollector($this->get('doctrine'));
        $c->addLogger('default', $this->get('doctrine.dbal.logger.profiling.default'));

        $d = new \Symfony\Component\HttpKernel\DataCollector\ConfigDataCollector();
        if ($this->has('kernel')) {
            $d->setKernel($b);
        }

        $this->services['profiler'] = $instance = new \Symfony\Component\HttpKernel\Profiler\Profiler(new \Symfony\Component\HttpKernel\Profiler\FileProfilerStorage(('file:'.__DIR__.'/profiler'), '', '', 86400), $a);

        $instance->add($this->get('data_collector.request'));
        $instance->add(new \Symfony\Component\HttpKernel\DataCollector\TimeDataCollector($b, $this->get('debug.stopwatch', ContainerInterface::NULL_ON_INVALID_REFERENCE)));
        $instance->add(new \Symfony\Component\HttpKernel\DataCollector\MemoryDataCollector());
        $instance->add(new \Symfony\Component\HttpKernel\DataCollector\AjaxDataCollector());
        $instance->add($this->get('data_collector.form'));
        $instance->add(new \Symfony\Component\HttpKernel\DataCollector\ExceptionDataCollector());
        $instance->add(new \Symfony\Component\HttpKernel\DataCollector\LoggerDataCollector($a));
        $instance->add(new \Symfony\Component\HttpKernel\DataCollector\EventDataCollector($this->get('debug.event_dispatcher', ContainerInterface::NULL_ON_INVALID_REFERENCE)));
        $instance->add($this->get('data_collector.router'));
        $instance->add($this->get('data_collector.translation'));
        $instance->add(new \Symfony\Bundle\SecurityBundle\DataCollector\SecurityDataCollector($this->get('security.token_storage', ContainerInterface::NULL_ON_INVALID_REFERENCE), $this->get('security.role_hierarchy'), $this->get('security.logout_url_generator')));
        $instance->add(new \Symfony\Bridge\Twig\DataCollector\TwigDataCollector($this->get('twig.profile')));
        $instance->add($c);
        $instance->add(new \Symfony\Bundle\SwiftmailerBundle\DataCollector\MessageDataCollector($this));
        $instance->add($this->get('data_collector.dump'));
        $instance->add(new \Sonata\BlockBundle\Profiler\DataCollector\BlockDataCollector($this->get('sonata.block.templating.helper'), array(0 => 'sonata.block.service.container', 1 => 'sonata.page.block.container', 2 => 'sonata.dashboard.block.container', 3 => 'cmf.block.container', 4 => 'cmf.block.slideshow')));
        $instance->add($d);

        return $instance;
    }

    /**
     * Gets the public 'profiler_listener' shared service.
     *
     * @return \Symfony\Component\HttpKernel\EventListener\ProfilerListener
     */
    protected function getProfilerListenerService()
    {
        return $this->services['profiler_listener'] = new \Symfony\Component\HttpKernel\EventListener\ProfilerListener($this->get('profiler'), $this->get('request_stack'), NULL, false, false);
    }

    /**
     * Gets the public 'property_accessor' shared service.
     *
     * @return \Symfony\Component\PropertyAccess\PropertyAccessor
     */
    protected function getPropertyAccessorService()
    {
        return $this->services['property_accessor'] = new \Symfony\Component\PropertyAccess\PropertyAccessor(false, false);
    }

    /**
     * Gets the public 'request' shared service.
     *
     * @throws RuntimeException always since this service is expected to be injected dynamically
     * @throws InactiveScopeException when the 'request' service is requested while the 'request' scope is not active
     * @deprecated The "request" service is deprecated since Symfony 2.7 and will be removed in 3.0. Use the "request_stack" service instead.
     */
    protected function getRequestService()
    {
        if (!isset($this->scopedServices['request'])) {
            throw new InactiveScopeException('request', 'request');
        }

        throw new RuntimeException('You have requested a synthetic service ("request"). The DIC does not know how to construct this service.');
    }

    /**
     * Gets the public 'request_stack' shared service.
     *
     * @return \Symfony\Component\HttpFoundation\RequestStack
     */
    protected function getRequestStackService()
    {
        return $this->services['request_stack'] = new \Symfony\Component\HttpFoundation\RequestStack();
    }

    /**
     * Gets the public 'response_listener' shared service.
     *
     * @return \Symfony\Component\HttpKernel\EventListener\ResponseListener
     */
    protected function getResponseListenerService()
    {
        return $this->services['response_listener'] = new \Symfony\Component\HttpKernel\EventListener\ResponseListener('UTF-8');
    }

    /**
     * Gets the public 'router' shared service.
     *
     * @return \Symfony\Bundle\FrameworkBundle\Routing\Router
     */
    protected function getRouterService()
    {
        $this->services['router'] = $instance = new \Symfony\Bundle\FrameworkBundle\Routing\Router($this, ($this->targetDirs[2].'/config/routing_dev.yml'), array('cache_dir' => __DIR__, 'debug' => true, 'generator_class' => 'Symfony\\Component\\Routing\\Generator\\UrlGenerator', 'generator_base_class' => 'Symfony\\Component\\Routing\\Generator\\UrlGenerator', 'generator_dumper_class' => 'Symfony\\Component\\Routing\\Generator\\Dumper\\PhpGeneratorDumper', 'generator_cache_class' => 'appDevDebugProjectContainerUrlGenerator', 'matcher_class' => 'Symfony\\Bundle\\FrameworkBundle\\Routing\\RedirectableUrlMatcher', 'matcher_base_class' => 'Symfony\\Bundle\\FrameworkBundle\\Routing\\RedirectableUrlMatcher', 'matcher_dumper_class' => 'Symfony\\Component\\Routing\\Matcher\\Dumper\\PhpMatcherDumper', 'matcher_cache_class' => 'appDevDebugProjectContainerUrlMatcher', 'strict_requirements' => true), $this->get('router.request_context', ContainerInterface::NULL_ON_INVALID_REFERENCE));

        $instance->setConfigCacheFactory($this->get('config_cache_factory'));

        return $instance;
    }

    /**
     * Gets the public 'router_listener' shared service.
     *
     * @return \Symfony\Component\HttpKernel\EventListener\RouterListener
     */
    protected function getRouterListenerService()
    {
        return $this->services['router_listener'] = new \Symfony\Component\HttpKernel\EventListener\RouterListener($this->get('router'), $this->get('request_stack'), $this->get('router.request_context', ContainerInterface::NULL_ON_INVALID_REFERENCE), $this->get('monolog.logger.request', ContainerInterface::NULL_ON_INVALID_REFERENCE));
    }

    /**
     * Gets the public 'routing.loader' shared service.
     *
     * @return \Symfony\Bundle\FrameworkBundle\Routing\DelegatingLoader
     */
    protected function getRouting_LoaderService()
    {
        $a = $this->get('file_locator');
        $b = $this->get('annotation_reader');

        $c = new \Sensio\Bundle\FrameworkExtraBundle\Routing\AnnotatedRouteControllerLoader($b);

        $d = new \Symfony\Component\Config\Loader\LoaderResolver();
        $d->addLoader(new \Symfony\Component\Routing\Loader\XmlFileLoader($a));
        $d->addLoader(new \Symfony\Component\Routing\Loader\YamlFileLoader($a));
        $d->addLoader(new \Symfony\Component\Routing\Loader\PhpFileLoader($a));
        $d->addLoader(new \Symfony\Component\Routing\Loader\DirectoryLoader($a));
        $d->addLoader(new \Symfony\Component\Routing\Loader\DependencyInjection\ServiceRouterLoader($this));
        $d->addLoader(new \Symfony\Component\Routing\Loader\AnnotationDirectoryLoader($a, $c));
        $d->addLoader(new \Symfony\Component\Routing\Loader\AnnotationFileLoader($a, $c));
        $d->addLoader($c);
        $d->addLoader(new \FOS\RestBundle\Routing\Loader\DirectoryRouteLoader($a, $this->get('fos_rest.routing.loader.processor')));
        $d->addLoader($this->get('fos_rest.routing.loader.controller'));
        $d->addLoader($this->get('fos_rest.routing.loader.yaml_collection'));
        $d->addLoader($this->get('fos_rest.routing.loader.xml_collection'));
        $d->addLoader($this->get('sonata.admin.route_loader'));

        return $this->services['routing.loader'] = new \Symfony\Bundle\FrameworkBundle\Routing\DelegatingLoader($this->get('controller_name_converter'), $d);
    }

    /**
     * Gets the public 'sch_main.import_csv' shared service.
     *
     * @return \Sch\MainBundle\Service\ImportCSVService
     */
    protected function getSchMain_ImportCsvService()
    {
        return $this->services['sch_main.import_csv'] = new \Sch\MainBundle\Service\ImportCSVService($this, $this->get('file_locator'));
    }

    /**
     * Gets the public 'sch_main.phone' shared service.
     *
     * @return \Sch\MainBundle\Service\PhoneService
     */
    protected function getSchMain_PhoneService()
    {
        return $this->services['sch_main.phone'] = new \Sch\MainBundle\Service\PhoneService($this);
    }

    /**
     * Gets the public 'security.authentication.guard_handler' shared service.
     *
     * @return \Symfony\Component\Security\Guard\GuardAuthenticatorHandler
     */
    protected function getSecurity_Authentication_GuardHandlerService()
    {
        $this->services['security.authentication.guard_handler'] = $instance = new \Symfony\Component\Security\Guard\GuardAuthenticatorHandler($this->get('security.token_storage'), $this->get('debug.event_dispatcher', ContainerInterface::NULL_ON_INVALID_REFERENCE), array());

        $instance->setSessionAuthenticationStrategy($this->get('security.authentication.session_strategy.main'));

        return $instance;
    }

    /**
     * Gets the public 'security.authentication.session_strategy.main' shared service.
     *
     * @return \Symfony\Component\Security\Http\Session\SessionAuthenticationStrategy
     */
    protected function getSecurity_Authentication_SessionStrategy_MainService()
    {
        return $this->services['security.authentication.session_strategy.main'] = new \Symfony\Component\Security\Http\Session\SessionAuthenticationStrategy('migrate');
    }

    /**
     * Gets the public 'security.authentication_utils' shared service.
     *
     * @return \Symfony\Component\Security\Http\Authentication\AuthenticationUtils
     */
    protected function getSecurity_AuthenticationUtilsService()
    {
        return $this->services['security.authentication_utils'] = new \Symfony\Component\Security\Http\Authentication\AuthenticationUtils($this->get('request_stack'));
    }

    /**
     * Gets the public 'security.authorization_checker' shared service.
     *
     * @return \Symfony\Component\Security\Core\Authorization\AuthorizationChecker
     */
    protected function getSecurity_AuthorizationCheckerService()
    {
        return $this->services['security.authorization_checker'] = new \Symfony\Component\Security\Core\Authorization\AuthorizationChecker($this->get('security.token_storage'), $this->get('security.authentication.manager'), $this->get('security.access.decision_manager'), false);
    }

    /**
     * Gets the public 'security.context' shared service.
     *
     * @return \Symfony\Component\Security\Core\SecurityContext
     *
     * @deprecated The "security.context" service is deprecated since Symfony 2.6 and will be removed in 3.0.
     */
    protected function getSecurity_ContextService()
    {
        @trigger_error('The "security.context" service is deprecated since Symfony 2.6 and will be removed in 3.0.', E_USER_DEPRECATED);

        return $this->services['security.context'] = new \Symfony\Component\Security\Core\SecurityContext($this->get('security.token_storage'), $this->get('security.authorization_checker'));
    }

    /**
     * Gets the public 'security.csrf.token_manager' shared service.
     *
     * @return \Symfony\Component\Security\Csrf\CsrfTokenManager
     */
    protected function getSecurity_Csrf_TokenManagerService()
    {
        return $this->services['security.csrf.token_manager'] = new \Symfony\Component\Security\Csrf\CsrfTokenManager(new \Symfony\Component\Security\Csrf\TokenGenerator\UriSafeTokenGenerator(), new \Symfony\Component\Security\Csrf\TokenStorage\SessionTokenStorage($this->get('session')), $this->get('request_stack', ContainerInterface::NULL_ON_INVALID_REFERENCE));
    }

    /**
     * Gets the public 'security.encoder_factory' shared service.
     *
     * @return \Symfony\Component\Security\Core\Encoder\EncoderFactory
     */
    protected function getSecurity_EncoderFactoryService()
    {
        return $this->services['security.encoder_factory'] = new \Symfony\Component\Security\Core\Encoder\EncoderFactory(array());
    }

    /**
     * Gets the public 'security.firewall' shared service.
     *
     * @return \Symfony\Component\Security\Http\Firewall
     */
    protected function getSecurity_FirewallService()
    {
        return $this->services['security.firewall'] = new \Symfony\Component\Security\Http\Firewall(new \Symfony\Bundle\SecurityBundle\Security\FirewallMap($this, array('security.firewall.map.context.dev' => new \Symfony\Component\HttpFoundation\RequestMatcher('^/(_(profiler|wdt)|css|images|js)/'), 'security.firewall.map.context.main' => NULL, 'security.firewall.map.context.secured_area' => NULL)), $this->get('debug.event_dispatcher'));
    }

    /**
     * Gets the public 'security.firewall.map.context.dev' shared service.
     *
     * @return \Symfony\Bundle\SecurityBundle\Security\FirewallContext
     */
    protected function getSecurity_Firewall_Map_Context_DevService()
    {
        return $this->services['security.firewall.map.context.dev'] = new \Symfony\Bundle\SecurityBundle\Security\FirewallContext(array(), NULL, NULL);
    }

    /**
     * Gets the public 'security.firewall.map.context.main' shared service.
     *
     * @return \Symfony\Bundle\SecurityBundle\Security\FirewallContext
     */
    protected function getSecurity_Firewall_Map_Context_MainService()
    {
        $a = $this->get('security.token_storage');
        $b = $this->get('monolog.logger.security', ContainerInterface::NULL_ON_INVALID_REFERENCE);

        return $this->services['security.firewall.map.context.main'] = new \Symfony\Bundle\SecurityBundle\Security\FirewallContext(array(0 => $this->get('security.channel_listener'), 1 => new \Symfony\Component\Security\Http\Firewall\ContextListener($a, array(0 => $this->get('security.user.provider.concrete.in_memory')), 'main', $b, $this->get('debug.event_dispatcher', ContainerInterface::NULL_ON_INVALID_REFERENCE)), 2 => new \Symfony\Component\Security\Http\Firewall\AnonymousAuthenticationListener($a, '5bbc480f681000.61069306', $b, $this->get('security.authentication.manager')), 3 => $this->get('security.access_listener')), new \Symfony\Component\Security\Http\Firewall\ExceptionListener($a, $this->get('security.authentication.trust_resolver'), $this->get('security.http_utils'), 'main', NULL, NULL, NULL, $b, false), NULL);
    }

    /**
     * Gets the public 'security.firewall.map.context.secured_area' shared service.
     *
     * @return \Symfony\Bundle\SecurityBundle\Security\FirewallContext
     */
    protected function getSecurity_Firewall_Map_Context_SecuredAreaService()
    {
        $a = $this->get('security.token_storage');
        $b = $this->get('monolog.logger.security', ContainerInterface::NULL_ON_INVALID_REFERENCE);
        $c = $this->get('debug.event_dispatcher', ContainerInterface::NULL_ON_INVALID_REFERENCE);
        $d = $this->get('security.http_utils');
        $e = $this->get('http_kernel');

        $f = new \Symfony\Component\Security\Http\Authentication\DefaultAuthenticationSuccessHandler($d, array());
        $f->setOptions(array('always_use_default_target_path' => false, 'default_target_path' => '/', 'login_path' => '/login', 'target_path_parameter' => '_target_path', 'use_referer' => false));
        $f->setProviderKey('secured_area');

        $g = new \Symfony\Component\Security\Http\Authentication\DefaultAuthenticationFailureHandler($e, $d, array(), $b);
        $g->setOptions(array('login_path' => '/login', 'failure_path' => NULL, 'failure_forward' => false, 'failure_path_parameter' => '_failure_path'));

        return $this->services['security.firewall.map.context.secured_area'] = new \Symfony\Bundle\SecurityBundle\Security\FirewallContext(array(0 => $this->get('security.channel_listener'), 1 => new \Symfony\Component\Security\Http\Firewall\ContextListener($a, array(0 => $this->get('security.user.provider.concrete.in_memory')), 'secured_area', $b, $c), 2 => new \Symfony\Component\Security\Http\Firewall\UsernamePasswordFormAuthenticationListener($a, $this->get('security.authentication.manager'), $this->get('security.authentication.session_strategy.main'), $d, 'secured_area', $f, $g, array('csrf_parameter' => '_csrf_security_token', 'csrf_token_id' => 'a_private_string', 'check_path' => '/login_check', 'use_forward' => false, 'require_previous_session' => true, 'username_parameter' => '_username', 'password_parameter' => '_password', 'post_only' => true), $b, $c, NULL), 3 => $this->get('security.access_listener')), new \Symfony\Component\Security\Http\Firewall\ExceptionListener($a, $this->get('security.authentication.trust_resolver'), $d, 'secured_area', new \Symfony\Component\Security\Http\EntryPoint\FormAuthenticationEntryPoint($e, $d, '/login', false), NULL, NULL, $b, false), NULL);
    }

    /**
     * Gets the public 'security.password_encoder' shared service.
     *
     * @return \Symfony\Component\Security\Core\Encoder\UserPasswordEncoder
     */
    protected function getSecurity_PasswordEncoderService()
    {
        return $this->services['security.password_encoder'] = new \Symfony\Component\Security\Core\Encoder\UserPasswordEncoder($this->get('security.encoder_factory'));
    }

    /**
     * Gets the public 'security.rememberme.response_listener' shared service.
     *
     * @return \Symfony\Component\Security\Http\RememberMe\ResponseListener
     */
    protected function getSecurity_Rememberme_ResponseListenerService()
    {
        return $this->services['security.rememberme.response_listener'] = new \Symfony\Component\Security\Http\RememberMe\ResponseListener();
    }

    /**
     * Gets the public 'security.secure_random' shared service.
     *
     * @return \Symfony\Component\Security\Core\Util\SecureRandom
     *
     * @deprecated The "security.secure_random" service is deprecated since Symfony 2.8 and will be removed in 3.0. Use the random_bytes() function instead.
     */
    protected function getSecurity_SecureRandomService()
    {
        @trigger_error('The "security.secure_random" service is deprecated since Symfony 2.8 and will be removed in 3.0. Use the random_bytes() function instead.', E_USER_DEPRECATED);

        return $this->services['security.secure_random'] = new \Symfony\Component\Security\Core\Util\SecureRandom();
    }

    /**
     * Gets the public 'security.token_storage' shared service.
     *
     * @return \Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage
     */
    protected function getSecurity_TokenStorageService()
    {
        return $this->services['security.token_storage'] = new \Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage();
    }

    /**
     * Gets the public 'security.user_checker.main' shared service.
     *
     * @return \Symfony\Component\Security\Core\User\UserChecker
     */
    protected function getSecurity_UserChecker_MainService()
    {
        return $this->services['security.user_checker.main'] = new \Symfony\Component\Security\Core\User\UserChecker();
    }

    /**
     * Gets the public 'security.validator.user_password' shared service.
     *
     * @return \Symfony\Component\Security\Core\Validator\Constraints\UserPasswordValidator
     */
    protected function getSecurity_Validator_UserPasswordService()
    {
        return $this->services['security.validator.user_password'] = new \Symfony\Component\Security\Core\Validator\Constraints\UserPasswordValidator($this->get('security.token_storage'), $this->get('security.encoder_factory'));
    }

    /**
     * Gets the public 'sensio_distribution.security_checker' shared service.
     *
     * @return \SensioLabs\Security\SecurityChecker
     */
    protected function getSensioDistribution_SecurityCheckerService()
    {
        return $this->services['sensio_distribution.security_checker'] = new \SensioLabs\Security\SecurityChecker();
    }

    /**
     * Gets the public 'sensio_distribution.security_checker.command' shared service.
     *
     * @return \SensioLabs\Security\Command\SecurityCheckerCommand
     */
    protected function getSensioDistribution_SecurityChecker_CommandService()
    {
        return $this->services['sensio_distribution.security_checker.command'] = new \SensioLabs\Security\Command\SecurityCheckerCommand($this->get('sensio_distribution.security_checker'));
    }

    /**
     * Gets the public 'sensio_distribution.webconfigurator' shared service.
     *
     * @return \Sensio\Bundle\DistributionBundle\Configurator\Configurator
     */
    protected function getSensioDistribution_WebconfiguratorService()
    {
        $this->services['sensio_distribution.webconfigurator'] = $instance = new \Sensio\Bundle\DistributionBundle\Configurator\Configurator($this->targetDirs[2]);

        $instance->addStep(new \Sensio\Bundle\DistributionBundle\Configurator\Step\DoctrineStep(), 10);
        $instance->addStep(new \Sensio\Bundle\DistributionBundle\Configurator\Step\SecretStep(), 0);

        return $instance;
    }

    /**
     * Gets the public 'sensio_framework_extra.cache.listener' shared service.
     *
     * @return \Sensio\Bundle\FrameworkExtraBundle\EventListener\HttpCacheListener
     */
    protected function getSensioFrameworkExtra_Cache_ListenerService()
    {
        return $this->services['sensio_framework_extra.cache.listener'] = new \Sensio\Bundle\FrameworkExtraBundle\EventListener\HttpCacheListener();
    }

    /**
     * Gets the public 'sensio_framework_extra.controller.listener' shared service.
     *
     * @return \Sensio\Bundle\FrameworkExtraBundle\EventListener\ControllerListener
     */
    protected function getSensioFrameworkExtra_Controller_ListenerService()
    {
        return $this->services['sensio_framework_extra.controller.listener'] = new \Sensio\Bundle\FrameworkExtraBundle\EventListener\ControllerListener($this->get('annotation_reader'));
    }

    /**
     * Gets the public 'sensio_framework_extra.converter.datetime' shared service.
     *
     * @return \Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\DateTimeParamConverter
     */
    protected function getSensioFrameworkExtra_Converter_DatetimeService()
    {
        return $this->services['sensio_framework_extra.converter.datetime'] = new \Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\DateTimeParamConverter();
    }

    /**
     * Gets the public 'sensio_framework_extra.converter.doctrine.orm' shared service.
     *
     * @return \Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\DoctrineParamConverter
     */
    protected function getSensioFrameworkExtra_Converter_Doctrine_OrmService()
    {
        return $this->services['sensio_framework_extra.converter.doctrine.orm'] = new \Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\DoctrineParamConverter($this->get('doctrine', ContainerInterface::NULL_ON_INVALID_REFERENCE));
    }

    /**
     * Gets the public 'sensio_framework_extra.converter.listener' shared service.
     *
     * @return \Sensio\Bundle\FrameworkExtraBundle\EventListener\ParamConverterListener
     */
    protected function getSensioFrameworkExtra_Converter_ListenerService()
    {
        return $this->services['sensio_framework_extra.converter.listener'] = new \Sensio\Bundle\FrameworkExtraBundle\EventListener\ParamConverterListener($this->get('sensio_framework_extra.converter.manager'), true);
    }

    /**
     * Gets the public 'sensio_framework_extra.converter.manager' shared service.
     *
     * @return \Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterManager
     */
    protected function getSensioFrameworkExtra_Converter_ManagerService()
    {
        $this->services['sensio_framework_extra.converter.manager'] = $instance = new \Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterManager();

        $instance->add($this->get('sensio_framework_extra.converter.doctrine.orm'), 0, 'doctrine.orm');
        $instance->add($this->get('sensio_framework_extra.converter.datetime'), 0, 'datetime');

        return $instance;
    }

    /**
     * Gets the public 'sensio_framework_extra.security.listener' shared service.
     *
     * @return \Sensio\Bundle\FrameworkExtraBundle\EventListener\SecurityListener
     */
    protected function getSensioFrameworkExtra_Security_ListenerService()
    {
        return $this->services['sensio_framework_extra.security.listener'] = new \Sensio\Bundle\FrameworkExtraBundle\EventListener\SecurityListener(NULL, new \Sensio\Bundle\FrameworkExtraBundle\Security\ExpressionLanguage(), $this->get('security.authentication.trust_resolver', ContainerInterface::NULL_ON_INVALID_REFERENCE), $this->get('security.role_hierarchy', ContainerInterface::NULL_ON_INVALID_REFERENCE), $this->get('security.token_storage', ContainerInterface::NULL_ON_INVALID_REFERENCE), $this->get('security.authorization_checker', ContainerInterface::NULL_ON_INVALID_REFERENCE));
    }

    /**
     * Gets the public 'sensio_framework_extra.view.guesser' shared service.
     *
     * @return \Sensio\Bundle\FrameworkExtraBundle\Templating\TemplateGuesser
     */
    protected function getSensioFrameworkExtra_View_GuesserService()
    {
        return $this->services['sensio_framework_extra.view.guesser'] = new \Sensio\Bundle\FrameworkExtraBundle\Templating\TemplateGuesser($this->get('kernel'));
    }

    /**
     * Gets the public 'service_container' shared service.
     *
     * @throws RuntimeException always since this service is expected to be injected dynamically
     */
    protected function getServiceContainerService()
    {
        throw new RuntimeException('You have requested a synthetic service ("service_container"). The DIC does not know how to construct this service.');
    }

    /**
     * Gets the public 'session' shared service.
     *
     * @return \Symfony\Component\HttpFoundation\Session\Session
     */
    protected function getSessionService()
    {
        return $this->services['session'] = new \Symfony\Component\HttpFoundation\Session\Session($this->get('session.storage.native'), new \Symfony\Component\HttpFoundation\Session\Attribute\AttributeBag(), new \Symfony\Component\HttpFoundation\Session\Flash\FlashBag());
    }

    /**
     * Gets the public 'session.save_listener' shared service.
     *
     * @return \Symfony\Component\HttpKernel\EventListener\SaveSessionListener
     */
    protected function getSession_SaveListenerService()
    {
        return $this->services['session.save_listener'] = new \Symfony\Component\HttpKernel\EventListener\SaveSessionListener();
    }

    /**
     * Gets the public 'session.storage.filesystem' shared service.
     *
     * @return \Symfony\Component\HttpFoundation\Session\Storage\MockFileSessionStorage
     */
    protected function getSession_Storage_FilesystemService()
    {
        return $this->services['session.storage.filesystem'] = new \Symfony\Component\HttpFoundation\Session\Storage\MockFileSessionStorage((__DIR__.'/sessions'), 'MOCKSESSID', $this->get('session.storage.metadata_bag'));
    }

    /**
     * Gets the public 'session.storage.native' shared service.
     *
     * @return \Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage
     */
    protected function getSession_Storage_NativeService()
    {
        return $this->services['session.storage.native'] = new \Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage(array('cookie_httponly' => true, 'gc_probability' => 1), NULL, $this->get('session.storage.metadata_bag'));
    }

    /**
     * Gets the public 'session.storage.php_bridge' shared service.
     *
     * @return \Symfony\Component\HttpFoundation\Session\Storage\PhpBridgeSessionStorage
     */
    protected function getSession_Storage_PhpBridgeService()
    {
        return $this->services['session.storage.php_bridge'] = new \Symfony\Component\HttpFoundation\Session\Storage\PhpBridgeSessionStorage(NULL, $this->get('session.storage.metadata_bag'));
    }

    /**
     * Gets the public 'session_listener' shared service.
     *
     * @return \Symfony\Bundle\FrameworkBundle\EventListener\SessionListener
     */
    protected function getSessionListenerService()
    {
        return $this->services['session_listener'] = new \Symfony\Bundle\FrameworkBundle\EventListener\SessionListener($this);
    }

    /**
     * Gets the public 'sonata.admin.action.append_form_field_element' shared service.
     *
     * @return \Sonata\AdminBundle\Action\AppendFormFieldElementAction
     */
    protected function getSonata_Admin_Action_AppendFormFieldElementService()
    {
        return $this->services['sonata.admin.action.append_form_field_element'] = new \Sonata\AdminBundle\Action\AppendFormFieldElementAction($this->get('twig'), $this->get('sonata.admin.pool'), $this->get('sonata.admin.helper'));
    }

    /**
     * Gets the public 'sonata.admin.action.get_short_object_description' shared service.
     *
     * @return \Sonata\AdminBundle\Action\GetShortObjectDescriptionAction
     */
    protected function getSonata_Admin_Action_GetShortObjectDescriptionService()
    {
        return $this->services['sonata.admin.action.get_short_object_description'] = new \Sonata\AdminBundle\Action\GetShortObjectDescriptionAction($this->get('twig'), $this->get('sonata.admin.pool'));
    }

    /**
     * Gets the public 'sonata.admin.action.retrieve_autocomplete_items' shared service.
     *
     * @return \Sonata\AdminBundle\Action\RetrieveAutocompleteItemsAction
     */
    protected function getSonata_Admin_Action_RetrieveAutocompleteItemsService()
    {
        return $this->services['sonata.admin.action.retrieve_autocomplete_items'] = new \Sonata\AdminBundle\Action\RetrieveAutocompleteItemsAction($this->get('sonata.admin.pool'));
    }

    /**
     * Gets the public 'sonata.admin.action.retrieve_form_field_element' shared service.
     *
     * @return \Sonata\AdminBundle\Action\RetrieveFormFieldElementAction
     */
    protected function getSonata_Admin_Action_RetrieveFormFieldElementService()
    {
        return $this->services['sonata.admin.action.retrieve_form_field_element'] = new \Sonata\AdminBundle\Action\RetrieveFormFieldElementAction($this->get('twig'), $this->get('sonata.admin.pool'), $this->get('sonata.admin.helper'));
    }

    /**
     * Gets the public 'sonata.admin.action.set_object_field_value' shared service.
     *
     * @return \Sonata\AdminBundle\Action\SetObjectFieldValueAction
     */
    protected function getSonata_Admin_Action_SetObjectFieldValueService()
    {
        return $this->services['sonata.admin.action.set_object_field_value'] = new \Sonata\AdminBundle\Action\SetObjectFieldValueAction($this->get('twig'), $this->get('sonata.admin.pool'), $this->get('validator'));
    }

    /**
     * Gets the public 'sonata.admin.audit.manager' shared service.
     *
     * @return \Sonata\AdminBundle\Model\AuditManager
     */
    protected function getSonata_Admin_Audit_ManagerService()
    {
        return $this->services['sonata.admin.audit.manager'] = new \Sonata\AdminBundle\Model\AuditManager($this);
    }

    /**
     * Gets the public 'sonata.admin.block.admin_list' shared service.
     *
     * @return \Sonata\AdminBundle\Block\AdminListBlockService
     */
    protected function getSonata_Admin_Block_AdminListService()
    {
        return $this->services['sonata.admin.block.admin_list'] = new \Sonata\AdminBundle\Block\AdminListBlockService('sonata.admin.block.admin_list', $this->get('sonata.templating'), $this->get('sonata.admin.pool'), $this->get('sonata.admin.global_template_registry'));
    }

    /**
     * Gets the public 'sonata.admin.block.search_result' shared service.
     *
     * @return \Sonata\AdminBundle\Block\AdminSearchBlockService
     */
    protected function getSonata_Admin_Block_SearchResultService()
    {
        return $this->services['sonata.admin.block.search_result'] = new \Sonata\AdminBundle\Block\AdminSearchBlockService('sonata.admin.block.search_result', $this->get('sonata.templating'), $this->get('sonata.admin.pool'), $this->get('sonata.admin.search.handler'));
    }

    /**
     * Gets the public 'sonata.admin.block.stats' shared service.
     *
     * @return \Sonata\AdminBundle\Block\AdminStatsBlockService
     */
    protected function getSonata_Admin_Block_StatsService()
    {
        return $this->services['sonata.admin.block.stats'] = new \Sonata\AdminBundle\Block\AdminStatsBlockService('sonata.admin.block.stats', $this->get('sonata.templating'), $this->get('sonata.admin.pool'));
    }

    /**
     * Gets the public 'sonata.admin.breadcrumbs_builder' shared service.
     *
     * @return \Sonata\AdminBundle\Admin\BreadcrumbsBuilder
     */
    protected function getSonata_Admin_BreadcrumbsBuilderService()
    {
        return $this->services['sonata.admin.breadcrumbs_builder'] = new \Sonata\AdminBundle\Admin\BreadcrumbsBuilder(array('child_admin_route' => 'edit'));
    }

    /**
     * Gets the public 'sonata.admin.builder.filter.factory' shared service.
     *
     * @return \Sonata\AdminBundle\Filter\FilterFactory
     */
    protected function getSonata_Admin_Builder_Filter_FactoryService()
    {
        return $this->services['sonata.admin.builder.filter.factory'] = new \Sonata\AdminBundle\Filter\FilterFactory($this, array('Sonata\\DoctrineORMAdminBundle\\Filter\\BooleanFilter' => 'sonata.admin.orm.filter.type.boolean', 'doctrine_orm_boolean' => 'sonata.admin.orm.filter.type.boolean', 'Sonata\\DoctrineORMAdminBundle\\Filter\\CallbackFilter' => 'sonata.admin.orm.filter.type.callback', 'doctrine_orm_callback' => 'sonata.admin.orm.filter.type.callback', 'Sonata\\DoctrineORMAdminBundle\\Filter\\ChoiceFilter' => 'sonata.admin.orm.filter.type.choice', 'doctrine_orm_choice' => 'sonata.admin.orm.filter.type.choice', 'Sonata\\DoctrineORMAdminBundle\\Filter\\ModelFilter' => 'sonata.admin.orm.filter.type.model', 'doctrine_orm_model' => 'sonata.admin.orm.filter.type.model', 'Sonata\\DoctrineORMAdminBundle\\Filter\\ModelAutocompleteFilter' => 'sonata.admin.orm.filter.type.model_autocomplete', 'doctrine_orm_model_autocomplete' => 'sonata.admin.orm.filter.type.model_autocomplete', 'Sonata\\DoctrineORMAdminBundle\\Filter\\StringFilter' => 'sonata.admin.orm.filter.type.string', 'doctrine_orm_string' => 'sonata.admin.orm.filter.type.string', 'Sonata\\DoctrineORMAdminBundle\\Filter\\NumberFilter' => 'sonata.admin.orm.filter.type.number', 'doctrine_orm_number' => 'sonata.admin.orm.filter.type.number', 'Sonata\\DoctrineORMAdminBundle\\Filter\\DateFilter' => 'sonata.admin.orm.filter.type.date', 'doctrine_orm_date' => 'sonata.admin.orm.filter.type.date', 'Sonata\\DoctrineORMAdminBundle\\Filter\\DateRangeFilter' => 'sonata.admin.orm.filter.type.date_range', 'doctrine_orm_date_range' => 'sonata.admin.orm.filter.type.date_range', 'Sonata\\DoctrineORMAdminBundle\\Filter\\DateTimeFilter' => 'sonata.admin.orm.filter.type.datetime', 'doctrine_orm_datetime' => 'sonata.admin.orm.filter.type.datetime', 'Sonata\\DoctrineORMAdminBundle\\Filter\\TimeFilter' => 'sonata.admin.orm.filter.type.time', 'doctrine_orm_time' => 'sonata.admin.orm.filter.type.time', 'Sonata\\DoctrineORMAdminBundle\\Filter\\DateTimeRangeFilter' => 'sonata.admin.orm.filter.type.datetime_range', 'doctrine_orm_datetime_range' => 'sonata.admin.orm.filter.type.datetime_range', 'Sonata\\DoctrineORMAdminBundle\\Filter\\ClassFilter' => 'sonata.admin.orm.filter.type.class', 'doctrine_orm_class' => 'sonata.admin.orm.filter.type.class'));
    }

    /**
     * Gets the public 'sonata.admin.builder.orm_datagrid' shared service.
     *
     * @return \Sonata\DoctrineORMAdminBundle\Builder\DatagridBuilder
     */
    protected function getSonata_Admin_Builder_OrmDatagridService()
    {
        return $this->services['sonata.admin.builder.orm_datagrid'] = new \Sonata\DoctrineORMAdminBundle\Builder\DatagridBuilder($this->get('form.factory'), $this->get('sonata.admin.builder.filter.factory'), $this->get('sonata.admin.guesser.orm_datagrid_chain'), true);
    }

    /**
     * Gets the public 'sonata.admin.builder.orm_form' shared service.
     *
     * @return \Sonata\DoctrineORMAdminBundle\Builder\FormContractor
     */
    protected function getSonata_Admin_Builder_OrmFormService()
    {
        return $this->services['sonata.admin.builder.orm_form'] = new \Sonata\DoctrineORMAdminBundle\Builder\FormContractor($this->get('form.factory'));
    }

    /**
     * Gets the public 'sonata.admin.builder.orm_list' shared service.
     *
     * @return \Sonata\DoctrineORMAdminBundle\Builder\ListBuilder
     */
    protected function getSonata_Admin_Builder_OrmListService()
    {
        return $this->services['sonata.admin.builder.orm_list'] = new \Sonata\DoctrineORMAdminBundle\Builder\ListBuilder($this->get('sonata.admin.guesser.orm_list_chain'), array('array' => '@SonataAdmin/CRUD/list_array.html.twig', 'boolean' => '@SonataAdmin/CRUD/list_boolean.html.twig', 'date' => '@SonataAdmin/CRUD/list_date.html.twig', 'time' => '@SonataAdmin/CRUD/list_time.html.twig', 'datetime' => '@SonataAdmin/CRUD/list_datetime.html.twig', 'text' => '@SonataAdmin/CRUD/list_string.html.twig', 'textarea' => '@SonataAdmin/CRUD/list_string.html.twig', 'email' => '@SonataAdmin/CRUD/list_email.html.twig', 'trans' => '@SonataAdmin/CRUD/list_trans.html.twig', 'string' => '@SonataAdmin/CRUD/list_string.html.twig', 'smallint' => '@SonataAdmin/CRUD/list_string.html.twig', 'bigint' => '@SonataAdmin/CRUD/list_string.html.twig', 'integer' => '@SonataAdmin/CRUD/list_string.html.twig', 'decimal' => '@SonataAdmin/CRUD/list_string.html.twig', 'identifier' => '@SonataAdmin/CRUD/list_string.html.twig', 'currency' => '@SonataAdmin/CRUD/list_currency.html.twig', 'percent' => '@SonataAdmin/CRUD/list_percent.html.twig', 'choice' => '@SonataAdmin/CRUD/list_choice.html.twig', 'url' => '@SonataAdmin/CRUD/list_url.html.twig', 'html' => '@SonataAdmin/CRUD/list_html.html.twig'));
    }

    /**
     * Gets the public 'sonata.admin.builder.orm_show' shared service.
     *
     * @return \Sonata\DoctrineORMAdminBundle\Builder\ShowBuilder
     */
    protected function getSonata_Admin_Builder_OrmShowService()
    {
        return $this->services['sonata.admin.builder.orm_show'] = new \Sonata\DoctrineORMAdminBundle\Builder\ShowBuilder($this->get('sonata.admin.guesser.orm_show_chain'), array('array' => '@SonataAdmin/CRUD/show_array.html.twig', 'boolean' => '@SonataAdmin/CRUD/show_boolean.html.twig', 'date' => '@SonataAdmin/CRUD/show_date.html.twig', 'time' => '@SonataAdmin/CRUD/show_time.html.twig', 'datetime' => '@SonataAdmin/CRUD/show_datetime.html.twig', 'text' => '@SonataAdmin/CRUD/base_show_field.html.twig', 'email' => '@SonataAdmin/CRUD/show_email.html.twig', 'trans' => '@SonataAdmin/CRUD/show_trans.html.twig', 'string' => '@SonataAdmin/CRUD/base_show_field.html.twig', 'smallint' => '@SonataAdmin/CRUD/base_show_field.html.twig', 'bigint' => '@SonataAdmin/CRUD/base_show_field.html.twig', 'integer' => '@SonataAdmin/CRUD/base_show_field.html.twig', 'decimal' => '@SonataAdmin/CRUD/base_show_field.html.twig', 'currency' => '@SonataAdmin/CRUD/show_currency.html.twig', 'percent' => '@SonataAdmin/CRUD/show_percent.html.twig', 'choice' => '@SonataAdmin/CRUD/show_choice.html.twig', 'url' => '@SonataAdmin/CRUD/show_url.html.twig', 'html' => '@SonataAdmin/CRUD/show_html.html.twig'));
    }

    /**
     * Gets the public 'sonata.admin.controller.admin' shared service.
     *
     * @return \Sonata\AdminBundle\Controller\HelperController
     *
     * @deprecated The controller service "sonata.admin.controller.admin" is deprecated in favor of several action services since version 3.38.0 and will be removed in 4.0.
     */
    protected function getSonata_Admin_Controller_AdminService()
    {
        @trigger_error('The controller service "sonata.admin.controller.admin" is deprecated in favor of several action services since version 3.38.0 and will be removed in 4.0.', E_USER_DEPRECATED);

        return $this->services['sonata.admin.controller.admin'] = new \Sonata\AdminBundle\Controller\HelperController($this->get('twig'), $this->get('sonata.admin.pool'), $this->get('sonata.admin.helper'), $this->get('validator'));
    }

    /**
     * Gets the public 'sonata.admin.doctrine_orm.form.type.choice_field_mask' shared service.
     *
     * @return \Sonata\AdminBundle\Form\Type\ChoiceFieldMaskType
     */
    protected function getSonata_Admin_DoctrineOrm_Form_Type_ChoiceFieldMaskService()
    {
        return $this->services['sonata.admin.doctrine_orm.form.type.choice_field_mask'] = new \Sonata\AdminBundle\Form\Type\ChoiceFieldMaskType();
    }

    /**
     * Gets the public 'sonata.admin.event.extension' shared service.
     *
     * @return \Sonata\AdminBundle\Event\AdminEventExtension
     */
    protected function getSonata_Admin_Event_ExtensionService()
    {
        return $this->services['sonata.admin.event.extension'] = new \Sonata\AdminBundle\Event\AdminEventExtension($this->get('debug.event_dispatcher'));
    }

    /**
     * Gets the public 'sonata.admin.exporter' shared service.
     *
     * @return \Sonata\AdminBundle\Export\Exporter
     *
     * @deprecated The service "sonata.admin.exporter" is deprecated in favor of the "sonata.exporter.exporter" service since version 3.14 and will be removed in 4.0.
     */
    protected function getSonata_Admin_ExporterService()
    {
        @trigger_error('The service "sonata.admin.exporter" is deprecated in favor of the "sonata.exporter.exporter" service since version 3.14 and will be removed in 4.0.', E_USER_DEPRECATED);

        return $this->services['sonata.admin.exporter'] = new \Sonata\AdminBundle\Export\Exporter();
    }

    /**
     * Gets the public 'sonata.admin.filter_persister.session' shared service.
     *
     * @return \Sonata\AdminBundle\Filter\Persister\SessionFilterPersister
     */
    protected function getSonata_Admin_FilterPersister_SessionService()
    {
        return $this->services['sonata.admin.filter_persister.session'] = new \Sonata\AdminBundle\Filter\Persister\SessionFilterPersister($this->get('session'));
    }

    /**
     * Gets the public 'sonata.admin.form.extension.choice' shared service.
     *
     * @return \Sonata\AdminBundle\Form\Extension\ChoiceTypeExtension
     */
    protected function getSonata_Admin_Form_Extension_ChoiceService()
    {
        return $this->services['sonata.admin.form.extension.choice'] = new \Sonata\AdminBundle\Form\Extension\ChoiceTypeExtension();
    }

    /**
     * Gets the public 'sonata.admin.form.extension.field' shared service.
     *
     * @return \Sonata\AdminBundle\Form\Extension\Field\Type\FormTypeFieldExtension
     */
    protected function getSonata_Admin_Form_Extension_FieldService()
    {
        return $this->services['sonata.admin.form.extension.field'] = new \Sonata\AdminBundle\Form\Extension\Field\Type\FormTypeFieldExtension(array('email' => '', 'textarea' => '', 'text' => '', 'choice' => '', 'integer' => '', 'datetime' => 'sonata-medium-date', 'date' => 'sonata-medium-date', 'Symfony\\Component\\Form\\Extension\\Core\\Type\\ChoiceType' => '', 'Symfony\\Component\\Form\\Extension\\Core\\Type\\DateType' => 'sonata-medium-date', 'Symfony\\Component\\Form\\Extension\\Core\\Type\\DateTimeType' => 'sonata-medium-date', 'Symfony\\Component\\Form\\Extension\\Core\\Type\\EmailType' => '', 'Symfony\\Component\\Form\\Extension\\Core\\Type\\IntegerType' => '', 'Symfony\\Component\\Form\\Extension\\Core\\Type\\TextareaType' => '', 'Symfony\\Component\\Form\\Extension\\Core\\Type\\TextType' => ''), array('html5_validate' => true, 'sort_admins' => false, 'confirm_exit' => true, 'use_select2' => true, 'use_icheck' => true, 'use_bootlint' => false, 'use_stickyforms' => true, 'pager_links' => NULL, 'form_type' => 'standard', 'dropdown_number_groups_per_colums' => 2, 'title_mode' => 'both', 'lock_protection' => false, 'enable_jms_di_extra_autoregistration' => true, 'javascripts' => array(0 => 'bundles/sonatacore/vendor/jquery/dist/jquery.min.js', 1 => 'bundles/sonataadmin/vendor/jquery.scrollTo/jquery.scrollTo.min.js', 2 => 'bundles/sonataadmin/vendor/jqueryui/ui/minified/jquery-ui.min.js', 3 => 'bundles/sonataadmin/vendor/jqueryui/ui/minified/i18n/jquery-ui-i18n.min.js', 4 => 'bundles/sonatacore/vendor/moment/min/moment.min.js', 5 => 'bundles/sonatacore/vendor/bootstrap/dist/js/bootstrap.min.js', 6 => 'bundles/sonatacore/vendor/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js', 7 => 'bundles/sonataadmin/vendor/jquery-form/jquery.form.js', 8 => 'bundles/sonataadmin/jquery/jquery.confirmExit.js', 9 => 'bundles/sonataadmin/vendor/x-editable/dist/bootstrap3-editable/js/bootstrap-editable.min.js', 10 => 'bundles/sonatacore/vendor/select2/select2.min.js', 11 => 'bundles/sonataadmin/vendor/admin-lte/dist/js/app.min.js', 12 => 'bundles/sonataadmin/vendor/iCheck/icheck.min.js', 13 => 'bundles/sonataadmin/vendor/slimScroll/jquery.slimscroll.min.js', 14 => 'bundles/sonataadmin/vendor/waypoints/lib/jquery.waypoints.min.js', 15 => 'bundles/sonataadmin/vendor/waypoints/lib/shortcuts/sticky.min.js', 16 => 'bundles/sonataadmin/vendor/readmore-js/readmore.min.js', 17 => 'bundles/sonataadmin/vendor/masonry/dist/masonry.pkgd.min.js', 18 => 'bundles/sonataadmin/Admin.js', 19 => 'bundles/sonataadmin/treeview.js', 20 => 'bundles/sonataadmin/sidebar.js'), 'stylesheets' => array(0 => 'bundles/sonatacore/vendor/bootstrap/dist/css/bootstrap.min.css', 1 => 'bundles/sonatacore/vendor/components-font-awesome/css/font-awesome.min.css', 2 => 'bundles/sonatacore/vendor/ionicons/css/ionicons.min.css', 3 => 'bundles/sonataadmin/vendor/admin-lte/dist/css/AdminLTE.min.css', 4 => 'bundles/sonataadmin/vendor/admin-lte/dist/css/skins/skin-black.min.css', 5 => 'bundles/sonataadmin/vendor/iCheck/skins/square/blue.css', 6 => 'bundles/sonatacore/vendor/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css', 7 => 'bundles/sonataadmin/vendor/jqueryui/themes/base/jquery-ui.css', 8 => 'bundles/sonatacore/vendor/select2/select2.css', 9 => 'bundles/sonatacore/vendor/select2-bootstrap-css/select2-bootstrap.min.css', 10 => 'bundles/sonataadmin/vendor/x-editable/dist/bootstrap3-editable/css/bootstrap-editable.css', 11 => 'bundles/sonataadmin/css/styles.css', 12 => 'bundles/sonataadmin/css/layout.css', 13 => 'bundles/sonataadmin/css/tree.css'), 'role_admin' => 'ROLE_SONATA_ADMIN', 'role_super_admin' => 'ROLE_SUPER_ADMIN', 'search' => true));
    }

    /**
     * Gets the public 'sonata.admin.form.extension.field.mopa' shared service.
     *
     * @return \Sonata\AdminBundle\Form\Extension\Field\Type\MopaCompatibilityTypeFieldExtension
     */
    protected function getSonata_Admin_Form_Extension_Field_MopaService()
    {
        return $this->services['sonata.admin.form.extension.field.mopa'] = new \Sonata\AdminBundle\Form\Extension\Field\Type\MopaCompatibilityTypeFieldExtension();
    }

    /**
     * Gets the public 'sonata.admin.form.filter.type.choice' shared service.
     *
     * @return \Sonata\AdminBundle\Form\Type\Filter\ChoiceType
     */
    protected function getSonata_Admin_Form_Filter_Type_ChoiceService()
    {
        return $this->services['sonata.admin.form.filter.type.choice'] = new \Sonata\AdminBundle\Form\Type\Filter\ChoiceType($this->get('translator'));
    }

    /**
     * Gets the public 'sonata.admin.form.filter.type.date' shared service.
     *
     * @return \Sonata\AdminBundle\Form\Type\Filter\DateType
     */
    protected function getSonata_Admin_Form_Filter_Type_DateService()
    {
        return $this->services['sonata.admin.form.filter.type.date'] = new \Sonata\AdminBundle\Form\Type\Filter\DateType($this->get('translator'));
    }

    /**
     * Gets the public 'sonata.admin.form.filter.type.daterange' shared service.
     *
     * @return \Sonata\AdminBundle\Form\Type\Filter\DateRangeType
     */
    protected function getSonata_Admin_Form_Filter_Type_DaterangeService()
    {
        return $this->services['sonata.admin.form.filter.type.daterange'] = new \Sonata\AdminBundle\Form\Type\Filter\DateRangeType($this->get('translator'));
    }

    /**
     * Gets the public 'sonata.admin.form.filter.type.datetime' shared service.
     *
     * @return \Sonata\AdminBundle\Form\Type\Filter\DateTimeType
     */
    protected function getSonata_Admin_Form_Filter_Type_DatetimeService()
    {
        return $this->services['sonata.admin.form.filter.type.datetime'] = new \Sonata\AdminBundle\Form\Type\Filter\DateTimeType($this->get('translator'));
    }

    /**
     * Gets the public 'sonata.admin.form.filter.type.datetime_range' shared service.
     *
     * @return \Sonata\AdminBundle\Form\Type\Filter\DateTimeRangeType
     */
    protected function getSonata_Admin_Form_Filter_Type_DatetimeRangeService()
    {
        return $this->services['sonata.admin.form.filter.type.datetime_range'] = new \Sonata\AdminBundle\Form\Type\Filter\DateTimeRangeType($this->get('translator'));
    }

    /**
     * Gets the public 'sonata.admin.form.filter.type.default' shared service.
     *
     * @return \Sonata\AdminBundle\Form\Type\Filter\DefaultType
     */
    protected function getSonata_Admin_Form_Filter_Type_DefaultService()
    {
        return $this->services['sonata.admin.form.filter.type.default'] = new \Sonata\AdminBundle\Form\Type\Filter\DefaultType();
    }

    /**
     * Gets the public 'sonata.admin.form.filter.type.number' shared service.
     *
     * @return \Sonata\AdminBundle\Form\Type\Filter\NumberType
     */
    protected function getSonata_Admin_Form_Filter_Type_NumberService()
    {
        return $this->services['sonata.admin.form.filter.type.number'] = new \Sonata\AdminBundle\Form\Type\Filter\NumberType($this->get('translator'));
    }

    /**
     * Gets the public 'sonata.admin.form.type.admin' shared service.
     *
     * @return \Sonata\AdminBundle\Form\Type\AdminType
     */
    protected function getSonata_Admin_Form_Type_AdminService()
    {
        return $this->services['sonata.admin.form.type.admin'] = new \Sonata\AdminBundle\Form\Type\AdminType();
    }

    /**
     * Gets the public 'sonata.admin.form.type.collection' shared service.
     *
     * @return \Sonata\AdminBundle\Form\Type\CollectionType
     */
    protected function getSonata_Admin_Form_Type_CollectionService()
    {
        return $this->services['sonata.admin.form.type.collection'] = new \Sonata\AdminBundle\Form\Type\CollectionType();
    }

    /**
     * Gets the public 'sonata.admin.form.type.model_autocomplete' shared service.
     *
     * @return \Sonata\AdminBundle\Form\Type\ModelAutocompleteType
     */
    protected function getSonata_Admin_Form_Type_ModelAutocompleteService()
    {
        return $this->services['sonata.admin.form.type.model_autocomplete'] = new \Sonata\AdminBundle\Form\Type\ModelAutocompleteType();
    }

    /**
     * Gets the public 'sonata.admin.form.type.model_choice' shared service.
     *
     * @return \Sonata\AdminBundle\Form\Type\ModelType
     */
    protected function getSonata_Admin_Form_Type_ModelChoiceService()
    {
        return $this->services['sonata.admin.form.type.model_choice'] = new \Sonata\AdminBundle\Form\Type\ModelType($this->get('property_accessor'));
    }

    /**
     * Gets the public 'sonata.admin.form.type.model_hidden' shared service.
     *
     * @return \Sonata\AdminBundle\Form\Type\ModelHiddenType
     */
    protected function getSonata_Admin_Form_Type_ModelHiddenService()
    {
        return $this->services['sonata.admin.form.type.model_hidden'] = new \Sonata\AdminBundle\Form\Type\ModelHiddenType();
    }

    /**
     * Gets the public 'sonata.admin.form.type.model_list' shared service.
     *
     * @return \Sonata\AdminBundle\Form\Type\ModelListType
     */
    protected function getSonata_Admin_Form_Type_ModelListService()
    {
        return $this->services['sonata.admin.form.type.model_list'] = new \Sonata\AdminBundle\Form\Type\ModelListType();
    }

    /**
     * Gets the public 'sonata.admin.form.type.model_reference' shared service.
     *
     * @return \Sonata\AdminBundle\Form\Type\ModelReferenceType
     */
    protected function getSonata_Admin_Form_Type_ModelReferenceService()
    {
        return $this->services['sonata.admin.form.type.model_reference'] = new \Sonata\AdminBundle\Form\Type\ModelReferenceType();
    }

    /**
     * Gets the public 'sonata.admin.global_template_registry' shared service.
     *
     * @return \Sonata\AdminBundle\Templating\TemplateRegistry
     */
    protected function getSonata_Admin_GlobalTemplateRegistryService()
    {
        return $this->services['sonata.admin.global_template_registry'] = new \Sonata\AdminBundle\Templating\TemplateRegistry(array('user_block' => '@SonataAdmin/Core/user_block.html.twig', 'add_block' => '@SonataAdmin/Core/add_block.html.twig', 'layout' => '@SonataAdmin/standard_layout.html.twig', 'ajax' => '@SonataAdmin/ajax_layout.html.twig', 'dashboard' => '@SonataAdmin/Core/dashboard.html.twig', 'search' => '@SonataAdmin/Core/search.html.twig', 'list' => '@SonataAdmin/CRUD/list.html.twig', 'filter' => '@SonataAdmin/Form/filter_admin_fields.html.twig', 'show' => '@SonataAdmin/CRUD/show.html.twig', 'show_compare' => '@SonataAdmin/CRUD/show_compare.html.twig', 'edit' => '@SonataAdmin/CRUD/edit.html.twig', 'preview' => '@SonataAdmin/CRUD/preview.html.twig', 'history' => '@SonataAdmin/CRUD/history.html.twig', 'acl' => '@SonataAdmin/CRUD/acl.html.twig', 'history_revision_timestamp' => '@SonataAdmin/CRUD/history_revision_timestamp.html.twig', 'action' => '@SonataAdmin/CRUD/action.html.twig', 'select' => '@SonataAdmin/CRUD/list__select.html.twig', 'list_block' => '@SonataAdmin/Block/block_admin_list.html.twig', 'search_result_block' => '@SonataAdmin/Block/block_search_result.html.twig', 'short_object_description' => '@SonataAdmin/Helper/short-object-description.html.twig', 'delete' => '@SonataAdmin/CRUD/delete.html.twig', 'batch' => '@SonataAdmin/CRUD/list__batch.html.twig', 'batch_confirmation' => '@SonataAdmin/CRUD/batch_confirmation.html.twig', 'inner_list_row' => '@SonataAdmin/CRUD/list_inner_row.html.twig', 'outer_list_rows_mosaic' => '@SonataAdmin/CRUD/list_outer_rows_mosaic.html.twig', 'outer_list_rows_list' => '@SonataAdmin/CRUD/list_outer_rows_list.html.twig', 'outer_list_rows_tree' => '@SonataAdmin/CRUD/list_outer_rows_tree.html.twig', 'base_list_field' => '@SonataAdmin/CRUD/base_list_field.html.twig', 'pager_links' => '@SonataAdmin/Pager/links.html.twig', 'pager_results' => '@SonataAdmin/Pager/results.html.twig', 'tab_menu_template' => '@SonataAdmin/Core/tab_menu_template.html.twig', 'knp_menu_template' => '@SonataAdmin/Menu/sonata_menu.html.twig', 'action_create' => '@SonataAdmin/CRUD/dashboard__action_create.html.twig', 'button_acl' => '@SonataAdmin/Button/acl_button.html.twig', 'button_create' => '@SonataAdmin/Button/create_button.html.twig', 'button_edit' => '@SonataAdmin/Button/edit_button.html.twig', 'button_history' => '@SonataAdmin/Button/history_button.html.twig', 'button_list' => '@SonataAdmin/Button/list_button.html.twig', 'button_show' => '@SonataAdmin/Button/show_button.html.twig'));
    }

    /**
     * Gets the public 'sonata.admin.guesser.orm_datagrid' shared service.
     *
     * @return \Sonata\DoctrineORMAdminBundle\Guesser\FilterTypeGuesser
     */
    protected function getSonata_Admin_Guesser_OrmDatagridService()
    {
        return $this->services['sonata.admin.guesser.orm_datagrid'] = new \Sonata\DoctrineORMAdminBundle\Guesser\FilterTypeGuesser();
    }

    /**
     * Gets the public 'sonata.admin.guesser.orm_datagrid_chain' shared service.
     *
     * @return \Sonata\AdminBundle\Guesser\TypeGuesserChain
     */
    protected function getSonata_Admin_Guesser_OrmDatagridChainService()
    {
        return $this->services['sonata.admin.guesser.orm_datagrid_chain'] = new \Sonata\AdminBundle\Guesser\TypeGuesserChain(array(0 => $this->get('sonata.admin.guesser.orm_datagrid')));
    }

    /**
     * Gets the public 'sonata.admin.guesser.orm_list' shared service.
     *
     * @return \Sonata\DoctrineORMAdminBundle\Guesser\TypeGuesser
     */
    protected function getSonata_Admin_Guesser_OrmListService()
    {
        return $this->services['sonata.admin.guesser.orm_list'] = new \Sonata\DoctrineORMAdminBundle\Guesser\TypeGuesser();
    }

    /**
     * Gets the public 'sonata.admin.guesser.orm_list_chain' shared service.
     *
     * @return \Sonata\AdminBundle\Guesser\TypeGuesserChain
     */
    protected function getSonata_Admin_Guesser_OrmListChainService()
    {
        return $this->services['sonata.admin.guesser.orm_list_chain'] = new \Sonata\AdminBundle\Guesser\TypeGuesserChain(array(0 => $this->get('sonata.admin.guesser.orm_list')));
    }

    /**
     * Gets the public 'sonata.admin.guesser.orm_show' shared service.
     *
     * @return \Sonata\DoctrineORMAdminBundle\Guesser\TypeGuesser
     */
    protected function getSonata_Admin_Guesser_OrmShowService()
    {
        return $this->services['sonata.admin.guesser.orm_show'] = new \Sonata\DoctrineORMAdminBundle\Guesser\TypeGuesser();
    }

    /**
     * Gets the public 'sonata.admin.guesser.orm_show_chain' shared service.
     *
     * @return \Sonata\AdminBundle\Guesser\TypeGuesserChain
     */
    protected function getSonata_Admin_Guesser_OrmShowChainService()
    {
        return $this->services['sonata.admin.guesser.orm_show_chain'] = new \Sonata\AdminBundle\Guesser\TypeGuesserChain(array(0 => $this->get('sonata.admin.guesser.orm_show')));
    }

    /**
     * Gets the public 'sonata.admin.helper' shared service.
     *
     * @return \Sonata\AdminBundle\Admin\AdminHelper
     */
    protected function getSonata_Admin_HelperService()
    {
        return $this->services['sonata.admin.helper'] = new \Sonata\AdminBundle\Admin\AdminHelper($this->get('sonata.admin.pool'));
    }

    /**
     * Gets the public 'sonata.admin.label.strategy.bc' shared service.
     *
     * @return \Sonata\AdminBundle\Translator\BCLabelTranslatorStrategy
     */
    protected function getSonata_Admin_Label_Strategy_BcService()
    {
        return $this->services['sonata.admin.label.strategy.bc'] = new \Sonata\AdminBundle\Translator\BCLabelTranslatorStrategy();
    }

    /**
     * Gets the public 'sonata.admin.label.strategy.form_component' shared service.
     *
     * @return \Sonata\AdminBundle\Translator\FormLabelTranslatorStrategy
     */
    protected function getSonata_Admin_Label_Strategy_FormComponentService()
    {
        return $this->services['sonata.admin.label.strategy.form_component'] = new \Sonata\AdminBundle\Translator\FormLabelTranslatorStrategy();
    }

    /**
     * Gets the public 'sonata.admin.label.strategy.native' shared service.
     *
     * @return \Sonata\AdminBundle\Translator\NativeLabelTranslatorStrategy
     */
    protected function getSonata_Admin_Label_Strategy_NativeService()
    {
        return $this->services['sonata.admin.label.strategy.native'] = new \Sonata\AdminBundle\Translator\NativeLabelTranslatorStrategy();
    }

    /**
     * Gets the public 'sonata.admin.label.strategy.noop' shared service.
     *
     * @return \Sonata\AdminBundle\Translator\NoopLabelTranslatorStrategy
     */
    protected function getSonata_Admin_Label_Strategy_NoopService()
    {
        return $this->services['sonata.admin.label.strategy.noop'] = new \Sonata\AdminBundle\Translator\NoopLabelTranslatorStrategy();
    }

    /**
     * Gets the public 'sonata.admin.label.strategy.underscore' shared service.
     *
     * @return \Sonata\AdminBundle\Translator\UnderscoreLabelTranslatorStrategy
     */
    protected function getSonata_Admin_Label_Strategy_UnderscoreService()
    {
        return $this->services['sonata.admin.label.strategy.underscore'] = new \Sonata\AdminBundle\Translator\UnderscoreLabelTranslatorStrategy();
    }

    /**
     * Gets the public 'sonata.admin.manager.orm' shared service.
     *
     * @return \Sonata\DoctrineORMAdminBundle\Model\ModelManager
     */
    protected function getSonata_Admin_Manager_OrmService()
    {
        return $this->services['sonata.admin.manager.orm'] = new \Sonata\DoctrineORMAdminBundle\Model\ModelManager($this->get('doctrine'));
    }

    /**
     * Gets the public 'sonata.admin.manipulator.acl.admin' shared service.
     *
     * @return \Sonata\AdminBundle\Util\AdminAclManipulator
     */
    protected function getSonata_Admin_Manipulator_Acl_AdminService()
    {
        return $this->services['sonata.admin.manipulator.acl.admin'] = new \Sonata\AdminBundle\Util\AdminAclManipulator('Sonata\\AdminBundle\\Security\\Acl\\Permission\\MaskBuilder');
    }

    /**
     * Gets the public 'sonata.admin.manipulator.acl.object.orm' shared service.
     *
     * @return \Sonata\DoctrineORMAdminBundle\Util\ObjectAclManipulator
     */
    protected function getSonata_Admin_Manipulator_Acl_Object_OrmService()
    {
        return $this->services['sonata.admin.manipulator.acl.object.orm'] = new \Sonata\DoctrineORMAdminBundle\Util\ObjectAclManipulator();
    }

    /**
     * Gets the public 'sonata.admin.menu.matcher.voter.active' shared service.
     *
     * @return \Sonata\AdminBundle\Menu\Matcher\Voter\ActiveVoter
     */
    protected function getSonata_Admin_Menu_Matcher_Voter_ActiveService()
    {
        return $this->services['sonata.admin.menu.matcher.voter.active'] = new \Sonata\AdminBundle\Menu\Matcher\Voter\ActiveVoter();
    }

    /**
     * Gets the public 'sonata.admin.menu.matcher.voter.admin' shared service.
     *
     * @return \Sonata\AdminBundle\Menu\Matcher\Voter\AdminVoter
     */
    protected function getSonata_Admin_Menu_Matcher_Voter_AdminService()
    {
        return $this->services['sonata.admin.menu.matcher.voter.admin'] = new \Sonata\AdminBundle\Menu\Matcher\Voter\AdminVoter($this->get('request_stack'));
    }

    /**
     * Gets the public 'sonata.admin.menu.matcher.voter.children' shared service.
     *
     * @return \Sonata\AdminBundle\Menu\Matcher\Voter\ChildrenVoter
     *
     * @deprecated The "sonata.admin.menu.matcher.voter.children" service is deprecated since 3.28 and will be removed in 4.0.
     */
    protected function getSonata_Admin_Menu_Matcher_Voter_ChildrenService()
    {
        @trigger_error('The "sonata.admin.menu.matcher.voter.children" service is deprecated since 3.28 and will be removed in 4.0.', E_USER_DEPRECATED);

        return $this->services['sonata.admin.menu.matcher.voter.children'] = new \Sonata\AdminBundle\Menu\Matcher\Voter\ChildrenVoter($this->get('knp_menu.matcher'));
    }

    /**
     * Gets the public 'sonata.admin.menu_builder' shared service.
     *
     * @return \Sonata\AdminBundle\Menu\MenuBuilder
     */
    protected function getSonata_Admin_MenuBuilderService()
    {
        return $this->services['sonata.admin.menu_builder'] = new \Sonata\AdminBundle\Menu\MenuBuilder($this->get('sonata.admin.pool'), $this->get('knp_menu.factory'), $this->get('knp_menu.menu_provider'), $this->get('debug.event_dispatcher'));
    }

    /**
     * Gets the public 'sonata.admin.object.manipulator.acl.admin' shared service.
     *
     * @return \Sonata\AdminBundle\Util\AdminObjectAclManipulator
     */
    protected function getSonata_Admin_Object_Manipulator_Acl_AdminService()
    {
        return $this->services['sonata.admin.object.manipulator.acl.admin'] = new \Sonata\AdminBundle\Util\AdminObjectAclManipulator($this->get('form.factory'), 'Sonata\\AdminBundle\\Security\\Acl\\Permission\\MaskBuilder');
    }

    /**
     * Gets the public 'sonata.admin.orm.filter.type.boolean' service.
     *
     * @return \Sonata\DoctrineORMAdminBundle\Filter\BooleanFilter
     */
    protected function getSonata_Admin_Orm_Filter_Type_BooleanService()
    {
        return new \Sonata\DoctrineORMAdminBundle\Filter\BooleanFilter();
    }

    /**
     * Gets the public 'sonata.admin.orm.filter.type.callback' service.
     *
     * @return \Sonata\DoctrineORMAdminBundle\Filter\CallbackFilter
     */
    protected function getSonata_Admin_Orm_Filter_Type_CallbackService()
    {
        return new \Sonata\DoctrineORMAdminBundle\Filter\CallbackFilter();
    }

    /**
     * Gets the public 'sonata.admin.orm.filter.type.choice' service.
     *
     * @return \Sonata\DoctrineORMAdminBundle\Filter\ChoiceFilter
     */
    protected function getSonata_Admin_Orm_Filter_Type_ChoiceService()
    {
        return new \Sonata\DoctrineORMAdminBundle\Filter\ChoiceFilter();
    }

    /**
     * Gets the public 'sonata.admin.orm.filter.type.class' service.
     *
     * @return \Sonata\DoctrineORMAdminBundle\Filter\ClassFilter
     */
    protected function getSonata_Admin_Orm_Filter_Type_ClassService()
    {
        return new \Sonata\DoctrineORMAdminBundle\Filter\ClassFilter();
    }

    /**
     * Gets the public 'sonata.admin.orm.filter.type.date' service.
     *
     * @return \Sonata\DoctrineORMAdminBundle\Filter\DateFilter
     */
    protected function getSonata_Admin_Orm_Filter_Type_DateService()
    {
        return new \Sonata\DoctrineORMAdminBundle\Filter\DateFilter();
    }

    /**
     * Gets the public 'sonata.admin.orm.filter.type.date_range' service.
     *
     * @return \Sonata\DoctrineORMAdminBundle\Filter\DateRangeFilter
     */
    protected function getSonata_Admin_Orm_Filter_Type_DateRangeService()
    {
        return new \Sonata\DoctrineORMAdminBundle\Filter\DateRangeFilter();
    }

    /**
     * Gets the public 'sonata.admin.orm.filter.type.datetime' service.
     *
     * @return \Sonata\DoctrineORMAdminBundle\Filter\DateTimeFilter
     */
    protected function getSonata_Admin_Orm_Filter_Type_DatetimeService()
    {
        return new \Sonata\DoctrineORMAdminBundle\Filter\DateTimeFilter();
    }

    /**
     * Gets the public 'sonata.admin.orm.filter.type.datetime_range' service.
     *
     * @return \Sonata\DoctrineORMAdminBundle\Filter\DateTimeRangeFilter
     */
    protected function getSonata_Admin_Orm_Filter_Type_DatetimeRangeService()
    {
        return new \Sonata\DoctrineORMAdminBundle\Filter\DateTimeRangeFilter();
    }

    /**
     * Gets the public 'sonata.admin.orm.filter.type.model' service.
     *
     * @return \Sonata\DoctrineORMAdminBundle\Filter\ModelFilter
     */
    protected function getSonata_Admin_Orm_Filter_Type_ModelService()
    {
        return new \Sonata\DoctrineORMAdminBundle\Filter\ModelFilter();
    }

    /**
     * Gets the public 'sonata.admin.orm.filter.type.model_autocomplete' service.
     *
     * @return \Sonata\DoctrineORMAdminBundle\Filter\ModelAutocompleteFilter
     */
    protected function getSonata_Admin_Orm_Filter_Type_ModelAutocompleteService()
    {
        return new \Sonata\DoctrineORMAdminBundle\Filter\ModelAutocompleteFilter();
    }

    /**
     * Gets the public 'sonata.admin.orm.filter.type.number' service.
     *
     * @return \Sonata\DoctrineORMAdminBundle\Filter\NumberFilter
     */
    protected function getSonata_Admin_Orm_Filter_Type_NumberService()
    {
        return new \Sonata\DoctrineORMAdminBundle\Filter\NumberFilter();
    }

    /**
     * Gets the public 'sonata.admin.orm.filter.type.string' service.
     *
     * @return \Sonata\DoctrineORMAdminBundle\Filter\StringFilter
     */
    protected function getSonata_Admin_Orm_Filter_Type_StringService()
    {
        return new \Sonata\DoctrineORMAdminBundle\Filter\StringFilter();
    }

    /**
     * Gets the public 'sonata.admin.orm.filter.type.time' service.
     *
     * @return \Sonata\DoctrineORMAdminBundle\Filter\TimeFilter
     */
    protected function getSonata_Admin_Orm_Filter_Type_TimeService()
    {
        return new \Sonata\DoctrineORMAdminBundle\Filter\TimeFilter();
    }

    /**
     * Gets the public 'sonata.admin.pool' shared service.
     *
     * @return \Sonata\AdminBundle\Admin\Pool
     */
    protected function getSonata_Admin_PoolService()
    {
        $this->services['sonata.admin.pool'] = $instance = new \Sonata\AdminBundle\Admin\Pool($this, 'Sonata Admin', 'https://dribbble.com/shots/2383317-Lion-head', array('html5_validate' => true, 'sort_admins' => false, 'confirm_exit' => true, 'use_select2' => true, 'use_icheck' => true, 'use_bootlint' => false, 'use_stickyforms' => true, 'pager_links' => NULL, 'form_type' => 'standard', 'dropdown_number_groups_per_colums' => 2, 'title_mode' => 'both', 'lock_protection' => false, 'enable_jms_di_extra_autoregistration' => true, 'javascripts' => array(0 => 'bundles/sonatacore/vendor/jquery/dist/jquery.min.js', 1 => 'bundles/sonataadmin/vendor/jquery.scrollTo/jquery.scrollTo.min.js', 2 => 'bundles/sonataadmin/vendor/jqueryui/ui/minified/jquery-ui.min.js', 3 => 'bundles/sonataadmin/vendor/jqueryui/ui/minified/i18n/jquery-ui-i18n.min.js', 4 => 'bundles/sonatacore/vendor/moment/min/moment.min.js', 5 => 'bundles/sonatacore/vendor/bootstrap/dist/js/bootstrap.min.js', 6 => 'bundles/sonatacore/vendor/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js', 7 => 'bundles/sonataadmin/vendor/jquery-form/jquery.form.js', 8 => 'bundles/sonataadmin/jquery/jquery.confirmExit.js', 9 => 'bundles/sonataadmin/vendor/x-editable/dist/bootstrap3-editable/js/bootstrap-editable.min.js', 10 => 'bundles/sonatacore/vendor/select2/select2.min.js', 11 => 'bundles/sonataadmin/vendor/admin-lte/dist/js/app.min.js', 12 => 'bundles/sonataadmin/vendor/iCheck/icheck.min.js', 13 => 'bundles/sonataadmin/vendor/slimScroll/jquery.slimscroll.min.js', 14 => 'bundles/sonataadmin/vendor/waypoints/lib/jquery.waypoints.min.js', 15 => 'bundles/sonataadmin/vendor/waypoints/lib/shortcuts/sticky.min.js', 16 => 'bundles/sonataadmin/vendor/readmore-js/readmore.min.js', 17 => 'bundles/sonataadmin/vendor/masonry/dist/masonry.pkgd.min.js', 18 => 'bundles/sonataadmin/Admin.js', 19 => 'bundles/sonataadmin/treeview.js', 20 => 'bundles/sonataadmin/sidebar.js'), 'stylesheets' => array(0 => 'bundles/sonatacore/vendor/bootstrap/dist/css/bootstrap.min.css', 1 => 'bundles/sonatacore/vendor/components-font-awesome/css/font-awesome.min.css', 2 => 'bundles/sonatacore/vendor/ionicons/css/ionicons.min.css', 3 => 'bundles/sonataadmin/vendor/admin-lte/dist/css/AdminLTE.min.css', 4 => 'bundles/sonataadmin/vendor/admin-lte/dist/css/skins/skin-black.min.css', 5 => 'bundles/sonataadmin/vendor/iCheck/skins/square/blue.css', 6 => 'bundles/sonatacore/vendor/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css', 7 => 'bundles/sonataadmin/vendor/jqueryui/themes/base/jquery-ui.css', 8 => 'bundles/sonatacore/vendor/select2/select2.css', 9 => 'bundles/sonatacore/vendor/select2-bootstrap-css/select2-bootstrap.min.css', 10 => 'bundles/sonataadmin/vendor/x-editable/dist/bootstrap3-editable/css/bootstrap-editable.css', 11 => 'bundles/sonataadmin/css/styles.css', 12 => 'bundles/sonataadmin/css/layout.css', 13 => 'bundles/sonataadmin/css/tree.css'), 'role_admin' => 'ROLE_SONATA_ADMIN', 'role_super_admin' => 'ROLE_SUPER_ADMIN', 'search' => true), $this->get('property_accessor'));

        $instance->setTemplateRegistry($this->get('sonata.admin.global_template_registry'));
        $instance->setAdminServiceIds(array(0 => 'main.admin.test', 1 => 'main.admin.category', 2 => 'main.admin.blog_post'));
        $instance->setAdminGroups(array('admin' => array('label' => 'admin', 'label_catalogue' => 'SonataAdminBundle', 'icon' => '<i class="fa fa-folder"></i>', 'roles' => array(), 'on_top' => false, 'keep_open' => false, 'items' => array(0 => array('admin' => 'main.admin.test', 'label' => 'Test', 'route' => '', 'route_params' => array(), 'route_absolute' => false), 1 => array('admin' => 'main.admin.category', 'label' => 'Category', 'route' => '', 'route_params' => array(), 'route_absolute' => false), 2 => array('admin' => 'main.admin.blog_post', 'label' => 'Blog Post', 'route' => '', 'route_params' => array(), 'route_absolute' => false)))));
        $instance->setAdminClasses(array('\\Sch\\MainBundle\\Entity\\Test' => array(0 => 'main.admin.test'), 'Sch\\MainBundle\\Entity\\Category' => array(0 => 'main.admin.category'), 'Sch\\MainBundle\\Entity\\BlogPost' => array(0 => 'main.admin.blog_post')));

        return $instance;
    }

    /**
     * Gets the public 'sonata.admin.route.cache' shared service.
     *
     * @return \Sonata\AdminBundle\Route\RoutesCache
     */
    protected function getSonata_Admin_Route_CacheService()
    {
        return $this->services['sonata.admin.route.cache'] = new \Sonata\AdminBundle\Route\RoutesCache((__DIR__.'/sonata/admin'), true);
    }

    /**
     * Gets the public 'sonata.admin.route.cache_warmup' shared service.
     *
     * @return \Sonata\AdminBundle\Route\RoutesCacheWarmUp
     */
    protected function getSonata_Admin_Route_CacheWarmupService()
    {
        return $this->services['sonata.admin.route.cache_warmup'] = new \Sonata\AdminBundle\Route\RoutesCacheWarmUp($this->get('sonata.admin.route.cache'), $this->get('sonata.admin.pool'));
    }

    /**
     * Gets the public 'sonata.admin.route.default_generator' shared service.
     *
     * @return \Sonata\AdminBundle\Route\DefaultRouteGenerator
     */
    protected function getSonata_Admin_Route_DefaultGeneratorService()
    {
        return $this->services['sonata.admin.route.default_generator'] = new \Sonata\AdminBundle\Route\DefaultRouteGenerator($this->get('router'), $this->get('sonata.admin.route.cache'));
    }

    /**
     * Gets the public 'sonata.admin.route.path_info' shared service.
     *
     * @return \Sonata\AdminBundle\Route\PathInfoBuilder
     */
    protected function getSonata_Admin_Route_PathInfoService()
    {
        return $this->services['sonata.admin.route.path_info'] = new \Sonata\AdminBundle\Route\PathInfoBuilder($this->get('sonata.admin.audit.manager'));
    }

    /**
     * Gets the public 'sonata.admin.route.query_string' shared service.
     *
     * @return \Sonata\AdminBundle\Route\QueryStringBuilder
     */
    protected function getSonata_Admin_Route_QueryStringService()
    {
        return $this->services['sonata.admin.route.query_string'] = new \Sonata\AdminBundle\Route\QueryStringBuilder($this->get('sonata.admin.audit.manager'));
    }

    /**
     * Gets the public 'sonata.admin.route_loader' shared service.
     *
     * @return \Sonata\AdminBundle\Route\AdminPoolLoader
     */
    protected function getSonata_Admin_RouteLoaderService()
    {
        return $this->services['sonata.admin.route_loader'] = new \Sonata\AdminBundle\Route\AdminPoolLoader($this->get('sonata.admin.pool'), array(0 => 'main.admin.test', 1 => 'main.admin.category', 2 => 'main.admin.blog_post'), $this);
    }

    /**
     * Gets the public 'sonata.admin.search.handler' shared service.
     *
     * @return \Sonata\AdminBundle\Search\SearchHandler
     */
    protected function getSonata_Admin_Search_HandlerService()
    {
        return $this->services['sonata.admin.search.handler'] = new \Sonata\AdminBundle\Search\SearchHandler($this->get('sonata.admin.pool'));
    }

    /**
     * Gets the public 'sonata.admin.security.handler' shared service.
     *
     * @return \Sonata\AdminBundle\Security\Handler\NoopSecurityHandler
     */
    protected function getSonata_Admin_Security_HandlerService()
    {
        return $this->services['sonata.admin.security.handler'] = new \Sonata\AdminBundle\Security\Handler\NoopSecurityHandler();
    }

    /**
     * Gets the public 'sonata.admin.sidebar_menu' shared service.
     *
     * @return \Knp\Menu\MenuItem
     */
    protected function getSonata_Admin_SidebarMenuService()
    {
        return $this->services['sonata.admin.sidebar_menu'] = $this->get('sonata.admin.menu_builder')->createSidebarMenu();
    }

    /**
     * Gets the public 'sonata.admin.twig.extension' shared service.
     *
     * @return \Sonata\AdminBundle\Twig\Extension\SonataAdminExtension
     */
    protected function getSonata_Admin_Twig_ExtensionService()
    {
        $this->services['sonata.admin.twig.extension'] = $instance = new \Sonata\AdminBundle\Twig\Extension\SonataAdminExtension($this->get('sonata.admin.pool'), $this->get('logger', ContainerInterface::NULL_ON_INVALID_REFERENCE), $this->get('translator'), $this, $this->get('security.authorization_checker'));

        $instance->setXEditableTypeMapping(array('choice' => 'select', 'boolean' => 'select', 'text' => 'text', 'textarea' => 'textarea', 'html' => 'textarea', 'email' => 'email', 'string' => 'text', 'smallint' => 'text', 'bigint' => 'text', 'integer' => 'number', 'decimal' => 'number', 'currency' => 'number', 'percent' => 'number', 'url' => 'url', 'date' => 'date'));

        return $instance;
    }

    /**
     * Gets the public 'sonata.admin.twig.global' shared service.
     *
     * @return \Sonata\AdminBundle\Twig\GlobalVariables
     */
    protected function getSonata_Admin_Twig_GlobalService()
    {
        return $this->services['sonata.admin.twig.global'] = new \Sonata\AdminBundle\Twig\GlobalVariables($this->get('sonata.admin.pool'));
    }

    /**
     * Gets the public 'sonata.admin.validator.inline' shared service.
     *
     * @return \Sonata\CoreBundle\Validator\InlineValidator
     */
    protected function getSonata_Admin_Validator_InlineService()
    {
        return $this->services['sonata.admin.validator.inline'] = new \Sonata\CoreBundle\Validator\InlineValidator($this, $this->get('validator.validator_factory'));
    }

    /**
     * Gets the public 'sonata.block.cache.handler.default' shared service.
     *
     * @return \Sonata\BlockBundle\Cache\HttpCacheHandler
     */
    protected function getSonata_Block_Cache_Handler_DefaultService()
    {
        return $this->services['sonata.block.cache.handler.default'] = new \Sonata\BlockBundle\Cache\HttpCacheHandler();
    }

    /**
     * Gets the public 'sonata.block.cache.handler.noop' shared service.
     *
     * @return \Sonata\BlockBundle\Cache\NoopHttpCacheHandler
     */
    protected function getSonata_Block_Cache_Handler_NoopService()
    {
        return $this->services['sonata.block.cache.handler.noop'] = new \Sonata\BlockBundle\Cache\NoopHttpCacheHandler();
    }

    /**
     * Gets the public 'sonata.block.context_manager.default' shared service.
     *
     * @return \Sonata\BlockBundle\Block\BlockContextManager
     */
    protected function getSonata_Block_ContextManager_DefaultService()
    {
        return $this->services['sonata.block.context_manager.default'] = new \Sonata\BlockBundle\Block\BlockContextManager($this->get('sonata.block.loader.chain'), $this->get('sonata.block.manager'), array('by_type' => array('sonata.admin.block.admin_list' => 'sonata.cache.noop')), $this->get('logger', ContainerInterface::NULL_ON_INVALID_REFERENCE));
    }

    /**
     * Gets the public 'sonata.block.exception.filter.debug_only' shared service.
     *
     * @return \Sonata\BlockBundle\Exception\Filter\DebugOnlyFilter
     */
    protected function getSonata_Block_Exception_Filter_DebugOnlyService()
    {
        return $this->services['sonata.block.exception.filter.debug_only'] = new \Sonata\BlockBundle\Exception\Filter\DebugOnlyFilter(true);
    }

    /**
     * Gets the public 'sonata.block.exception.filter.ignore_block_exception' shared service.
     *
     * @return \Sonata\BlockBundle\Exception\Filter\IgnoreClassFilter
     */
    protected function getSonata_Block_Exception_Filter_IgnoreBlockExceptionService()
    {
        return $this->services['sonata.block.exception.filter.ignore_block_exception'] = new \Sonata\BlockBundle\Exception\Filter\IgnoreClassFilter('Sonata\\BlockBundle\\Exception\\BlockExceptionInterface');
    }

    /**
     * Gets the public 'sonata.block.exception.filter.keep_all' shared service.
     *
     * @return \Sonata\BlockBundle\Exception\Filter\KeepAllFilter
     */
    protected function getSonata_Block_Exception_Filter_KeepAllService()
    {
        return $this->services['sonata.block.exception.filter.keep_all'] = new \Sonata\BlockBundle\Exception\Filter\KeepAllFilter();
    }

    /**
     * Gets the public 'sonata.block.exception.filter.keep_none' shared service.
     *
     * @return \Sonata\BlockBundle\Exception\Filter\KeepNoneFilter
     */
    protected function getSonata_Block_Exception_Filter_KeepNoneService()
    {
        return $this->services['sonata.block.exception.filter.keep_none'] = new \Sonata\BlockBundle\Exception\Filter\KeepNoneFilter();
    }

    /**
     * Gets the public 'sonata.block.exception.renderer.inline' shared service.
     *
     * @return \Sonata\BlockBundle\Exception\Renderer\InlineRenderer
     */
    protected function getSonata_Block_Exception_Renderer_InlineService()
    {
        return $this->services['sonata.block.exception.renderer.inline'] = new \Sonata\BlockBundle\Exception\Renderer\InlineRenderer($this->get('sonata.templating'), '@SonataBlock/Block/block_exception.html.twig');
    }

    /**
     * Gets the public 'sonata.block.exception.renderer.inline_debug' shared service.
     *
     * @return \Sonata\BlockBundle\Exception\Renderer\InlineDebugRenderer
     */
    protected function getSonata_Block_Exception_Renderer_InlineDebugService()
    {
        return $this->services['sonata.block.exception.renderer.inline_debug'] = new \Sonata\BlockBundle\Exception\Renderer\InlineDebugRenderer($this->get('sonata.templating'), '@SonataBlock/Block/block_exception_debug.html.twig', true, true);
    }

    /**
     * Gets the public 'sonata.block.exception.renderer.throw' shared service.
     *
     * @return \Sonata\BlockBundle\Exception\Renderer\MonkeyThrowRenderer
     */
    protected function getSonata_Block_Exception_Renderer_ThrowService()
    {
        return $this->services['sonata.block.exception.renderer.throw'] = new \Sonata\BlockBundle\Exception\Renderer\MonkeyThrowRenderer();
    }

    /**
     * Gets the public 'sonata.block.exception.strategy.manager' shared service.
     *
     * @return \Sonata\BlockBundle\Exception\Strategy\StrategyManager
     */
    protected function getSonata_Block_Exception_Strategy_ManagerService()
    {
        $this->services['sonata.block.exception.strategy.manager'] = $instance = new \Sonata\BlockBundle\Exception\Strategy\StrategyManager($this, array('debug_only' => 'sonata.block.exception.filter.debug_only', 'ignore_block_exception' => 'sonata.block.exception.filter.ignore_block_exception', 'keep_all' => 'sonata.block.exception.filter.keep_all', 'keep_none' => 'sonata.block.exception.filter.keep_none'), array('inline' => 'sonata.block.exception.renderer.inline', 'inline_debug' => 'sonata.block.exception.renderer.inline_debug', 'throw' => 'sonata.block.exception.renderer.throw'), array(), array());

        $instance->setDefaultFilter('debug_only');
        $instance->setDefaultRenderer('throw');

        return $instance;
    }

    /**
     * Gets the public 'sonata.block.form.type.block' shared service.
     *
     * @return \Sonata\BlockBundle\Form\Type\ServiceListType
     */
    protected function getSonata_Block_Form_Type_BlockService()
    {
        return $this->services['sonata.block.form.type.block'] = new \Sonata\BlockBundle\Form\Type\ServiceListType($this->get('sonata.block.manager'));
    }

    /**
     * Gets the public 'sonata.block.form.type.container_template' shared service.
     *
     * @return \Sonata\BlockBundle\Form\Type\ContainerTemplateType
     */
    protected function getSonata_Block_Form_Type_ContainerTemplateService()
    {
        return $this->services['sonata.block.form.type.container_template'] = new \Sonata\BlockBundle\Form\Type\ContainerTemplateType(array('@SonataBlock/Block/block_container.html.twig' => 'SonataBlockBundle default template'));
    }

    /**
     * Gets the public 'sonata.block.loader.chain' shared service.
     *
     * @return \Sonata\BlockBundle\Block\BlockLoaderChain
     */
    protected function getSonata_Block_Loader_ChainService()
    {
        return $this->services['sonata.block.loader.chain'] = new \Sonata\BlockBundle\Block\BlockLoaderChain(array(0 => $this->get('sonata.block.loader.service')));
    }

    /**
     * Gets the public 'sonata.block.loader.service' shared service.
     *
     * @return \Sonata\BlockBundle\Block\Loader\ServiceLoader
     */
    protected function getSonata_Block_Loader_ServiceService()
    {
        return $this->services['sonata.block.loader.service'] = new \Sonata\BlockBundle\Block\Loader\ServiceLoader(array(0 => 'sonata.admin.block.admin_list'));
    }

    /**
     * Gets the public 'sonata.block.manager' shared service.
     *
     * @return \Sonata\BlockBundle\Block\BlockServiceManager
     */
    protected function getSonata_Block_ManagerService()
    {
        $this->services['sonata.block.manager'] = $instance = new \Sonata\BlockBundle\Block\BlockServiceManager($this, true, $this->get('logger', ContainerInterface::NULL_ON_INVALID_REFERENCE));

        $instance->add('sonata.block.service.container', 'sonata.block.service.container', array());
        $instance->add('sonata.block.service.empty', 'sonata.block.service.empty', array());
        $instance->add('sonata.block.service.text', 'sonata.block.service.text', array());
        $instance->add('sonata.block.service.rss', 'sonata.block.service.rss', array());
        $instance->add('sonata.block.service.menu', 'sonata.block.service.menu', array());
        $instance->add('sonata.block.service.template', 'sonata.block.service.template', array());
        $instance->add('sonata.admin.block.admin_list', 'sonata.admin.block.admin_list', array(0 => 'admin'));
        $instance->add('sonata.admin.block.search_result', 'sonata.admin.block.search_result', array());
        $instance->add('sonata.admin.block.stats', 'sonata.admin.block.stats', array());

        return $instance;
    }

    /**
     * Gets the public 'sonata.block.menu.registry' shared service.
     *
     * @return \Sonata\BlockBundle\Menu\MenuRegistry
     */
    protected function getSonata_Block_Menu_RegistryService()
    {
        $this->services['sonata.block.menu.registry'] = $instance = new \Sonata\BlockBundle\Menu\MenuRegistry(array());

        $instance->add('sonata_admin_sidebar');

        return $instance;
    }

    /**
     * Gets the public 'sonata.block.renderer.default' shared service.
     *
     * @return \Sonata\BlockBundle\Block\BlockRenderer
     */
    protected function getSonata_Block_Renderer_DefaultService()
    {
        return $this->services['sonata.block.renderer.default'] = new \Sonata\BlockBundle\Block\BlockRenderer($this->get('sonata.block.manager'), $this->get('sonata.block.exception.strategy.manager'), $this->get('logger', ContainerInterface::NULL_ON_INVALID_REFERENCE), true);
    }

    /**
     * Gets the public 'sonata.block.service.container' shared service.
     *
     * @return \Sonata\BlockBundle\Block\Service\ContainerBlockService
     */
    protected function getSonata_Block_Service_ContainerService()
    {
        return $this->services['sonata.block.service.container'] = new \Sonata\BlockBundle\Block\Service\ContainerBlockService('sonata.block.container', $this->get('sonata.templating'));
    }

    /**
     * Gets the public 'sonata.block.service.empty' shared service.
     *
     * @return \Sonata\BlockBundle\Block\Service\EmptyBlockService
     */
    protected function getSonata_Block_Service_EmptyService()
    {
        return $this->services['sonata.block.service.empty'] = new \Sonata\BlockBundle\Block\Service\EmptyBlockService('sonata.block.empty', $this->get('sonata.templating'));
    }

    /**
     * Gets the public 'sonata.block.service.menu' shared service.
     *
     * @return \Sonata\BlockBundle\Block\Service\MenuBlockService
     */
    protected function getSonata_Block_Service_MenuService()
    {
        return $this->services['sonata.block.service.menu'] = new \Sonata\BlockBundle\Block\Service\MenuBlockService('sonata.block.menu', $this->get('sonata.templating'), $this->get('knp_menu.menu_provider'), $this->get('sonata.block.menu.registry'));
    }

    /**
     * Gets the public 'sonata.block.service.rss' shared service.
     *
     * @return \Sonata\BlockBundle\Block\Service\RssBlockService
     */
    protected function getSonata_Block_Service_RssService()
    {
        return $this->services['sonata.block.service.rss'] = new \Sonata\BlockBundle\Block\Service\RssBlockService('sonata.block.rss', $this->get('sonata.templating'));
    }

    /**
     * Gets the public 'sonata.block.service.template' shared service.
     *
     * @return \Sonata\BlockBundle\Block\Service\TemplateBlockService
     */
    protected function getSonata_Block_Service_TemplateService()
    {
        return $this->services['sonata.block.service.template'] = new \Sonata\BlockBundle\Block\Service\TemplateBlockService('sonata.block.template', $this->get('sonata.templating'));
    }

    /**
     * Gets the public 'sonata.block.service.text' shared service.
     *
     * @return \Sonata\BlockBundle\Block\Service\TextBlockService
     */
    protected function getSonata_Block_Service_TextService()
    {
        return $this->services['sonata.block.service.text'] = new \Sonata\BlockBundle\Block\Service\TextBlockService('sonata.block.text', $this->get('sonata.templating'));
    }

    /**
     * Gets the public 'sonata.block.templating.helper' shared service.
     *
     * @return \Sonata\BlockBundle\Templating\Helper\BlockHelper
     */
    protected function getSonata_Block_Templating_HelperService()
    {
        return $this->services['sonata.block.templating.helper'] = new \Sonata\BlockBundle\Templating\Helper\BlockHelper($this->get('sonata.block.manager'), array('by_type' => array('sonata.admin.block.admin_list' => 'sonata.cache.noop')), $this->get('sonata.block.renderer.default'), $this->get('sonata.block.context_manager.default'), $this->get('debug.event_dispatcher'), NULL, $this->get('sonata.block.cache.handler.default', ContainerInterface::NULL_ON_INVALID_REFERENCE), $this->get('debug.stopwatch', ContainerInterface::NULL_ON_INVALID_REFERENCE));
    }

    /**
     * Gets the public 'sonata.block.twig.global' shared service.
     *
     * @return \Sonata\BlockBundle\Twig\GlobalVariables
     */
    protected function getSonata_Block_Twig_GlobalService()
    {
        return $this->services['sonata.block.twig.global'] = new \Sonata\BlockBundle\Twig\GlobalVariables(array('block_base' => '@SonataBlock/Block/block_base.html.twig', 'block_container' => '@SonataBlock/Block/block_container.html.twig'));
    }

    /**
     * Gets the public 'sonata.core.date.moment_format_converter' shared service.
     *
     * @return \Sonata\CoreBundle\Date\MomentFormatConverter
     */
    protected function getSonata_Core_Date_MomentFormatConverterService()
    {
        return $this->services['sonata.core.date.moment_format_converter'] = new \Sonata\CoreBundle\Date\MomentFormatConverter();
    }

    /**
     * Gets the public 'sonata.core.flashmessage.manager' shared service.
     *
     * @return \Sonata\CoreBundle\FlashMessage\FlashManager
     */
    protected function getSonata_Core_Flashmessage_ManagerService()
    {
        return $this->services['sonata.core.flashmessage.manager'] = new \Sonata\CoreBundle\FlashMessage\FlashManager($this->get('session'), $this->get('translator'), array('success' => array('success' => array('domain' => 'SonataCoreBundle'), 'sonata_flash_success' => array('domain' => 'SonataAdminBundle'), 'sonata_user_success' => array('domain' => 'SonataUserBundle'), 'fos_user_success' => array('domain' => 'FOSUserBundle')), 'warning' => array('warning' => array('domain' => 'SonataCoreBundle'), 'sonata_flash_info' => array('domain' => 'SonataAdminBundle')), 'danger' => array('error' => array('domain' => 'SonataCoreBundle'), 'sonata_flash_error' => array('domain' => 'SonataAdminBundle'), 'sonata_user_error' => array('domain' => 'SonataUserBundle'))), array('success' => 'success', 'warning' => 'warning', 'danger' => 'danger'));
    }

    /**
     * Gets the public 'sonata.core.flashmessage.twig.extension' shared service.
     *
     * @return \Sonata\CoreBundle\Twig\Extension\FlashMessageExtension
     */
    protected function getSonata_Core_Flashmessage_Twig_ExtensionService()
    {
        return $this->services['sonata.core.flashmessage.twig.extension'] = new \Sonata\CoreBundle\Twig\Extension\FlashMessageExtension($this->get('sonata.core.flashmessage.manager'));
    }

    /**
     * Gets the public 'sonata.core.flashmessage.twig.runtime' shared service.
     *
     * @return \Sonata\CoreBundle\Twig\Extension\FlashMessageRuntime
     */
    protected function getSonata_Core_Flashmessage_Twig_RuntimeService()
    {
        return $this->services['sonata.core.flashmessage.twig.runtime'] = new \Sonata\CoreBundle\Twig\Extension\FlashMessageRuntime($this->get('sonata.core.flashmessage.manager'));
    }

    /**
     * Gets the public 'sonata.core.form.type.array' shared service.
     *
     * @return \Sonata\CoreBundle\Form\Type\ImmutableArrayType
     */
    protected function getSonata_Core_Form_Type_ArrayService()
    {
        return $this->services['sonata.core.form.type.array'] = new \Sonata\CoreBundle\Form\Type\ImmutableArrayType();
    }

    /**
     * Gets the public 'sonata.core.form.type.boolean' shared service.
     *
     * @return \Sonata\CoreBundle\Form\Type\BooleanType
     */
    protected function getSonata_Core_Form_Type_BooleanService()
    {
        return $this->services['sonata.core.form.type.boolean'] = new \Sonata\CoreBundle\Form\Type\BooleanType();
    }

    /**
     * Gets the public 'sonata.core.form.type.collection' shared service.
     *
     * @return \Sonata\CoreBundle\Form\Type\CollectionType
     */
    protected function getSonata_Core_Form_Type_CollectionService()
    {
        return $this->services['sonata.core.form.type.collection'] = new \Sonata\CoreBundle\Form\Type\CollectionType();
    }

    /**
     * Gets the public 'sonata.core.form.type.color' shared service.
     *
     * @return \Sonata\CoreBundle\Form\Type\ColorType
     */
    protected function getSonata_Core_Form_Type_ColorService()
    {
        return $this->services['sonata.core.form.type.color'] = new \Sonata\CoreBundle\Form\Type\ColorType();
    }

    /**
     * Gets the public 'sonata.core.form.type.color_selector' shared service.
     *
     * @return \Sonata\CoreBundle\Form\Type\ColorSelectorType
     *
     * @deprecated The "sonata.core.form.type.color_selector" service is deprecated since 3.5 and will be removed in 4.0.
     */
    protected function getSonata_Core_Form_Type_ColorSelectorService()
    {
        @trigger_error('The "sonata.core.form.type.color_selector" service is deprecated since 3.5 and will be removed in 4.0.', E_USER_DEPRECATED);

        return $this->services['sonata.core.form.type.color_selector'] = new \Sonata\CoreBundle\Form\Type\ColorSelectorType();
    }

    /**
     * Gets the public 'sonata.core.form.type.date_picker' shared service.
     *
     * @return \Sonata\CoreBundle\Form\Type\DatePickerType
     */
    protected function getSonata_Core_Form_Type_DatePickerService()
    {
        return $this->services['sonata.core.form.type.date_picker'] = new \Sonata\CoreBundle\Form\Type\DatePickerType($this->get('sonata.core.date.moment_format_converter'), $this->get('translator'));
    }

    /**
     * Gets the public 'sonata.core.form.type.date_range' shared service.
     *
     * @return \Sonata\CoreBundle\Form\Type\DateRangeType
     */
    protected function getSonata_Core_Form_Type_DateRangeService()
    {
        return $this->services['sonata.core.form.type.date_range'] = new \Sonata\CoreBundle\Form\Type\DateRangeType($this->get('translator'));
    }

    /**
     * Gets the public 'sonata.core.form.type.date_range_picker' shared service.
     *
     * @return \Sonata\CoreBundle\Form\Type\DateRangePickerType
     */
    protected function getSonata_Core_Form_Type_DateRangePickerService()
    {
        return $this->services['sonata.core.form.type.date_range_picker'] = new \Sonata\CoreBundle\Form\Type\DateRangePickerType($this->get('translator'));
    }

    /**
     * Gets the public 'sonata.core.form.type.datetime_picker' shared service.
     *
     * @return \Sonata\CoreBundle\Form\Type\DateTimePickerType
     */
    protected function getSonata_Core_Form_Type_DatetimePickerService()
    {
        return $this->services['sonata.core.form.type.datetime_picker'] = new \Sonata\CoreBundle\Form\Type\DateTimePickerType($this->get('sonata.core.date.moment_format_converter'), $this->get('translator'));
    }

    /**
     * Gets the public 'sonata.core.form.type.datetime_range' shared service.
     *
     * @return \Sonata\CoreBundle\Form\Type\DateTimeRangeType
     */
    protected function getSonata_Core_Form_Type_DatetimeRangeService()
    {
        return $this->services['sonata.core.form.type.datetime_range'] = new \Sonata\CoreBundle\Form\Type\DateTimeRangeType($this->get('translator'));
    }

    /**
     * Gets the public 'sonata.core.form.type.datetime_range_picker' shared service.
     *
     * @return \Sonata\CoreBundle\Form\Type\DateTimeRangePickerType
     */
    protected function getSonata_Core_Form_Type_DatetimeRangePickerService()
    {
        return $this->services['sonata.core.form.type.datetime_range_picker'] = new \Sonata\CoreBundle\Form\Type\DateTimeRangePickerType($this->get('translator'));
    }

    /**
     * Gets the public 'sonata.core.form.type.equal' shared service.
     *
     * @return \Sonata\CoreBundle\Form\Type\EqualType
     */
    protected function getSonata_Core_Form_Type_EqualService()
    {
        return $this->services['sonata.core.form.type.equal'] = new \Sonata\CoreBundle\Form\Type\EqualType($this->get('translator'));
    }

    /**
     * Gets the public 'sonata.core.form.type.translatable_choice' shared service.
     *
     * @return \Sonata\CoreBundle\Form\Type\TranslatableChoiceType
     *
     * @deprecated The "sonata.core.form.type.translatable_choice" service is deprecated since 2.2.0 and will be removed in 4.0.
     */
    protected function getSonata_Core_Form_Type_TranslatableChoiceService()
    {
        @trigger_error('The "sonata.core.form.type.translatable_choice" service is deprecated since 2.2.0 and will be removed in 4.0.', E_USER_DEPRECATED);

        return $this->services['sonata.core.form.type.translatable_choice'] = new \Sonata\CoreBundle\Form\Type\TranslatableChoiceType($this->get('translator'));
    }

    /**
     * Gets the public 'sonata.core.model.adapter.chain' shared service.
     *
     * @return \Sonata\CoreBundle\Model\Adapter\AdapterChain
     */
    protected function getSonata_Core_Model_Adapter_ChainService()
    {
        $this->services['sonata.core.model.adapter.chain'] = $instance = new \Sonata\CoreBundle\Model\Adapter\AdapterChain();

        $instance->addAdapter(new \Sonata\CoreBundle\Model\Adapter\DoctrineORMAdapter($this->get('doctrine', ContainerInterface::NULL_ON_INVALID_REFERENCE)));

        return $instance;
    }

    /**
     * Gets the public 'sonata.core.slugify.cocur' shared service.
     *
     * @return \Cocur\Slugify\Slugify
     *
     * @deprecated The "sonata.core.slugify.cocur" service is deprecated. You should stop using it, as it will soon be removed.
     */
    protected function getSonata_Core_Slugify_CocurService()
    {
        @trigger_error('The "sonata.core.slugify.cocur" service is deprecated. You should stop using it, as it will soon be removed.', E_USER_DEPRECATED);

        return $this->services['sonata.core.slugify.cocur'] = new \Cocur\Slugify\Slugify();
    }

    /**
     * Gets the public 'sonata.core.slugify.native' shared service.
     *
     * @return \Sonata\CoreBundle\Component\NativeSlugify
     *
     * @deprecated The "sonata.core.slugify.native" service is deprecated since 2.3 and will be removed in 4.0.
     */
    protected function getSonata_Core_Slugify_NativeService()
    {
        @trigger_error('The "sonata.core.slugify.native" service is deprecated since 2.3 and will be removed in 4.0.', E_USER_DEPRECATED);

        return $this->services['sonata.core.slugify.native'] = new \Sonata\CoreBundle\Component\NativeSlugify();
    }

    /**
     * Gets the public 'sonata.core.twig.deprecated_template_extension' shared service.
     *
     * @return \Sonata\CoreBundle\Twig\Extension\DeprecatedTemplateExtension
     */
    protected function getSonata_Core_Twig_DeprecatedTemplateExtensionService()
    {
        return $this->services['sonata.core.twig.deprecated_template_extension'] = new \Sonata\CoreBundle\Twig\Extension\DeprecatedTemplateExtension();
    }

    /**
     * Gets the public 'sonata.core.twig.extension.text' shared service.
     *
     * @return \Sonata\CoreBundle\Twig\Extension\DeprecatedTextExtension
     */
    protected function getSonata_Core_Twig_Extension_TextService()
    {
        return $this->services['sonata.core.twig.extension.text'] = new \Sonata\CoreBundle\Twig\Extension\DeprecatedTextExtension();
    }

    /**
     * Gets the public 'sonata.core.twig.extension.wrapping' shared service.
     *
     * @return \Sonata\CoreBundle\Twig\Extension\FormTypeExtension
     */
    protected function getSonata_Core_Twig_Extension_WrappingService()
    {
        return $this->services['sonata.core.twig.extension.wrapping'] = new \Sonata\CoreBundle\Twig\Extension\FormTypeExtension('standard');
    }

    /**
     * Gets the public 'sonata.core.twig.status_extension' shared service.
     *
     * @return \Sonata\CoreBundle\Twig\Extension\StatusExtension
     */
    protected function getSonata_Core_Twig_StatusExtensionService()
    {
        $this->services['sonata.core.twig.status_extension'] = $instance = new \Sonata\CoreBundle\Twig\Extension\StatusExtension();

        $instance->addStatusService($this->get('sonata.core.flashmessage.manager'));

        return $instance;
    }

    /**
     * Gets the public 'sonata.core.twig.status_runtime' shared service.
     *
     * @return \Sonata\CoreBundle\Twig\Extension\StatusRuntime
     */
    protected function getSonata_Core_Twig_StatusRuntimeService()
    {
        return $this->services['sonata.core.twig.status_runtime'] = new \Sonata\CoreBundle\Twig\Extension\StatusRuntime();
    }

    /**
     * Gets the public 'sonata.core.twig.template_extension' shared service.
     *
     * @return \Sonata\CoreBundle\Twig\Extension\TemplateExtension
     */
    protected function getSonata_Core_Twig_TemplateExtensionService()
    {
        return $this->services['sonata.core.twig.template_extension'] = new \Sonata\CoreBundle\Twig\Extension\TemplateExtension(true, $this->get('translator'), $this->get('sonata.core.model.adapter.chain'));
    }

    /**
     * Gets the public 'sonata.core.validator.inline' shared service.
     *
     * @return \Sonata\CoreBundle\Validator\InlineValidator
     */
    protected function getSonata_Core_Validator_InlineService()
    {
        return $this->services['sonata.core.validator.inline'] = new \Sonata\CoreBundle\Validator\InlineValidator($this, $this->get('validator.validator_factory'));
    }

    /**
     * Gets the public 'sonata.templating' shared service.
     *
     * @return \Sonata\BlockBundle\Templating\TwigEngine
     */
    protected function getSonata_TemplatingService()
    {
        return $this->services['sonata.templating'] = new \Sonata\BlockBundle\Templating\TwigEngine($this->get('twig'), $this->get('sonata.templating.name_parser'), $this->get('sonata.templating.locator'));
    }

    /**
     * Gets the public 'sonata.templating.locator' shared service.
     *
     * @return \Sonata\BlockBundle\Templating\TemplateLocator
     */
    protected function getSonata_Templating_LocatorService()
    {
        return $this->services['sonata.templating.locator'] = new \Sonata\BlockBundle\Templating\TemplateLocator($this->get('file_locator'), __DIR__);
    }

    /**
     * Gets the public 'sonata.templating.name_parser' shared service.
     *
     * @return \Sonata\BlockBundle\Templating\TemplateNameParser
     */
    protected function getSonata_Templating_NameParserService()
    {
        return $this->services['sonata.templating.name_parser'] = new \Sonata\BlockBundle\Templating\TemplateNameParser($this->get('kernel'));
    }

    /**
     * Gets the public 'sonata\adminbundle\action\dashboardaction' shared service.
     *
     * @return \Sonata\AdminBundle\Action\DashboardAction
     */
    protected function getSonata_Adminbundle_Action_DashboardactionService()
    {
        $this->services['sonata\adminbundle\action\dashboardaction'] = $instance = new \Sonata\AdminBundle\Action\DashboardAction(array(0 => array('position' => 'left', 'settings' => array(), 'type' => 'sonata.admin.block.admin_list', 'roles' => array())), $this->get('sonata.admin.breadcrumbs_builder'), $this->get('sonata.admin.global_template_registry'), $this->get('sonata.admin.pool'));

        $instance->setContainer($this);

        return $instance;
    }

    /**
     * Gets the public 'sonata\adminbundle\action\searchaction' shared service.
     *
     * @return \Sonata\AdminBundle\Action\SearchAction
     */
    protected function getSonata_Adminbundle_Action_SearchactionService()
    {
        $this->services['sonata\adminbundle\action\searchaction'] = $instance = new \Sonata\AdminBundle\Action\SearchAction($this->get('sonata.admin.pool'), $this->get('sonata.admin.search.handler'), $this->get('sonata.admin.global_template_registry'), $this->get('sonata.admin.breadcrumbs_builder'));

        $instance->setContainer($this);

        return $instance;
    }

    /**
     * Gets the public 'sonata\adminbundle\command\createclasscachecommand' shared service.
     *
     * @return \Sonata\AdminBundle\Command\CreateClassCacheCommand
     */
    protected function getSonata_Adminbundle_Command_CreateclasscachecommandService()
    {
        return $this->services['sonata\adminbundle\command\createclasscachecommand'] = new \Sonata\AdminBundle\Command\CreateClassCacheCommand();
    }

    /**
     * Gets the public 'sonata\adminbundle\command\explainadmincommand' shared service.
     *
     * @return \Sonata\AdminBundle\Command\ExplainAdminCommand
     */
    protected function getSonata_Adminbundle_Command_ExplainadmincommandService()
    {
        return $this->services['sonata\adminbundle\command\explainadmincommand'] = new \Sonata\AdminBundle\Command\ExplainAdminCommand();
    }

    /**
     * Gets the public 'sonata\adminbundle\command\generateadmincommand' shared service.
     *
     * @return \Sonata\AdminBundle\Command\GenerateAdminCommand
     */
    protected function getSonata_Adminbundle_Command_GenerateadmincommandService()
    {
        return $this->services['sonata\adminbundle\command\generateadmincommand'] = new \Sonata\AdminBundle\Command\GenerateAdminCommand();
    }

    /**
     * Gets the public 'sonata\adminbundle\command\generateobjectaclcommand' shared service.
     *
     * @return \Sonata\AdminBundle\Command\GenerateObjectAclCommand
     */
    protected function getSonata_Adminbundle_Command_GenerateobjectaclcommandService()
    {
        return $this->services['sonata\adminbundle\command\generateobjectaclcommand'] = new \Sonata\AdminBundle\Command\GenerateObjectAclCommand();
    }

    /**
     * Gets the public 'sonata\adminbundle\command\listadmincommand' shared service.
     *
     * @return \Sonata\AdminBundle\Command\ListAdminCommand
     */
    protected function getSonata_Adminbundle_Command_ListadmincommandService()
    {
        return $this->services['sonata\adminbundle\command\listadmincommand'] = new \Sonata\AdminBundle\Command\ListAdminCommand();
    }

    /**
     * Gets the public 'sonata\adminbundle\command\setupaclcommand' shared service.
     *
     * @return \Sonata\AdminBundle\Command\SetupAclCommand
     */
    protected function getSonata_Adminbundle_Command_SetupaclcommandService()
    {
        return $this->services['sonata\adminbundle\command\setupaclcommand'] = new \Sonata\AdminBundle\Command\SetupAclCommand();
    }

    /**
     * Gets the public 'sonata\blockbundle\command\debugblockscommand' shared service.
     *
     * @return \Sonata\BlockBundle\Command\DebugBlocksCommand
     */
    protected function getSonata_Blockbundle_Command_DebugblockscommandService()
    {
        return $this->services['sonata\blockbundle\command\debugblockscommand'] = new \Sonata\BlockBundle\Command\DebugBlocksCommand();
    }

    /**
     * Gets the public 'sonata\corebundle\command\sonatadumpdoctrinemetacommand' shared service.
     *
     * @return \Sonata\CoreBundle\Command\SonataDumpDoctrineMetaCommand
     */
    protected function getSonata_Corebundle_Command_SonatadumpdoctrinemetacommandService()
    {
        return $this->services['sonata\corebundle\command\sonatadumpdoctrinemetacommand'] = new \Sonata\CoreBundle\Command\SonataDumpDoctrineMetaCommand();
    }

    /**
     * Gets the public 'sonata\corebundle\command\sonatalistformmappingcommand' shared service.
     *
     * @return \Sonata\CoreBundle\Command\SonataListFormMappingCommand
     */
    protected function getSonata_Corebundle_Command_SonatalistformmappingcommandService()
    {
        return $this->services['sonata\corebundle\command\sonatalistformmappingcommand'] = new \Sonata\CoreBundle\Command\SonataListFormMappingCommand();
    }

    /**
     * Gets the public 'streamed_response_listener' shared service.
     *
     * @return \Symfony\Component\HttpKernel\EventListener\StreamedResponseListener
     */
    protected function getStreamedResponseListenerService()
    {
        return $this->services['streamed_response_listener'] = new \Symfony\Component\HttpKernel\EventListener\StreamedResponseListener();
    }

    /**
     * Gets the public 'swiftmailer.email_sender.listener' shared service.
     *
     * @return \Symfony\Bundle\SwiftmailerBundle\EventListener\EmailSenderListener
     */
    protected function getSwiftmailer_EmailSender_ListenerService()
    {
        return $this->services['swiftmailer.email_sender.listener'] = new \Symfony\Bundle\SwiftmailerBundle\EventListener\EmailSenderListener($this, $this->get('logger', ContainerInterface::NULL_ON_INVALID_REFERENCE));
    }

    /**
     * Gets the public 'swiftmailer.mailer.default' shared service.
     *
     * @return \Swift_Mailer
     */
    protected function getSwiftmailer_Mailer_DefaultService()
    {
        return $this->services['swiftmailer.mailer.default'] = new \Swift_Mailer($this->get('swiftmailer.mailer.default.transport'));
    }

    /**
     * Gets the public 'swiftmailer.mailer.default.plugin.messagelogger' shared service.
     *
     * @return \Swift_Plugins_MessageLogger
     */
    protected function getSwiftmailer_Mailer_Default_Plugin_MessageloggerService()
    {
        return $this->services['swiftmailer.mailer.default.plugin.messagelogger'] = new \Swift_Plugins_MessageLogger();
    }

    /**
     * Gets the public 'swiftmailer.mailer.default.spool' shared service.
     *
     * @return \Swift_MemorySpool
     */
    protected function getSwiftmailer_Mailer_Default_SpoolService()
    {
        return $this->services['swiftmailer.mailer.default.spool'] = new \Swift_MemorySpool();
    }

    /**
     * Gets the public 'swiftmailer.mailer.default.transport' shared service.
     *
     * @return \Swift_Transport_SpoolTransport
     */
    protected function getSwiftmailer_Mailer_Default_TransportService()
    {
        $this->services['swiftmailer.mailer.default.transport'] = $instance = new \Swift_Transport_SpoolTransport($this->get('swiftmailer.mailer.default.transport.eventdispatcher'), $this->get('swiftmailer.mailer.default.spool'));

        $instance->registerPlugin($this->get('swiftmailer.mailer.default.plugin.messagelogger'));

        return $instance;
    }

    /**
     * Gets the public 'swiftmailer.mailer.default.transport.real' shared service.
     *
     * @return \Swift_Transport_EsmtpTransport
     */
    protected function getSwiftmailer_Mailer_Default_Transport_RealService()
    {
        $a = new \Swift_Transport_Esmtp_AuthHandler(array(0 => new \Swift_Transport_Esmtp_Auth_CramMd5Authenticator(), 1 => new \Swift_Transport_Esmtp_Auth_LoginAuthenticator(), 2 => new \Swift_Transport_Esmtp_Auth_PlainAuthenticator()));
        $a->setUsername(NULL);
        $a->setPassword(NULL);
        $a->setAuthMode(NULL);

        $this->services['swiftmailer.mailer.default.transport.real'] = $instance = new \Swift_Transport_EsmtpTransport(new \Swift_Transport_StreamBuffer(new \Swift_StreamFilters_StringReplacementFilterFactory()), array(0 => $a), $this->get('swiftmailer.mailer.default.transport.eventdispatcher'));

        $instance->setHost('127.0.0.1');
        $instance->setPort(25);
        $instance->setEncryption(NULL);
        $instance->setTimeout(30);
        $instance->setSourceIp(NULL);
        call_user_func(array(new \Symfony\Bundle\SwiftmailerBundle\DependencyInjection\SmtpTransportConfigurator(NULL, $this->get('router.request_context', ContainerInterface::NULL_ON_INVALID_REFERENCE)), 'configure'), $instance);

        return $instance;
    }

    /**
     * Gets the public 'templating' shared service.
     *
     * @return \Symfony\Bundle\TwigBundle\TwigEngine
     */
    protected function getTemplatingService()
    {
        return $this->services['templating'] = new \Symfony\Bundle\TwigBundle\TwigEngine($this->get('twig'), $this->get('templating.name_parser'), $this->get('templating.locator'));
    }

    /**
     * Gets the public 'templating.filename_parser' shared service.
     *
     * @return \Symfony\Bundle\FrameworkBundle\Templating\TemplateFilenameParser
     */
    protected function getTemplating_FilenameParserService()
    {
        return $this->services['templating.filename_parser'] = new \Symfony\Bundle\FrameworkBundle\Templating\TemplateFilenameParser();
    }

    /**
     * Gets the public 'templating.helper.assets' shared service.
     *
     * @return \Symfony\Bundle\FrameworkBundle\Templating\Helper\AssetsHelper
     */
    protected function getTemplating_Helper_AssetsService()
    {
        return $this->services['templating.helper.assets'] = new \Symfony\Bundle\FrameworkBundle\Templating\Helper\AssetsHelper($this->get('assets.packages'), array());
    }

    /**
     * Gets the public 'templating.helper.logout_url' shared service.
     *
     * @return \Symfony\Bundle\SecurityBundle\Templating\Helper\LogoutUrlHelper
     */
    protected function getTemplating_Helper_LogoutUrlService()
    {
        return $this->services['templating.helper.logout_url'] = new \Symfony\Bundle\SecurityBundle\Templating\Helper\LogoutUrlHelper($this->get('security.logout_url_generator'));
    }

    /**
     * Gets the public 'templating.helper.router' shared service.
     *
     * @return \Symfony\Bundle\FrameworkBundle\Templating\Helper\RouterHelper
     */
    protected function getTemplating_Helper_RouterService()
    {
        return $this->services['templating.helper.router'] = new \Symfony\Bundle\FrameworkBundle\Templating\Helper\RouterHelper($this->get('router'));
    }

    /**
     * Gets the public 'templating.helper.security' shared service.
     *
     * @return \Symfony\Bundle\SecurityBundle\Templating\Helper\SecurityHelper
     */
    protected function getTemplating_Helper_SecurityService()
    {
        return $this->services['templating.helper.security'] = new \Symfony\Bundle\SecurityBundle\Templating\Helper\SecurityHelper($this->get('security.authorization_checker', ContainerInterface::NULL_ON_INVALID_REFERENCE));
    }

    /**
     * Gets the public 'templating.loader' shared service.
     *
     * @return \Symfony\Bundle\FrameworkBundle\Templating\Loader\FilesystemLoader
     */
    protected function getTemplating_LoaderService()
    {
        return $this->services['templating.loader'] = new \Symfony\Bundle\FrameworkBundle\Templating\Loader\FilesystemLoader($this->get('templating.locator'));
    }

    /**
     * Gets the public 'templating.name_parser' shared service.
     *
     * @return \Symfony\Bundle\FrameworkBundle\Templating\TemplateNameParser
     */
    protected function getTemplating_NameParserService()
    {
        return $this->services['templating.name_parser'] = new \Symfony\Bundle\FrameworkBundle\Templating\TemplateNameParser($this->get('kernel'));
    }

    /**
     * Gets the public 'translation.dumper.csv' shared service.
     *
     * @return \Symfony\Component\Translation\Dumper\CsvFileDumper
     */
    protected function getTranslation_Dumper_CsvService()
    {
        return $this->services['translation.dumper.csv'] = new \Symfony\Component\Translation\Dumper\CsvFileDumper();
    }

    /**
     * Gets the public 'translation.dumper.ini' shared service.
     *
     * @return \Symfony\Component\Translation\Dumper\IniFileDumper
     */
    protected function getTranslation_Dumper_IniService()
    {
        return $this->services['translation.dumper.ini'] = new \Symfony\Component\Translation\Dumper\IniFileDumper();
    }

    /**
     * Gets the public 'translation.dumper.json' shared service.
     *
     * @return \Symfony\Component\Translation\Dumper\JsonFileDumper
     */
    protected function getTranslation_Dumper_JsonService()
    {
        return $this->services['translation.dumper.json'] = new \Symfony\Component\Translation\Dumper\JsonFileDumper();
    }

    /**
     * Gets the public 'translation.dumper.mo' shared service.
     *
     * @return \Symfony\Component\Translation\Dumper\MoFileDumper
     */
    protected function getTranslation_Dumper_MoService()
    {
        return $this->services['translation.dumper.mo'] = new \Symfony\Component\Translation\Dumper\MoFileDumper();
    }

    /**
     * Gets the public 'translation.dumper.php' shared service.
     *
     * @return \Symfony\Component\Translation\Dumper\PhpFileDumper
     */
    protected function getTranslation_Dumper_PhpService()
    {
        return $this->services['translation.dumper.php'] = new \Symfony\Component\Translation\Dumper\PhpFileDumper();
    }

    /**
     * Gets the public 'translation.dumper.po' shared service.
     *
     * @return \Symfony\Component\Translation\Dumper\PoFileDumper
     */
    protected function getTranslation_Dumper_PoService()
    {
        return $this->services['translation.dumper.po'] = new \Symfony\Component\Translation\Dumper\PoFileDumper();
    }

    /**
     * Gets the public 'translation.dumper.qt' shared service.
     *
     * @return \Symfony\Component\Translation\Dumper\QtFileDumper
     */
    protected function getTranslation_Dumper_QtService()
    {
        return $this->services['translation.dumper.qt'] = new \Symfony\Component\Translation\Dumper\QtFileDumper();
    }

    /**
     * Gets the public 'translation.dumper.res' shared service.
     *
     * @return \Symfony\Component\Translation\Dumper\IcuResFileDumper
     */
    protected function getTranslation_Dumper_ResService()
    {
        return $this->services['translation.dumper.res'] = new \Symfony\Component\Translation\Dumper\IcuResFileDumper();
    }

    /**
     * Gets the public 'translation.dumper.xliff' shared service.
     *
     * @return \Symfony\Component\Translation\Dumper\XliffFileDumper
     */
    protected function getTranslation_Dumper_XliffService()
    {
        return $this->services['translation.dumper.xliff'] = new \Symfony\Component\Translation\Dumper\XliffFileDumper();
    }

    /**
     * Gets the public 'translation.dumper.yml' shared service.
     *
     * @return \Symfony\Component\Translation\Dumper\YamlFileDumper
     */
    protected function getTranslation_Dumper_YmlService()
    {
        return $this->services['translation.dumper.yml'] = new \Symfony\Component\Translation\Dumper\YamlFileDumper();
    }

    /**
     * Gets the public 'translation.extractor' shared service.
     *
     * @return \Symfony\Component\Translation\Extractor\ChainExtractor
     */
    protected function getTranslation_ExtractorService()
    {
        $this->services['translation.extractor'] = $instance = new \Symfony\Component\Translation\Extractor\ChainExtractor();

        $instance->addExtractor('php', $this->get('translation.extractor.php'));
        $instance->addExtractor('twig', $this->get('twig.translation.extractor'));

        return $instance;
    }

    /**
     * Gets the public 'translation.extractor.php' shared service.
     *
     * @return \Symfony\Bundle\FrameworkBundle\Translation\PhpExtractor
     */
    protected function getTranslation_Extractor_PhpService()
    {
        return $this->services['translation.extractor.php'] = new \Symfony\Bundle\FrameworkBundle\Translation\PhpExtractor();
    }

    /**
     * Gets the public 'translation.loader' shared service.
     *
     * @return \Symfony\Bundle\FrameworkBundle\Translation\TranslationLoader
     */
    protected function getTranslation_LoaderService()
    {
        $a = $this->get('translation.loader.xliff');

        $this->services['translation.loader'] = $instance = new \Symfony\Bundle\FrameworkBundle\Translation\TranslationLoader();

        $instance->addLoader('php', $this->get('translation.loader.php'));
        $instance->addLoader('yml', $this->get('translation.loader.yml'));
        $instance->addLoader('xlf', $a);
        $instance->addLoader('xliff', $a);
        $instance->addLoader('po', $this->get('translation.loader.po'));
        $instance->addLoader('mo', $this->get('translation.loader.mo'));
        $instance->addLoader('ts', $this->get('translation.loader.qt'));
        $instance->addLoader('csv', $this->get('translation.loader.csv'));
        $instance->addLoader('res', $this->get('translation.loader.res'));
        $instance->addLoader('dat', $this->get('translation.loader.dat'));
        $instance->addLoader('ini', $this->get('translation.loader.ini'));
        $instance->addLoader('json', $this->get('translation.loader.json'));

        return $instance;
    }

    /**
     * Gets the public 'translation.loader.csv' shared service.
     *
     * @return \Symfony\Component\Translation\Loader\CsvFileLoader
     */
    protected function getTranslation_Loader_CsvService()
    {
        return $this->services['translation.loader.csv'] = new \Symfony\Component\Translation\Loader\CsvFileLoader();
    }

    /**
     * Gets the public 'translation.loader.dat' shared service.
     *
     * @return \Symfony\Component\Translation\Loader\IcuDatFileLoader
     */
    protected function getTranslation_Loader_DatService()
    {
        return $this->services['translation.loader.dat'] = new \Symfony\Component\Translation\Loader\IcuDatFileLoader();
    }

    /**
     * Gets the public 'translation.loader.ini' shared service.
     *
     * @return \Symfony\Component\Translation\Loader\IniFileLoader
     */
    protected function getTranslation_Loader_IniService()
    {
        return $this->services['translation.loader.ini'] = new \Symfony\Component\Translation\Loader\IniFileLoader();
    }

    /**
     * Gets the public 'translation.loader.json' shared service.
     *
     * @return \Symfony\Component\Translation\Loader\JsonFileLoader
     */
    protected function getTranslation_Loader_JsonService()
    {
        return $this->services['translation.loader.json'] = new \Symfony\Component\Translation\Loader\JsonFileLoader();
    }

    /**
     * Gets the public 'translation.loader.mo' shared service.
     *
     * @return \Symfony\Component\Translation\Loader\MoFileLoader
     */
    protected function getTranslation_Loader_MoService()
    {
        return $this->services['translation.loader.mo'] = new \Symfony\Component\Translation\Loader\MoFileLoader();
    }

    /**
     * Gets the public 'translation.loader.php' shared service.
     *
     * @return \Symfony\Component\Translation\Loader\PhpFileLoader
     */
    protected function getTranslation_Loader_PhpService()
    {
        return $this->services['translation.loader.php'] = new \Symfony\Component\Translation\Loader\PhpFileLoader();
    }

    /**
     * Gets the public 'translation.loader.po' shared service.
     *
     * @return \Symfony\Component\Translation\Loader\PoFileLoader
     */
    protected function getTranslation_Loader_PoService()
    {
        return $this->services['translation.loader.po'] = new \Symfony\Component\Translation\Loader\PoFileLoader();
    }

    /**
     * Gets the public 'translation.loader.qt' shared service.
     *
     * @return \Symfony\Component\Translation\Loader\QtFileLoader
     */
    protected function getTranslation_Loader_QtService()
    {
        return $this->services['translation.loader.qt'] = new \Symfony\Component\Translation\Loader\QtFileLoader();
    }

    /**
     * Gets the public 'translation.loader.res' shared service.
     *
     * @return \Symfony\Component\Translation\Loader\IcuResFileLoader
     */
    protected function getTranslation_Loader_ResService()
    {
        return $this->services['translation.loader.res'] = new \Symfony\Component\Translation\Loader\IcuResFileLoader();
    }

    /**
     * Gets the public 'translation.loader.xliff' shared service.
     *
     * @return \Symfony\Component\Translation\Loader\XliffFileLoader
     */
    protected function getTranslation_Loader_XliffService()
    {
        return $this->services['translation.loader.xliff'] = new \Symfony\Component\Translation\Loader\XliffFileLoader();
    }

    /**
     * Gets the public 'translation.loader.yml' shared service.
     *
     * @return \Symfony\Component\Translation\Loader\YamlFileLoader
     */
    protected function getTranslation_Loader_YmlService()
    {
        return $this->services['translation.loader.yml'] = new \Symfony\Component\Translation\Loader\YamlFileLoader();
    }

    /**
     * Gets the public 'translation.writer' shared service.
     *
     * @return \Symfony\Component\Translation\Writer\TranslationWriter
     */
    protected function getTranslation_WriterService()
    {
        $this->services['translation.writer'] = $instance = new \Symfony\Component\Translation\Writer\TranslationWriter();

        $instance->addDumper('php', $this->get('translation.dumper.php'));
        $instance->addDumper('xlf', $this->get('translation.dumper.xliff'));
        $instance->addDumper('po', $this->get('translation.dumper.po'));
        $instance->addDumper('mo', $this->get('translation.dumper.mo'));
        $instance->addDumper('yml', $this->get('translation.dumper.yml'));
        $instance->addDumper('ts', $this->get('translation.dumper.qt'));
        $instance->addDumper('csv', $this->get('translation.dumper.csv'));
        $instance->addDumper('ini', $this->get('translation.dumper.ini'));
        $instance->addDumper('json', $this->get('translation.dumper.json'));
        $instance->addDumper('res', $this->get('translation.dumper.res'));

        return $instance;
    }

    /**
     * Gets the public 'translator' shared service.
     *
     * @return \Symfony\Component\Translation\DataCollectorTranslator
     */
    protected function getTranslatorService()
    {
        return $this->services['translator'] = new \Symfony\Component\Translation\DataCollectorTranslator(new \Symfony\Component\Translation\LoggingTranslator($this->get('translator.default'), $this->get('monolog.logger.translation')));
    }

    /**
     * Gets the public 'translator.default' shared service.
     *
     * @return \Symfony\Bundle\FrameworkBundle\Translation\Translator
     */
    protected function getTranslator_DefaultService()
    {
        $this->services['translator.default'] = $instance = new \Symfony\Bundle\FrameworkBundle\Translation\Translator($this, new \Symfony\Component\Translation\MessageSelector(), array('translation.loader.php' => array(0 => 'php'), 'translation.loader.yml' => array(0 => 'yml'), 'translation.loader.xliff' => array(0 => 'xlf', 1 => 'xliff'), 'translation.loader.po' => array(0 => 'po'), 'translation.loader.mo' => array(0 => 'mo'), 'translation.loader.qt' => array(0 => 'ts'), 'translation.loader.csv' => array(0 => 'csv'), 'translation.loader.res' => array(0 => 'res'), 'translation.loader.dat' => array(0 => 'dat'), 'translation.loader.ini' => array(0 => 'ini'), 'translation.loader.json' => array(0 => 'json')), array('cache_dir' => (__DIR__.'/translations'), 'debug' => true, 'resource_files' => array('bg' => array(0 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.bg.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.bg.xlf'), 2 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Resources/translations/security.bg.xlf'), 3 => ($this->targetDirs[3].'/vendor/sonata-project/core-bundle/src/Resources/translations/SonataCoreBundle.bg.xliff'), 4 => ($this->targetDirs[3].'/vendor/sonata-project/admin-bundle/src/Resources/translations/SonataAdminBundle.bg.xliff')), 'ru' => array(0 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.ru.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.ru.xlf'), 2 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Resources/translations/security.ru.xlf'), 3 => ($this->targetDirs[3].'/vendor/sonata-project/core-bundle/src/Resources/translations/SonataCoreBundle.ru.xliff'), 4 => ($this->targetDirs[3].'/vendor/sonata-project/block-bundle/src/Resources/translations/SonataBlockBundle.ru.xliff'), 5 => ($this->targetDirs[3].'/vendor/sonata-project/admin-bundle/src/Resources/translations/SonataAdminBundle.ru.xliff')), 'ca' => array(0 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.ca.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.ca.xlf'), 2 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Resources/translations/security.ca.xlf'), 3 => ($this->targetDirs[3].'/vendor/sonata-project/core-bundle/src/Resources/translations/SonataCoreBundle.ca.xliff'), 4 => ($this->targetDirs[3].'/vendor/sonata-project/admin-bundle/src/Resources/translations/SonataAdminBundle.ca.xliff')), 'he' => array(0 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.he.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.he.xlf'), 2 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Resources/translations/security.he.xlf')), 'hy' => array(0 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.hy.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.hy.xlf')), 'tl' => array(0 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.tl.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.tl.xlf'), 2 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Resources/translations/security.tl.xlf')), 'ar' => array(0 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.ar.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.ar.xlf'), 2 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Resources/translations/security.ar.xlf'), 3 => ($this->targetDirs[3].'/vendor/sonata-project/core-bundle/src/Resources/translations/SonataCoreBundle.ar.xliff'), 4 => ($this->targetDirs[3].'/vendor/sonata-project/admin-bundle/src/Resources/translations/SonataAdminBundle.ar.xliff')), 'et' => array(0 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.et.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.et.xlf')), 'zh_TW' => array(0 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.zh_TW.xlf')), 'pl' => array(0 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.pl.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.pl.xlf'), 2 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Resources/translations/security.pl.xlf'), 3 => ($this->targetDirs[3].'/vendor/sonata-project/core-bundle/src/Resources/translations/SonataCoreBundle.pl.xliff'), 4 => ($this->targetDirs[3].'/vendor/sonata-project/admin-bundle/src/Resources/translations/SonataAdminBundle.pl.xliff')), 'nn' => array(0 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.nn.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.nn.xlf'), 2 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Resources/translations/security.nn.xlf')), 'da' => array(0 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.da.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.da.xlf'), 2 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Resources/translations/security.da.xlf')), 'hr' => array(0 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.hr.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.hr.xlf'), 2 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Resources/translations/security.hr.xlf'), 3 => ($this->targetDirs[3].'/vendor/sonata-project/core-bundle/src/Resources/translations/SonataCoreBundle.hr.xliff'), 4 => ($this->targetDirs[3].'/vendor/sonata-project/admin-bundle/src/Resources/translations/SonataAdminBundle.hr.xliff')), 'nb' => array(0 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.nb.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.nb.xlf'), 2 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Resources/translations/security.nb.xlf')), 'sv' => array(0 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.sv.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.sv.xlf'), 2 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Resources/translations/security.sv.xlf')), 'gl' => array(0 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.gl.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.gl.xlf'), 2 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Resources/translations/security.gl.xlf')), 'lb' => array(0 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.lb.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.lb.xlf'), 2 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Resources/translations/security.lb.xlf'), 3 => ($this->targetDirs[3].'/vendor/sonata-project/core-bundle/src/Resources/translations/SonataCoreBundle.lb.xliff'), 4 => ($this->targetDirs[3].'/vendor/sonata-project/admin-bundle/src/Resources/translations/SonataAdminBundle.lb.xliff')), 'el' => array(0 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.el.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.el.xlf'), 2 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Resources/translations/security.el.xlf')), 'es' => array(0 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.es.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.es.xlf'), 2 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Resources/translations/security.es.xlf'), 3 => ($this->targetDirs[3].'/vendor/sonata-project/core-bundle/src/Resources/translations/SonataCoreBundle.es.xliff'), 4 => ($this->targetDirs[3].'/vendor/sonata-project/admin-bundle/src/Resources/translations/SonataAdminBundle.es.xliff')), 'az' => array(0 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.az.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.az.xlf'), 2 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Resources/translations/security.az.xlf')), 'sk' => array(0 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.sk.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.sk.xlf'), 2 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Resources/translations/security.sk.xlf'), 3 => ($this->targetDirs[3].'/vendor/sonata-project/core-bundle/src/Resources/translations/SonataCoreBundle.sk.xliff'), 4 => ($this->targetDirs[3].'/vendor/sonata-project/admin-bundle/src/Resources/translations/SonataAdminBundle.sk.xliff')), 'mn' => array(0 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.mn.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.mn.xlf')), 'sr_Latn' => array(0 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.sr_Latn.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.sr_Latn.xlf'), 2 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Resources/translations/security.sr_Latn.xlf')), 'eu' => array(0 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.eu.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.eu.xlf'), 2 => ($this->targetDirs[3].'/vendor/sonata-project/core-bundle/src/Resources/translations/SonataCoreBundle.eu.xliff'), 3 => ($this->targetDirs[3].'/vendor/sonata-project/admin-bundle/src/Resources/translations/SonataAdminBundle.eu.xliff')), 'fa' => array(0 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.fa.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.fa.xlf'), 2 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Resources/translations/security.fa.xlf'), 3 => ($this->targetDirs[3].'/vendor/sonata-project/core-bundle/src/Resources/translations/SonataCoreBundle.fa.xliff'), 4 => ($this->targetDirs[3].'/vendor/sonata-project/admin-bundle/src/Resources/translations/SonataAdminBundle.fa.xliff')), 'zh_CN' => array(0 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.zh_CN.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.zh_CN.xlf'), 2 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Resources/translations/security.zh_CN.xlf'), 3 => ($this->targetDirs[3].'/vendor/sonata-project/core-bundle/src/Resources/translations/SonataCoreBundle.zh_CN.xliff'), 4 => ($this->targetDirs[3].'/vendor/sonata-project/admin-bundle/src/Resources/translations/SonataAdminBundle.zh_CN.xliff')), 'pt' => array(0 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.pt.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.pt.xlf'), 2 => ($this->targetDirs[3].'/vendor/sonata-project/core-bundle/src/Resources/translations/SonataCoreBundle.pt.xliff'), 3 => ($this->targetDirs[3].'/vendor/sonata-project/admin-bundle/src/Resources/translations/SonataAdminBundle.pt.xliff')), 'ja' => array(0 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.ja.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.ja.xlf'), 2 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Resources/translations/security.ja.xlf'), 3 => ($this->targetDirs[3].'/vendor/sonata-project/core-bundle/src/Resources/translations/SonataCoreBundle.ja.xliff'), 4 => ($this->targetDirs[3].'/vendor/sonata-project/admin-bundle/src/Resources/translations/SonataAdminBundle.ja.xliff')), 'hu' => array(0 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.hu.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.hu.xlf'), 2 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Resources/translations/security.hu.xlf'), 3 => ($this->targetDirs[3].'/vendor/sonata-project/core-bundle/src/Resources/translations/SonataCoreBundle.hu.xliff'), 4 => ($this->targetDirs[3].'/vendor/sonata-project/block-bundle/src/Resources/translations/SonataBlockBundle.hu.xliff'), 5 => ($this->targetDirs[3].'/vendor/sonata-project/admin-bundle/src/Resources/translations/SonataAdminBundle.hu.xliff')), 'fi' => array(0 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.fi.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.fi.xlf'), 2 => ($this->targetDirs[3].'/vendor/sonata-project/core-bundle/src/Resources/translations/SonataCoreBundle.fi.xliff')), 'lv' => array(0 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.lv.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.lv.xlf'), 2 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Resources/translations/security.lv.xlf'), 3 => ($this->targetDirs[3].'/vendor/sonata-project/admin-bundle/src/Resources/translations/SonataAdminBundle.lv.xliff')), 'vi' => array(0 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.vi.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Resources/translations/security.vi.xlf')), 'cs' => array(0 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.cs.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.cs.xlf'), 2 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Resources/translations/security.cs.xlf'), 3 => ($this->targetDirs[3].'/vendor/sonata-project/core-bundle/src/Resources/translations/SonataCoreBundle.cs.xliff'), 4 => ($this->targetDirs[3].'/vendor/sonata-project/admin-bundle/src/Resources/translations/SonataAdminBundle.cs.xliff')), 'cy' => array(0 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.cy.xlf')), 'uk' => array(0 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.uk.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.uk.xlf'), 2 => ($this->targetDirs[3].'/vendor/sonata-project/core-bundle/src/Resources/translations/SonataCoreBundle.uk.xliff'), 3 => ($this->targetDirs[3].'/vendor/sonata-project/admin-bundle/src/Resources/translations/SonataAdminBundle.uk.xliff')), 'fr' => array(0 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.fr.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.fr.xlf'), 2 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Resources/translations/security.fr.xlf'), 3 => ($this->targetDirs[3].'/src/Sch/MainBundle/Resources/translations/messages.fr.xlf'), 4 => ($this->targetDirs[3].'/vendor/sonata-project/core-bundle/src/Resources/translations/SonataCoreBundle.fr.xliff'), 5 => ($this->targetDirs[3].'/vendor/sonata-project/block-bundle/src/Resources/translations/SonataBlockBundle.fr.xliff'), 6 => ($this->targetDirs[3].'/vendor/sonata-project/block-bundle/src/Resources/translations/validators.fr.xliff'), 7 => ($this->targetDirs[3].'/vendor/sonata-project/admin-bundle/src/Resources/translations/SonataAdminBundle.fr.xliff'), 8 => ($this->targetDirs[2].'/Resources/translations/messages.fr.yml'), 9 => ($this->targetDirs[2].'/Resources/translations/messages.fr.xlf')), 'de' => array(0 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.de.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.de.xlf'), 2 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Resources/translations/security.de.xlf'), 3 => ($this->targetDirs[3].'/vendor/sonata-project/core-bundle/src/Resources/translations/SonataCoreBundle.de.xliff'), 4 => ($this->targetDirs[3].'/vendor/sonata-project/block-bundle/src/Resources/translations/validators.de.xliff'), 5 => ($this->targetDirs[3].'/vendor/sonata-project/block-bundle/src/Resources/translations/SonataBlockBundle.de.xliff'), 6 => ($this->targetDirs[3].'/vendor/sonata-project/admin-bundle/src/Resources/translations/SonataAdminBundle.de.xliff')), 'pt_BR' => array(0 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.pt_BR.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.pt_BR.xlf'), 2 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Resources/translations/security.pt_BR.xlf'), 3 => ($this->targetDirs[3].'/vendor/sonata-project/core-bundle/src/Resources/translations/SonataCoreBundle.pt_BR.xliff'), 4 => ($this->targetDirs[3].'/vendor/sonata-project/admin-bundle/src/Resources/translations/SonataAdminBundle.pt_BR.xliff')), 'tr' => array(0 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.tr.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Resources/translations/security.tr.xlf'), 2 => ($this->targetDirs[3].'/vendor/sonata-project/admin-bundle/src/Resources/translations/SonataAdminBundle.tr.xliff')), 'id' => array(0 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.id.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.id.xlf'), 2 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Resources/translations/security.id.xlf')), 'sq' => array(0 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.sq.xlf')), 'th' => array(0 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.th.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Resources/translations/security.th.xlf')), 'it' => array(0 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.it.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.it.xlf'), 2 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Resources/translations/security.it.xlf'), 3 => ($this->targetDirs[3].'/vendor/sonata-project/core-bundle/src/Resources/translations/SonataCoreBundle.it.xliff'), 4 => ($this->targetDirs[3].'/vendor/sonata-project/block-bundle/src/Resources/translations/SonataBlockBundle.it.xliff'), 5 => ($this->targetDirs[3].'/vendor/sonata-project/admin-bundle/src/Resources/translations/SonataAdminBundle.it.xliff')), 'lt' => array(0 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.lt.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.lt.xlf'), 2 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Resources/translations/security.lt.xlf'), 3 => ($this->targetDirs[3].'/vendor/sonata-project/core-bundle/src/Resources/translations/SonataCoreBundle.lt.xliff'), 4 => ($this->targetDirs[3].'/vendor/sonata-project/admin-bundle/src/Resources/translations/SonataAdminBundle.lt.xliff')), 'ro' => array(0 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.ro.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.ro.xlf'), 2 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Resources/translations/security.ro.xlf'), 3 => ($this->targetDirs[3].'/vendor/sonata-project/core-bundle/src/Resources/translations/SonataCoreBundle.ro.xliff'), 4 => ($this->targetDirs[3].'/vendor/sonata-project/admin-bundle/src/Resources/translations/SonataAdminBundle.ro.xliff')), 'en' => array(0 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.en.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.en.xlf'), 2 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Resources/translations/security.en.xlf'), 3 => ($this->targetDirs[3].'/src/Sch/MainBundle/Resources/translations/messages.en.yml'), 4 => ($this->targetDirs[3].'/vendor/sonata-project/core-bundle/src/Resources/translations/SonataCoreBundle.en.xliff'), 5 => ($this->targetDirs[3].'/vendor/sonata-project/block-bundle/src/Resources/translations/SonataBlockBundle.en.xliff'), 6 => ($this->targetDirs[3].'/vendor/sonata-project/block-bundle/src/Resources/translations/validators.en.xliff'), 7 => ($this->targetDirs[3].'/vendor/sonata-project/admin-bundle/src/Resources/translations/SonataAdminBundle.en.xliff'), 8 => ($this->targetDirs[2].'/Resources/translations/messages.en.xliff')), 'no' => array(0 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.no.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.no.xlf'), 2 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Resources/translations/security.no.xlf'), 3 => ($this->targetDirs[3].'/vendor/sonata-project/admin-bundle/src/Resources/translations/SonataAdminBundle.no.xliff')), 'sr_Cyrl' => array(0 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.sr_Cyrl.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.sr_Cyrl.xlf'), 2 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Resources/translations/security.sr_Cyrl.xlf')), 'af' => array(0 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.af.xlf')), 'nl' => array(0 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.nl.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.nl.xlf'), 2 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Resources/translations/security.nl.xlf'), 3 => ($this->targetDirs[3].'/vendor/sonata-project/core-bundle/src/Resources/translations/SonataCoreBundle.nl.xliff'), 4 => ($this->targetDirs[3].'/vendor/sonata-project/admin-bundle/src/Resources/translations/SonataAdminBundle.nl.xliff')), 'sl' => array(0 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Validator/Resources/translations/validators.sl.xlf'), 1 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/translations/validators.sl.xlf'), 2 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Resources/translations/security.sl.xlf'), 3 => ($this->targetDirs[3].'/vendor/sonata-project/core-bundle/src/Resources/translations/SonataCoreBundle.sl.xliff'), 4 => ($this->targetDirs[3].'/vendor/sonata-project/admin-bundle/src/Resources/translations/SonataAdminBundle.sl.xliff')), 'ua' => array(0 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Resources/translations/security.ua.xlf')), 'pt_PT' => array(0 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Security/Core/Resources/translations/security.pt_PT.xlf')), 'zh_HK' => array(0 => ($this->targetDirs[3].'/vendor/sonata-project/admin-bundle/src/Resources/translations/SonataAdminBundle.zh_HK.xliff')), 'sv_SE' => array(0 => ($this->targetDirs[3].'/vendor/sonata-project/admin-bundle/src/Resources/translations/SonataAdminBundle.sv_SE.xliff')))), array());

        $instance->setConfigCacheFactory($this->get('config_cache_factory'));
        $instance->setFallbackLocales(array(0 => 'en'));

        return $instance;
    }

    /**
     * Gets the public 'translator_listener' shared service.
     *
     * @return \Symfony\Component\HttpKernel\EventListener\TranslatorListener
     */
    protected function getTranslatorListenerService()
    {
        return $this->services['translator_listener'] = new \Symfony\Component\HttpKernel\EventListener\TranslatorListener($this->get('translator'), $this->get('request_stack'));
    }

    /**
     * Gets the public 'twig' shared service.
     *
     * @return \Twig\Environment
     */
    protected function getTwigService()
    {
        $a = $this->get('debug.stopwatch', ContainerInterface::NULL_ON_INVALID_REFERENCE);
        $b = $this->get('request_stack');
        $c = $this->get('router.request_context', ContainerInterface::NULL_ON_INVALID_REFERENCE);
        $d = $this->get('fragment.handler');
        $e = $this->get('knp_menu.matcher');

        $f = new \Symfony\Bridge\Twig\Extension\HttpFoundationExtension($b, $c);

        $g = new \Knp\Menu\Util\MenuManipulator();

        $h = new \Symfony\Bridge\Twig\AppVariable();
        $h->setEnvironment('dev');
        $h->setDebug(true);
        if ($this->has('security.token_storage')) {
            $h->setTokenStorage($this->get('security.token_storage', ContainerInterface::NULL_ON_INVALID_REFERENCE));
        }
        if ($this->has('request_stack')) {
            $h->setRequestStack($b);
        }
        $h->setContainer($this);

        $this->services['twig'] = $instance = new \Twig\Environment($this->get('twig.loader'), array('paths' => array(($this->targetDirs[3].'/vendor/knplabs/knp-menu/src/Knp/Menu/Resources/views') => NULL), 'debug' => true, 'strict_variables' => true, 'exception_controller' => 'twig.controller.exception:showAction', 'form_themes' => array(0 => 'form_div_layout.html.twig'), 'autoescape' => 'name', 'cache' => (__DIR__.'/twig'), 'charset' => 'UTF-8', 'date' => array('format' => 'F j, Y H:i', 'interval_format' => '%d days', 'timezone' => NULL), 'number_format' => array('decimals' => 0, 'decimal_point' => '.', 'thousands_separator' => ',')));

        $instance->addExtension(new \Symfony\Bridge\Twig\Extension\LogoutUrlExtension($this->get('security.logout_url_generator')));
        $instance->addExtension(new \Symfony\Bridge\Twig\Extension\SecurityExtension($this->get('security.authorization_checker', ContainerInterface::NULL_ON_INVALID_REFERENCE)));
        $instance->addExtension(new \Symfony\Bridge\Twig\Extension\ProfilerExtension($this->get('twig.profile'), $a));
        $instance->addExtension(new \Symfony\Bridge\Twig\Extension\TranslationExtension($this->get('translator')));
        $instance->addExtension(new \Symfony\Bridge\Twig\Extension\AssetExtension($this->get('assets.packages'), $f));
        $instance->addExtension(new \Symfony\Bundle\TwigBundle\Extension\ActionsExtension($d));
        $instance->addExtension(new \Symfony\Bridge\Twig\Extension\CodeExtension(NULL, $this->targetDirs[2], 'UTF-8'));
        $instance->addExtension(new \Symfony\Bridge\Twig\Extension\RoutingExtension($this->get('router')));
        $instance->addExtension(new \Symfony\Bridge\Twig\Extension\YamlExtension());
        $instance->addExtension(new \Symfony\Bridge\Twig\Extension\StopwatchExtension($a, true));
        $instance->addExtension(new \Symfony\Bridge\Twig\Extension\ExpressionExtension());
        $instance->addExtension(new \Symfony\Bridge\Twig\Extension\HttpKernelExtension($d));
        $instance->addExtension($f);
        $instance->addExtension(new \Symfony\Bridge\Twig\Extension\FormExtension(new \Symfony\Bridge\Twig\Form\TwigRenderer(new \Symfony\Bridge\Twig\Form\TwigRendererEngine(array(0 => 'form_div_layout.html.twig')), $this->get('security.csrf.token_manager', ContainerInterface::NULL_ON_INVALID_REFERENCE))));
        $instance->addExtension(new \Doctrine\Bundle\DoctrineBundle\Twig\DoctrineExtension());
        $instance->addExtension($this->get('nelmio_api_doc.twig.extension.extra_markdown'));
        $instance->addExtension(new \JMS\Serializer\Twig\SerializerExtension($this->get('jms_serializer')));
        $instance->addExtension($this->get('sonata.core.flashmessage.twig.extension'));
        $instance->addExtension($this->get('sonata.core.twig.extension.wrapping'));
        $instance->addExtension($this->get('sonata.core.twig.extension.text'));
        $instance->addExtension($this->get('sonata.core.twig.status_extension'));
        $instance->addExtension($this->get('sonata.core.twig.deprecated_template_extension'));
        $instance->addExtension($this->get('sonata.core.twig.template_extension'));
        $instance->addExtension(new \Sonata\BlockBundle\Twig\Extension\BlockExtension($this->get('sonata.block.templating.helper')));
        $instance->addExtension(new \Knp\Menu\Twig\MenuExtension(new \Knp\Menu\Twig\Helper($this->get('knp_menu.renderer_provider'), $this->get('knp_menu.menu_provider'), $g, $e), $e, $g));
        $instance->addExtension($this->get('sonata.admin.twig.extension'));
        $instance->addExtension(new \Sonata\AdminBundle\Twig\Extension\TemplateRegistryExtension($this->get('sonata.admin.global_template_registry'), $this));
        $instance->addExtension(new \Symfony\Bridge\Twig\Extension\DumpExtension($this->get('var_dumper.cloner')));
        $instance->addExtension(new \Symfony\Bundle\WebProfilerBundle\Twig\WebProfilerExtension());
        $instance->addGlobal('app', $h);
        $instance->addGlobal('sonata_block', $this->get('sonata.block.twig.global'));
        $instance->addGlobal('sonata_admin', $this->get('sonata.admin.twig.global'));
        call_user_func(array(new \Symfony\Bundle\TwigBundle\DependencyInjection\Configurator\EnvironmentConfigurator('F j, Y H:i', '%d days', NULL, 0, '.', ','), 'configure'), $instance);

        return $instance;
    }

    /**
     * Gets the public 'twig.controller.exception' shared service.
     *
     * @return \Symfony\Bundle\TwigBundle\Controller\ExceptionController
     */
    protected function getTwig_Controller_ExceptionService()
    {
        return $this->services['twig.controller.exception'] = new \Symfony\Bundle\TwigBundle\Controller\ExceptionController($this->get('twig'), true);
    }

    /**
     * Gets the public 'twig.controller.preview_error' shared service.
     *
     * @return \Symfony\Bundle\TwigBundle\Controller\PreviewErrorController
     */
    protected function getTwig_Controller_PreviewErrorService()
    {
        return $this->services['twig.controller.preview_error'] = new \Symfony\Bundle\TwigBundle\Controller\PreviewErrorController($this->get('http_kernel'), 'twig.controller.exception:showAction');
    }

    /**
     * Gets the public 'twig.loader' shared service.
     *
     * @return \Symfony\Bundle\TwigBundle\Loader\FilesystemLoader
     */
    protected function getTwig_LoaderService()
    {
        $this->services['twig.loader'] = $instance = new \Symfony\Bundle\TwigBundle\Loader\FilesystemLoader($this->get('templating.locator'), $this->get('templating.name_parser'));

        $instance->addPath(($this->targetDirs[3].'/vendor/knplabs/knp-menu/src/Knp/Menu/Resources/views'));
        $instance->addPath(($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Bundle/FrameworkBundle/Resources/views'), 'Framework');
        $instance->addPath(($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Bundle/SecurityBundle/Resources/views'), 'Security');
        $instance->addPath(($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Bundle/TwigBundle/Resources/views'), 'Twig');
        $instance->addPath(($this->targetDirs[3].'/vendor/symfony/swiftmailer-bundle/Resources/views'), 'Swiftmailer');
        $instance->addPath(($this->targetDirs[3].'/vendor/doctrine/doctrine-bundle/Resources/views'), 'Doctrine');
        $instance->addPath(($this->targetDirs[3].'/src/Sch/MainBundle/Resources/views'), 'Main');
        $instance->addPath(($this->targetDirs[3].'/vendor/nelmio/api-doc-bundle/Nelmio/ApiDocBundle/Resources/views'), 'NelmioApiDoc');
        $instance->addPath(($this->targetDirs[3].'/vendor/sonata-project/core-bundle/src/Resources/views'), 'SonataCore');
        $instance->addPath(($this->targetDirs[3].'/vendor/sonata-project/block-bundle/src/Resources/views'), 'SonataBlock');
        $instance->addPath(($this->targetDirs[3].'/vendor/knplabs/knp-menu-bundle/src/Resources/views'), 'KnpMenu');
        $instance->addPath(($this->targetDirs[3].'/vendor/sonata-project/doctrine-orm-admin-bundle/src/Resources/views'), 'SonataDoctrineORMAdmin');
        $instance->addPath(($this->targetDirs[3].'/vendor/sonata-project/admin-bundle/src/Resources/views'), 'SonataAdmin');
        $instance->addPath(($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Bundle/DebugBundle/Resources/views'), 'Debug');
        $instance->addPath(($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Bundle/WebProfilerBundle/Resources/views'), 'WebProfiler');
        $instance->addPath(($this->targetDirs[3].'/vendor/sensio/distribution-bundle/Sensio/Bundle/DistributionBundle/Resources/views'), 'SensioDistribution');
        $instance->addPath(($this->targetDirs[2].'/Resources/views'));
        $instance->addPath(($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Bridge/Twig/Resources/views/Form'));

        return $instance;
    }

    /**
     * Gets the public 'twig.profile' shared service.
     *
     * @return \Twig\Profiler\Profile
     */
    protected function getTwig_ProfileService()
    {
        return $this->services['twig.profile'] = new \Twig\Profiler\Profile();
    }

    /**
     * Gets the public 'twig.translation.extractor' shared service.
     *
     * @return \Symfony\Bridge\Twig\Translation\TwigExtractor
     */
    protected function getTwig_Translation_ExtractorService()
    {
        return $this->services['twig.translation.extractor'] = new \Symfony\Bridge\Twig\Translation\TwigExtractor($this->get('twig'));
    }

    /**
     * Gets the public 'twilio.client' shared service.
     *
     * @return \Twilio\Rest\Client
     */
    protected function getTwilio_ClientService()
    {
        return $this->services['twilio.client'] = new \Twilio\Rest\Client('AC7ced9c7a6ab77a57bc3ee41f85beb954', '6fd012f064ec1cb8b2e74a1f68d3daea');
    }

    /**
     * Gets the public 'uri_signer' shared service.
     *
     * @return \Symfony\Component\HttpKernel\UriSigner
     */
    protected function getUriSignerService()
    {
        return $this->services['uri_signer'] = new \Symfony\Component\HttpKernel\UriSigner('ThisTokenIsNotSoSecretChangeIt');
    }

    /**
     * Gets the public 'validate_request_listener' shared service.
     *
     * @return \Symfony\Component\HttpKernel\EventListener\ValidateRequestListener
     */
    protected function getValidateRequestListenerService()
    {
        return $this->services['validate_request_listener'] = new \Symfony\Component\HttpKernel\EventListener\ValidateRequestListener();
    }

    /**
     * Gets the public 'validator' shared service.
     *
     * @return \Symfony\Component\Validator\Validator\ValidatorInterface
     */
    protected function getValidatorService()
    {
        return $this->services['validator'] = $this->get('validator.builder')->getValidator();
    }

    /**
     * Gets the public 'validator.builder' shared service.
     *
     * @return \Symfony\Component\Validator\ValidatorBuilderInterface
     */
    protected function getValidator_BuilderService()
    {
        $this->services['validator.builder'] = $instance = \Symfony\Component\Validator\Validation::createValidatorBuilder();

        $instance->setConstraintValidatorFactory($this->get('validator.validator_factory'));
        $instance->setTranslator($this->get('translator'));
        $instance->setTranslationDomain('validators');
        $instance->addXmlMappings(array(0 => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Component/Form/Resources/config/validation.xml')));
        $instance->enableAnnotationMapping($this->get('annotation_reader'));
        $instance->addMethodMapping('loadValidatorMetadata');
        $instance->addObjectInitializers(array(0 => $this->get('doctrine.orm.validator_initializer')));

        return $instance;
    }

    /**
     * Gets the public 'validator.email' shared service.
     *
     * @return \Symfony\Component\Validator\Constraints\EmailValidator
     */
    protected function getValidator_EmailService()
    {
        return $this->services['validator.email'] = new \Symfony\Component\Validator\Constraints\EmailValidator(false);
    }

    /**
     * Gets the public 'validator.expression' shared service.
     *
     * @return \Symfony\Component\Validator\Constraints\ExpressionValidator
     */
    protected function getValidator_ExpressionService()
    {
        return $this->services['validator.expression'] = new \Symfony\Component\Validator\Constraints\ExpressionValidator($this->get('property_accessor'));
    }

    /**
     * Gets the public 'var_dumper.cli_dumper' shared service.
     *
     * @return \Symfony\Component\VarDumper\Dumper\CliDumper
     */
    protected function getVarDumper_CliDumperService()
    {
        return $this->services['var_dumper.cli_dumper'] = new \Symfony\Component\VarDumper\Dumper\CliDumper(NULL, 'UTF-8');
    }

    /**
     * Gets the public 'var_dumper.cloner' shared service.
     *
     * @return \Symfony\Component\VarDumper\Cloner\VarCloner
     */
    protected function getVarDumper_ClonerService()
    {
        $this->services['var_dumper.cloner'] = $instance = new \Symfony\Component\VarDumper\Cloner\VarCloner();

        $instance->setMaxItems(2500);
        $instance->setMaxString(-1);

        return $instance;
    }

    /**
     * Gets the public 'web_profiler.controller.exception' shared service.
     *
     * @return \Symfony\Bundle\WebProfilerBundle\Controller\ExceptionController
     */
    protected function getWebProfiler_Controller_ExceptionService()
    {
        return $this->services['web_profiler.controller.exception'] = new \Symfony\Bundle\WebProfilerBundle\Controller\ExceptionController($this->get('profiler', ContainerInterface::NULL_ON_INVALID_REFERENCE), $this->get('twig'), true);
    }

    /**
     * Gets the public 'web_profiler.controller.profiler' shared service.
     *
     * @return \Symfony\Bundle\WebProfilerBundle\Controller\ProfilerController
     */
    protected function getWebProfiler_Controller_ProfilerService()
    {
        return $this->services['web_profiler.controller.profiler'] = new \Symfony\Bundle\WebProfilerBundle\Controller\ProfilerController($this->get('router', ContainerInterface::NULL_ON_INVALID_REFERENCE), $this->get('profiler', ContainerInterface::NULL_ON_INVALID_REFERENCE), $this->get('twig'), array('data_collector.request' => array(0 => 'request', 1 => '@WebProfiler/Collector/request.html.twig'), 'data_collector.time' => array(0 => 'time', 1 => '@WebProfiler/Collector/time.html.twig'), 'data_collector.memory' => array(0 => 'memory', 1 => '@WebProfiler/Collector/memory.html.twig'), 'data_collector.ajax' => array(0 => 'ajax', 1 => '@WebProfiler/Collector/ajax.html.twig'), 'data_collector.form' => array(0 => 'form', 1 => '@WebProfiler/Collector/form.html.twig'), 'data_collector.exception' => array(0 => 'exception', 1 => '@WebProfiler/Collector/exception.html.twig'), 'data_collector.logger' => array(0 => 'logger', 1 => '@WebProfiler/Collector/logger.html.twig'), 'data_collector.events' => array(0 => 'events', 1 => '@WebProfiler/Collector/events.html.twig'), 'data_collector.router' => array(0 => 'router', 1 => '@WebProfiler/Collector/router.html.twig'), 'data_collector.translation' => array(0 => 'translation', 1 => '@WebProfiler/Collector/translation.html.twig'), 'data_collector.security' => array(0 => 'security', 1 => '@Security/Collector/security.html.twig'), 'data_collector.twig' => array(0 => 'twig', 1 => '@WebProfiler/Collector/twig.html.twig'), 'data_collector.doctrine' => array(0 => 'db', 1 => '@Doctrine/Collector/db.html.twig'), 'swiftmailer.data_collector' => array(0 => 'swiftmailer', 1 => '@Swiftmailer/Collector/swiftmailer.html.twig'), 'data_collector.dump' => array(0 => 'dump', 1 => '@Debug/Profiler/dump.html.twig'), 'sonata.block.data_collector' => array(0 => 'block', 1 => '@SonataBlock/Profiler/block.html.twig'), 'data_collector.config' => array(0 => 'config', 1 => '@WebProfiler/Collector/config.html.twig')), 'bottom');
    }

    /**
     * Gets the public 'web_profiler.controller.router' shared service.
     *
     * @return \Symfony\Bundle\WebProfilerBundle\Controller\RouterController
     */
    protected function getWebProfiler_Controller_RouterService()
    {
        return $this->services['web_profiler.controller.router'] = new \Symfony\Bundle\WebProfilerBundle\Controller\RouterController($this->get('profiler', ContainerInterface::NULL_ON_INVALID_REFERENCE), $this->get('twig'), $this->get('router', ContainerInterface::NULL_ON_INVALID_REFERENCE));
    }

    /**
     * Gets the public 'web_profiler.debug_toolbar' shared service.
     *
     * @return \Symfony\Bundle\WebProfilerBundle\EventListener\WebDebugToolbarListener
     */
    protected function getWebProfiler_DebugToolbarService()
    {
        return $this->services['web_profiler.debug_toolbar'] = new \Symfony\Bundle\WebProfilerBundle\EventListener\WebDebugToolbarListener($this->get('twig'), false, 2, 'bottom', $this->get('router', ContainerInterface::NULL_ON_INVALID_REFERENCE), '^/(app(_[\\w]+)?\\.php/)?_wdt');
    }

    /**
     * Gets the private 'controller_name_converter' shared service.
     *
     * @return \Symfony\Bundle\FrameworkBundle\Controller\ControllerNameParser
     */
    protected function getControllerNameConverterService()
    {
        return $this->services['controller_name_converter'] = new \Symfony\Bundle\FrameworkBundle\Controller\ControllerNameParser($this->get('kernel'));
    }

    /**
     * Gets the private 'doctrine.dbal.logger.profiling.default' shared service.
     *
     * @return \Doctrine\DBAL\Logging\DebugStack
     */
    protected function getDoctrine_Dbal_Logger_Profiling_DefaultService()
    {
        return $this->services['doctrine.dbal.logger.profiling.default'] = new \Doctrine\DBAL\Logging\DebugStack();
    }

    /**
     * Gets the private 'form.server_params' shared service.
     *
     * @return \Symfony\Component\Form\Util\ServerParams
     */
    protected function getForm_ServerParamsService()
    {
        return $this->services['form.server_params'] = new \Symfony\Component\Form\Util\ServerParams($this->get('request_stack'));
    }

    /**
     * Gets the private 'fos_rest.request_matcher.0dfc4cce134bee15f08405cb5cea4845b13ff7d8c8f779004218432a2c552bd0cd9f9d27' shared service.
     *
     * @return \Symfony\Component\HttpFoundation\RequestMatcher
     */
    protected function getFosRest_RequestMatcher_0dfc4cce134bee15f08405cb5cea4845b13ff7d8c8f779004218432a2c552bd0cd9f9d27Service()
    {
        return $this->services['fos_rest.request_matcher.0dfc4cce134bee15f08405cb5cea4845b13ff7d8c8f779004218432a2c552bd0cd9f9d27'] = new \Symfony\Component\HttpFoundation\RequestMatcher('^/', NULL, NULL);
    }

    /**
     * Gets the private 'fos_rest.request_matcher.50d7031fd332f324b33953b2158cded5b34cf57c3cd709fdaa24d6818252fd77ab4624ee' shared service.
     *
     * @return \Symfony\Component\HttpFoundation\RequestMatcher
     */
    protected function getFosRest_RequestMatcher_50d7031fd332f324b33953b2158cded5b34cf57c3cd709fdaa24d6818252fd77ab4624eeService()
    {
        return $this->services['fos_rest.request_matcher.50d7031fd332f324b33953b2158cded5b34cf57c3cd709fdaa24d6818252fd77ab4624ee'] = new \Symfony\Component\HttpFoundation\RequestMatcher('^/_profiler|_wdt/', NULL, NULL);
    }

    /**
     * Gets the private 'jms_serializer.metadata_factory' shared service.
     *
     * @return \Metadata\MetadataFactory
     */
    protected function getJmsSerializer_MetadataFactoryService()
    {
        $this->services['jms_serializer.metadata_factory'] = $instance = new \Metadata\MetadataFactory(new \Metadata\Driver\LazyLoadingDriver($this, 'jms_serializer.metadata_driver'), 'Metadata\\ClassHierarchyMetadata', true);

        $instance->setCache(new \Metadata\Cache\FileCache((__DIR__.'/jms_serializer')));

        return $instance;
    }

    /**
     * Gets the private 'jms_serializer.unserialize_object_constructor' shared service.
     *
     * @return \JMS\Serializer\Construction\UnserializeObjectConstructor
     */
    protected function getJmsSerializer_UnserializeObjectConstructorService()
    {
        return $this->services['jms_serializer.unserialize_object_constructor'] = new \JMS\Serializer\Construction\UnserializeObjectConstructor();
    }

    /**
     * Gets the private 'monolog.processor.psr_log_message' shared service.
     *
     * @return \Monolog\Processor\PsrLogMessageProcessor
     */
    protected function getMonolog_Processor_PsrLogMessageService()
    {
        return $this->services['monolog.processor.psr_log_message'] = new \Monolog\Processor\PsrLogMessageProcessor();
    }

    /**
     * Gets the private 'router.request_context' shared service.
     *
     * @return \Symfony\Component\Routing\RequestContext
     */
    protected function getRouter_RequestContextService()
    {
        return $this->services['router.request_context'] = new \Symfony\Component\Routing\RequestContext('', 'GET', 'localhost', 'http', 80, 443);
    }

    /**
     * Gets the private 'security.access.decision_manager' shared service.
     *
     * @return \Symfony\Component\Security\Core\Authorization\AccessDecisionManager
     */
    protected function getSecurity_Access_DecisionManagerService()
    {
        $a = $this->get('security.authentication.trust_resolver');

        $this->services['security.access.decision_manager'] = $instance = new \Symfony\Component\Security\Core\Authorization\AccessDecisionManager(array(), 'affirmative', false, true);

        $instance->setVoters(array(0 => new \Symfony\Component\Security\Core\Authorization\Voter\AuthenticatedVoter($a), 1 => new \Symfony\Component\Security\Core\Authorization\Voter\RoleVoter(), 2 => new \Symfony\Component\Security\Core\Authorization\Voter\ExpressionVoter(new \Symfony\Component\Security\Core\Authorization\ExpressionLanguage(), $a, $this->get('security.role_hierarchy', ContainerInterface::NULL_ON_INVALID_REFERENCE))));

        return $instance;
    }

    /**
     * Gets the private 'security.access_listener' shared service.
     *
     * @return \Symfony\Component\Security\Http\Firewall\AccessListener
     */
    protected function getSecurity_AccessListenerService()
    {
        return $this->services['security.access_listener'] = new \Symfony\Component\Security\Http\Firewall\AccessListener($this->get('security.token_storage'), $this->get('security.access.decision_manager'), $this->get('security.access_map'), $this->get('security.authentication.manager'));
    }

    /**
     * Gets the private 'security.access_map' shared service.
     *
     * @return \Symfony\Component\Security\Http\AccessMap
     */
    protected function getSecurity_AccessMapService()
    {
        return $this->services['security.access_map'] = new \Symfony\Component\Security\Http\AccessMap();
    }

    /**
     * Gets the private 'security.authentication.manager' shared service.
     *
     * @return \Symfony\Component\Security\Core\Authentication\AuthenticationProviderManager
     */
    protected function getSecurity_Authentication_ManagerService()
    {
        $this->services['security.authentication.manager'] = $instance = new \Symfony\Component\Security\Core\Authentication\AuthenticationProviderManager(array(0 => new \Symfony\Component\Security\Core\Authentication\Provider\AnonymousAuthenticationProvider('5bbc480f681000.61069306'), 1 => new \Symfony\Component\Security\Core\Authentication\Provider\DaoAuthenticationProvider($this->get('security.user.provider.concrete.in_memory'), $this->get('security.user_checker.main'), 'secured_area', $this->get('security.encoder_factory'), true)), true);

        $instance->setEventDispatcher($this->get('debug.event_dispatcher'));

        return $instance;
    }

    /**
     * Gets the private 'security.authentication.trust_resolver' shared service.
     *
     * @return \Symfony\Component\Security\Core\Authentication\AuthenticationTrustResolver
     */
    protected function getSecurity_Authentication_TrustResolverService()
    {
        return $this->services['security.authentication.trust_resolver'] = new \Symfony\Component\Security\Core\Authentication\AuthenticationTrustResolver('Symfony\\Component\\Security\\Core\\Authentication\\Token\\AnonymousToken', 'Symfony\\Component\\Security\\Core\\Authentication\\Token\\RememberMeToken');
    }

    /**
     * Gets the private 'security.channel_listener' shared service.
     *
     * @return \Symfony\Component\Security\Http\Firewall\ChannelListener
     */
    protected function getSecurity_ChannelListenerService()
    {
        return $this->services['security.channel_listener'] = new \Symfony\Component\Security\Http\Firewall\ChannelListener($this->get('security.access_map'), new \Symfony\Component\Security\Http\EntryPoint\RetryAuthenticationEntryPoint(80, 443), $this->get('monolog.logger.security', ContainerInterface::NULL_ON_INVALID_REFERENCE));
    }

    /**
     * Gets the private 'security.http_utils' shared service.
     *
     * @return \Symfony\Component\Security\Http\HttpUtils
     */
    protected function getSecurity_HttpUtilsService()
    {
        $a = $this->get('router', ContainerInterface::NULL_ON_INVALID_REFERENCE);

        return $this->services['security.http_utils'] = new \Symfony\Component\Security\Http\HttpUtils($a, $a, '{^https?://%s$}i');
    }

    /**
     * Gets the private 'security.logout_url_generator' shared service.
     *
     * @return \Symfony\Component\Security\Http\Logout\LogoutUrlGenerator
     */
    protected function getSecurity_LogoutUrlGeneratorService()
    {
        return $this->services['security.logout_url_generator'] = new \Symfony\Component\Security\Http\Logout\LogoutUrlGenerator($this->get('request_stack', ContainerInterface::NULL_ON_INVALID_REFERENCE), $this->get('router', ContainerInterface::NULL_ON_INVALID_REFERENCE), $this->get('security.token_storage', ContainerInterface::NULL_ON_INVALID_REFERENCE));
    }

    /**
     * Gets the private 'security.role_hierarchy' shared service.
     *
     * @return \Symfony\Component\Security\Core\Role\RoleHierarchy
     */
    protected function getSecurity_RoleHierarchyService()
    {
        return $this->services['security.role_hierarchy'] = new \Symfony\Component\Security\Core\Role\RoleHierarchy(array());
    }

    /**
     * Gets the private 'security.user.provider.concrete.in_memory' shared service.
     *
     * @return \Symfony\Component\Security\Core\User\InMemoryUserProvider
     */
    protected function getSecurity_User_Provider_Concrete_InMemoryService()
    {
        return $this->services['security.user.provider.concrete.in_memory'] = new \Symfony\Component\Security\Core\User\InMemoryUserProvider(array());
    }

    /**
     * Gets the private 'session.storage.metadata_bag' shared service.
     *
     * @return \Symfony\Component\HttpFoundation\Session\Storage\MetadataBag
     */
    protected function getSession_Storage_MetadataBagService()
    {
        return $this->services['session.storage.metadata_bag'] = new \Symfony\Component\HttpFoundation\Session\Storage\MetadataBag('_sf2_meta', '0');
    }

    /**
     * Gets the private 'swiftmailer.mailer.default.transport.eventdispatcher' shared service.
     *
     * @return \Swift_Events_SimpleEventDispatcher
     */
    protected function getSwiftmailer_Mailer_Default_Transport_EventdispatcherService()
    {
        return $this->services['swiftmailer.mailer.default.transport.eventdispatcher'] = new \Swift_Events_SimpleEventDispatcher();
    }

    /**
     * Gets the private 'templating.locator' shared service.
     *
     * @return \Symfony\Bundle\FrameworkBundle\Templating\Loader\TemplateLocator
     */
    protected function getTemplating_LocatorService()
    {
        return $this->services['templating.locator'] = new \Symfony\Bundle\FrameworkBundle\Templating\Loader\TemplateLocator($this->get('file_locator'), __DIR__);
    }

    /**
     * Gets the private 'validator.validator_factory' shared service.
     *
     * @return \Symfony\Bundle\FrameworkBundle\Validator\ConstraintValidatorFactory
     */
    protected function getValidator_ValidatorFactoryService()
    {
        return $this->services['validator.validator_factory'] = new \Symfony\Bundle\FrameworkBundle\Validator\ConstraintValidatorFactory($this, array('AppBundle\\Validator\\Constraints\\E164NumberValidator' => 'app.validator.e164_number', 'validator.expression' => 'validator.expression', 'Symfony\\Component\\Validator\\Constraints\\ExpressionValidator' => 'validator.expression', 'Symfony\\Component\\Validator\\Constraints\\EmailValidator' => 'validator.email', 'security.validator.user_password' => 'security.validator.user_password', 'Symfony\\Component\\Security\\Core\\Validator\\Constraints\\UserPasswordValidator' => 'security.validator.user_password', 'doctrine.orm.validator.unique' => 'doctrine.orm.validator.unique', 'Symfony\\Bridge\\Doctrine\\Validator\\Constraints\\UniqueEntityValidator' => 'doctrine.orm.validator.unique', 'sonata.core.validator.inline' => 'sonata.core.validator.inline', 'Sonata\\CoreBundle\\Validator\\InlineValidator' => 'sonata.admin.validator.inline', 'sonata.admin.validator.inline' => 'sonata.admin.validator.inline'));
    }

    /**
     * {@inheritdoc}
     */
    public function getParameter($name)
    {
        $name = strtolower($name);

        if (!(isset($this->parameters[$name]) || array_key_exists($name, $this->parameters))) {
            throw new InvalidArgumentException(sprintf('The parameter "%s" must be defined.', $name));
        }

        return $this->parameters[$name];
    }

    /**
     * {@inheritdoc}
     */
    public function hasParameter($name)
    {
        $name = strtolower($name);

        return isset($this->parameters[$name]) || array_key_exists($name, $this->parameters);
    }

    /**
     * {@inheritdoc}
     */
    public function setParameter($name, $value)
    {
        throw new LogicException('Impossible to call set() on a frozen ParameterBag.');
    }

    /**
     * {@inheritdoc}
     */
    public function getParameterBag()
    {
        if (null === $this->parameterBag) {
            $this->parameterBag = new FrozenParameterBag($this->parameters);
        }

        return $this->parameterBag;
    }

    /**
     * Gets the default parameters.
     *
     * @return array An array of the default parameters
     */
    protected function getDefaultParameters()
    {
        return array(
            'kernel.root_dir' => $this->targetDirs[2],
            'kernel.environment' => 'dev',
            'kernel.debug' => true,
            'kernel.name' => 'app',
            'kernel.cache_dir' => __DIR__,
            'kernel.logs_dir' => ($this->targetDirs[2].'/logs'),
            'kernel.bundles' => array(
                'FrameworkBundle' => 'Symfony\\Bundle\\FrameworkBundle\\FrameworkBundle',
                'SecurityBundle' => 'Symfony\\Bundle\\SecurityBundle\\SecurityBundle',
                'TwigBundle' => 'Symfony\\Bundle\\TwigBundle\\TwigBundle',
                'MonologBundle' => 'Symfony\\Bundle\\MonologBundle\\MonologBundle',
                'SwiftmailerBundle' => 'Symfony\\Bundle\\SwiftmailerBundle\\SwiftmailerBundle',
                'DoctrineBundle' => 'Doctrine\\Bundle\\DoctrineBundle\\DoctrineBundle',
                'SensioFrameworkExtraBundle' => 'Sensio\\Bundle\\FrameworkExtraBundle\\SensioFrameworkExtraBundle',
                'MainBundle' => 'Sch\\MainBundle\\MainBundle',
                'DoctrineMigrationsBundle' => 'Doctrine\\Bundle\\MigrationsBundle\\DoctrineMigrationsBundle',
                'FOSRestBundle' => 'FOS\\RestBundle\\FOSRestBundle',
                'NelmioApiDocBundle' => 'Nelmio\\ApiDocBundle\\NelmioApiDocBundle',
                'JMSSerializerBundle' => 'JMS\\SerializerBundle\\JMSSerializerBundle',
                'SonataCoreBundle' => 'Sonata\\CoreBundle\\SonataCoreBundle',
                'SonataBlockBundle' => 'Sonata\\BlockBundle\\SonataBlockBundle',
                'KnpMenuBundle' => 'Knp\\Bundle\\MenuBundle\\KnpMenuBundle',
                'SonataDoctrineORMAdminBundle' => 'Sonata\\DoctrineORMAdminBundle\\SonataDoctrineORMAdminBundle',
                'SonataAdminBundle' => 'Sonata\\AdminBundle\\SonataAdminBundle',
                'DebugBundle' => 'Symfony\\Bundle\\DebugBundle\\DebugBundle',
                'WebProfilerBundle' => 'Symfony\\Bundle\\WebProfilerBundle\\WebProfilerBundle',
                'SensioDistributionBundle' => 'Sensio\\Bundle\\DistributionBundle\\SensioDistributionBundle',
                'SensioGeneratorBundle' => 'Sensio\\Bundle\\GeneratorBundle\\SensioGeneratorBundle',
            ),
            'kernel.bundles_metadata' => array(
                'FrameworkBundle' => array(
                    'parent' => NULL,
                    'path' => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Bundle/FrameworkBundle'),
                    'namespace' => 'Symfony\\Bundle\\FrameworkBundle',
                ),
                'SecurityBundle' => array(
                    'parent' => NULL,
                    'path' => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Bundle/SecurityBundle'),
                    'namespace' => 'Symfony\\Bundle\\SecurityBundle',
                ),
                'TwigBundle' => array(
                    'parent' => NULL,
                    'path' => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Bundle/TwigBundle'),
                    'namespace' => 'Symfony\\Bundle\\TwigBundle',
                ),
                'MonologBundle' => array(
                    'parent' => NULL,
                    'path' => ($this->targetDirs[3].'/vendor/symfony/monolog-bundle'),
                    'namespace' => 'Symfony\\Bundle\\MonologBundle',
                ),
                'SwiftmailerBundle' => array(
                    'parent' => NULL,
                    'path' => ($this->targetDirs[3].'/vendor/symfony/swiftmailer-bundle'),
                    'namespace' => 'Symfony\\Bundle\\SwiftmailerBundle',
                ),
                'DoctrineBundle' => array(
                    'parent' => NULL,
                    'path' => ($this->targetDirs[3].'/vendor/doctrine/doctrine-bundle'),
                    'namespace' => 'Doctrine\\Bundle\\DoctrineBundle',
                ),
                'SensioFrameworkExtraBundle' => array(
                    'parent' => NULL,
                    'path' => ($this->targetDirs[3].'/vendor/sensio/framework-extra-bundle'),
                    'namespace' => 'Sensio\\Bundle\\FrameworkExtraBundle',
                ),
                'MainBundle' => array(
                    'parent' => NULL,
                    'path' => ($this->targetDirs[3].'/src/Sch/MainBundle'),
                    'namespace' => 'Sch\\MainBundle',
                ),
                'DoctrineMigrationsBundle' => array(
                    'parent' => NULL,
                    'path' => ($this->targetDirs[3].'/vendor/doctrine/doctrine-migrations-bundle'),
                    'namespace' => 'Doctrine\\Bundle\\MigrationsBundle',
                ),
                'FOSRestBundle' => array(
                    'parent' => NULL,
                    'path' => ($this->targetDirs[3].'/vendor/friendsofsymfony/rest-bundle/FOS/RestBundle'),
                    'namespace' => 'FOS\\RestBundle',
                ),
                'NelmioApiDocBundle' => array(
                    'parent' => NULL,
                    'path' => ($this->targetDirs[3].'/vendor/nelmio/api-doc-bundle/Nelmio/ApiDocBundle'),
                    'namespace' => 'Nelmio\\ApiDocBundle',
                ),
                'JMSSerializerBundle' => array(
                    'parent' => NULL,
                    'path' => ($this->targetDirs[3].'/vendor/jms/serializer-bundle/JMS/SerializerBundle'),
                    'namespace' => 'JMS\\SerializerBundle',
                ),
                'SonataCoreBundle' => array(
                    'parent' => NULL,
                    'path' => ($this->targetDirs[3].'/vendor/sonata-project/core-bundle/src'),
                    'namespace' => 'Sonata\\CoreBundle',
                ),
                'SonataBlockBundle' => array(
                    'parent' => NULL,
                    'path' => ($this->targetDirs[3].'/vendor/sonata-project/block-bundle/src'),
                    'namespace' => 'Sonata\\BlockBundle',
                ),
                'KnpMenuBundle' => array(
                    'parent' => NULL,
                    'path' => ($this->targetDirs[3].'/vendor/knplabs/knp-menu-bundle/src'),
                    'namespace' => 'Knp\\Bundle\\MenuBundle',
                ),
                'SonataDoctrineORMAdminBundle' => array(
                    'parent' => NULL,
                    'path' => ($this->targetDirs[3].'/vendor/sonata-project/doctrine-orm-admin-bundle/src'),
                    'namespace' => 'Sonata\\DoctrineORMAdminBundle',
                ),
                'SonataAdminBundle' => array(
                    'parent' => NULL,
                    'path' => ($this->targetDirs[3].'/vendor/sonata-project/admin-bundle/src'),
                    'namespace' => 'Sonata\\AdminBundle',
                ),
                'DebugBundle' => array(
                    'parent' => NULL,
                    'path' => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Bundle/DebugBundle'),
                    'namespace' => 'Symfony\\Bundle\\DebugBundle',
                ),
                'WebProfilerBundle' => array(
                    'parent' => NULL,
                    'path' => ($this->targetDirs[3].'/vendor/symfony/symfony/src/Symfony/Bundle/WebProfilerBundle'),
                    'namespace' => 'Symfony\\Bundle\\WebProfilerBundle',
                ),
                'SensioDistributionBundle' => array(
                    'parent' => NULL,
                    'path' => ($this->targetDirs[3].'/vendor/sensio/distribution-bundle/Sensio/Bundle/DistributionBundle'),
                    'namespace' => 'Sensio\\Bundle\\DistributionBundle',
                ),
                'SensioGeneratorBundle' => array(
                    'parent' => NULL,
                    'path' => ($this->targetDirs[3].'/vendor/sensio/generator-bundle'),
                    'namespace' => 'Sensio\\Bundle\\GeneratorBundle',
                ),
            ),
            'kernel.charset' => 'UTF-8',
            'kernel.container_class' => 'appDevDebugProjectContainer',
            'database_host' => '127.0.0.1',
            'database_port' => NULL,
            'database_name' => 'EcommerceNew',
            'database_user' => 'root',
            'database_password' => 'mindfire',
            'mailer_transport' => 'smtp',
            'mailer_host' => '127.0.0.1',
            'mailer_user' => NULL,
            'mailer_password' => NULL,
            'secret' => 'ThisTokenIsNotSoSecretChangeIt',
            'twilio_sid' => 'AC7ced9c7a6ab77a57bc3ee41f85beb954',
            'twilio_token' => '6fd012f064ec1cb8b2e74a1f68d3daea',
            'twilio_number' => '+12512731599',
            'data_dir' => ($this->targetDirs[2].'/../web/Data'),
            'locale' => 'fi',
            'controller_resolver.class' => 'Symfony\\Bundle\\FrameworkBundle\\Controller\\ControllerResolver',
            'controller_name_converter.class' => 'Symfony\\Bundle\\FrameworkBundle\\Controller\\ControllerNameParser',
            'response_listener.class' => 'Symfony\\Component\\HttpKernel\\EventListener\\ResponseListener',
            'streamed_response_listener.class' => 'Symfony\\Component\\HttpKernel\\EventListener\\StreamedResponseListener',
            'locale_listener.class' => 'Symfony\\Component\\HttpKernel\\EventListener\\LocaleListener',
            'event_dispatcher.class' => 'Symfony\\Component\\EventDispatcher\\ContainerAwareEventDispatcher',
            'http_kernel.class' => 'Symfony\\Component\\HttpKernel\\DependencyInjection\\ContainerAwareHttpKernel',
            'filesystem.class' => 'Symfony\\Component\\Filesystem\\Filesystem',
            'cache_warmer.class' => 'Symfony\\Component\\HttpKernel\\CacheWarmer\\CacheWarmerAggregate',
            'cache_clearer.class' => 'Symfony\\Component\\HttpKernel\\CacheClearer\\ChainCacheClearer',
            'file_locator.class' => 'Symfony\\Component\\HttpKernel\\Config\\FileLocator',
            'uri_signer.class' => 'Symfony\\Component\\HttpKernel\\UriSigner',
            'request_stack.class' => 'Symfony\\Component\\HttpFoundation\\RequestStack',
            'fragment.handler.class' => 'Symfony\\Component\\HttpKernel\\DependencyInjection\\LazyLoadingFragmentHandler',
            'fragment.renderer.inline.class' => 'Symfony\\Component\\HttpKernel\\Fragment\\InlineFragmentRenderer',
            'fragment.renderer.hinclude.class' => 'Symfony\\Component\\HttpKernel\\Fragment\\HIncludeFragmentRenderer',
            'fragment.renderer.hinclude.global_template' => NULL,
            'fragment.renderer.esi.class' => 'Symfony\\Component\\HttpKernel\\Fragment\\EsiFragmentRenderer',
            'fragment.path' => '/_fragment',
            'translator.class' => 'Symfony\\Bundle\\FrameworkBundle\\Translation\\Translator',
            'translator.identity.class' => 'Symfony\\Component\\Translation\\IdentityTranslator',
            'translator.selector.class' => 'Symfony\\Component\\Translation\\MessageSelector',
            'translation.loader.php.class' => 'Symfony\\Component\\Translation\\Loader\\PhpFileLoader',
            'translation.loader.yml.class' => 'Symfony\\Component\\Translation\\Loader\\YamlFileLoader',
            'translation.loader.xliff.class' => 'Symfony\\Component\\Translation\\Loader\\XliffFileLoader',
            'translation.loader.po.class' => 'Symfony\\Component\\Translation\\Loader\\PoFileLoader',
            'translation.loader.mo.class' => 'Symfony\\Component\\Translation\\Loader\\MoFileLoader',
            'translation.loader.qt.class' => 'Symfony\\Component\\Translation\\Loader\\QtFileLoader',
            'translation.loader.csv.class' => 'Symfony\\Component\\Translation\\Loader\\CsvFileLoader',
            'translation.loader.res.class' => 'Symfony\\Component\\Translation\\Loader\\IcuResFileLoader',
            'translation.loader.dat.class' => 'Symfony\\Component\\Translation\\Loader\\IcuDatFileLoader',
            'translation.loader.ini.class' => 'Symfony\\Component\\Translation\\Loader\\IniFileLoader',
            'translation.loader.json.class' => 'Symfony\\Component\\Translation\\Loader\\JsonFileLoader',
            'translation.dumper.php.class' => 'Symfony\\Component\\Translation\\Dumper\\PhpFileDumper',
            'translation.dumper.xliff.class' => 'Symfony\\Component\\Translation\\Dumper\\XliffFileDumper',
            'translation.dumper.po.class' => 'Symfony\\Component\\Translation\\Dumper\\PoFileDumper',
            'translation.dumper.mo.class' => 'Symfony\\Component\\Translation\\Dumper\\MoFileDumper',
            'translation.dumper.yml.class' => 'Symfony\\Component\\Translation\\Dumper\\YamlFileDumper',
            'translation.dumper.qt.class' => 'Symfony\\Component\\Translation\\Dumper\\QtFileDumper',
            'translation.dumper.csv.class' => 'Symfony\\Component\\Translation\\Dumper\\CsvFileDumper',
            'translation.dumper.ini.class' => 'Symfony\\Component\\Translation\\Dumper\\IniFileDumper',
            'translation.dumper.json.class' => 'Symfony\\Component\\Translation\\Dumper\\JsonFileDumper',
            'translation.dumper.res.class' => 'Symfony\\Component\\Translation\\Dumper\\IcuResFileDumper',
            'translation.extractor.php.class' => 'Symfony\\Bundle\\FrameworkBundle\\Translation\\PhpExtractor',
            'translation.loader.class' => 'Symfony\\Bundle\\FrameworkBundle\\Translation\\TranslationLoader',
            'translation.extractor.class' => 'Symfony\\Component\\Translation\\Extractor\\ChainExtractor',
            'translation.writer.class' => 'Symfony\\Component\\Translation\\Writer\\TranslationWriter',
            'kernel.secret' => 'ThisTokenIsNotSoSecretChangeIt',
            'kernel.http_method_override' => true,
            'kernel.trusted_hosts' => array(

            ),
            'kernel.trusted_proxies' => array(

            ),
            'kernel.default_locale' => 'fi',
            'session.class' => 'Symfony\\Component\\HttpFoundation\\Session\\Session',
            'session.flashbag.class' => 'Symfony\\Component\\HttpFoundation\\Session\\Flash\\FlashBag',
            'session.attribute_bag.class' => 'Symfony\\Component\\HttpFoundation\\Session\\Attribute\\AttributeBag',
            'session.storage.metadata_bag.class' => 'Symfony\\Component\\HttpFoundation\\Session\\Storage\\MetadataBag',
            'session.metadata.storage_key' => '_sf2_meta',
            'session.storage.native.class' => 'Symfony\\Component\\HttpFoundation\\Session\\Storage\\NativeSessionStorage',
            'session.storage.php_bridge.class' => 'Symfony\\Component\\HttpFoundation\\Session\\Storage\\PhpBridgeSessionStorage',
            'session.storage.mock_file.class' => 'Symfony\\Component\\HttpFoundation\\Session\\Storage\\MockFileSessionStorage',
            'session.handler.native_file.class' => 'Symfony\\Component\\HttpFoundation\\Session\\Storage\\Handler\\NativeFileSessionHandler',
            'session.handler.write_check.class' => 'Symfony\\Component\\HttpFoundation\\Session\\Storage\\Handler\\WriteCheckSessionHandler',
            'session_listener.class' => 'Symfony\\Bundle\\FrameworkBundle\\EventListener\\SessionListener',
            'session.storage.options' => array(
                'cookie_httponly' => true,
                'gc_probability' => 1,
            ),
            'session.save_path' => (__DIR__.'/sessions'),
            'session.metadata.update_threshold' => '0',
            'security.secure_random.class' => 'Symfony\\Component\\Security\\Core\\Util\\SecureRandom',
            'form.resolved_type_factory.class' => 'Symfony\\Component\\Form\\ResolvedFormTypeFactory',
            'form.registry.class' => 'Symfony\\Component\\Form\\FormRegistry',
            'form.factory.class' => 'Symfony\\Component\\Form\\FormFactory',
            'form.extension.class' => 'Symfony\\Component\\Form\\Extension\\DependencyInjection\\DependencyInjectionExtension',
            'form.type_guesser.validator.class' => 'Symfony\\Component\\Form\\Extension\\Validator\\ValidatorTypeGuesser',
            'form.type_extension.form.request_handler.class' => 'Symfony\\Component\\Form\\Extension\\HttpFoundation\\HttpFoundationRequestHandler',
            'form.type_extension.csrf.enabled' => true,
            'form.type_extension.csrf.field_name' => '_token',
            'security.csrf.token_generator.class' => 'Symfony\\Component\\Security\\Csrf\\TokenGenerator\\UriSafeTokenGenerator',
            'security.csrf.token_storage.class' => 'Symfony\\Component\\Security\\Csrf\\TokenStorage\\SessionTokenStorage',
            'security.csrf.token_manager.class' => 'Symfony\\Component\\Security\\Csrf\\CsrfTokenManager',
            'templating.engine.delegating.class' => 'Symfony\\Bundle\\FrameworkBundle\\Templating\\DelegatingEngine',
            'templating.name_parser.class' => 'Symfony\\Bundle\\FrameworkBundle\\Templating\\TemplateNameParser',
            'templating.filename_parser.class' => 'Symfony\\Bundle\\FrameworkBundle\\Templating\\TemplateFilenameParser',
            'templating.cache_warmer.template_paths.class' => 'Symfony\\Bundle\\FrameworkBundle\\CacheWarmer\\TemplatePathsCacheWarmer',
            'templating.locator.class' => 'Symfony\\Bundle\\FrameworkBundle\\Templating\\Loader\\TemplateLocator',
            'templating.loader.filesystem.class' => 'Symfony\\Bundle\\FrameworkBundle\\Templating\\Loader\\FilesystemLoader',
            'templating.loader.cache.class' => 'Symfony\\Component\\Templating\\Loader\\CacheLoader',
            'templating.loader.chain.class' => 'Symfony\\Component\\Templating\\Loader\\ChainLoader',
            'templating.finder.class' => 'Symfony\\Bundle\\FrameworkBundle\\CacheWarmer\\TemplateFinder',
            'templating.helper.assets.class' => 'Symfony\\Bundle\\FrameworkBundle\\Templating\\Helper\\AssetsHelper',
            'templating.helper.router.class' => 'Symfony\\Bundle\\FrameworkBundle\\Templating\\Helper\\RouterHelper',
            'templating.helper.code.file_link_format' => NULL,
            'templating.loader.cache.path' => NULL,
            'templating.engines' => array(
                0 => 'twig',
            ),
            'validator.class' => 'Symfony\\Component\\Validator\\Validator\\ValidatorInterface',
            'validator.builder.class' => 'Symfony\\Component\\Validator\\ValidatorBuilderInterface',
            'validator.builder.factory.class' => 'Symfony\\Component\\Validator\\Validation',
            'validator.mapping.cache.apc.class' => 'Symfony\\Component\\Validator\\Mapping\\Cache\\ApcCache',
            'validator.mapping.cache.prefix' => '',
            'validator.validator_factory.class' => 'Symfony\\Bundle\\FrameworkBundle\\Validator\\ConstraintValidatorFactory',
            'validator.expression.class' => 'Symfony\\Component\\Validator\\Constraints\\ExpressionValidator',
            'validator.email.class' => 'Symfony\\Component\\Validator\\Constraints\\EmailValidator',
            'validator.translation_domain' => 'validators',
            'validator.api' => '2.5-bc',
            'fragment.listener.class' => 'Symfony\\Component\\HttpKernel\\EventListener\\FragmentListener',
            'translator.logging' => true,
            'profiler.class' => 'Symfony\\Component\\HttpKernel\\Profiler\\Profiler',
            'profiler_listener.class' => 'Symfony\\Component\\HttpKernel\\EventListener\\ProfilerListener',
            'data_collector.config.class' => 'Symfony\\Component\\HttpKernel\\DataCollector\\ConfigDataCollector',
            'data_collector.request.class' => 'Symfony\\Component\\HttpKernel\\DataCollector\\RequestDataCollector',
            'data_collector.exception.class' => 'Symfony\\Component\\HttpKernel\\DataCollector\\ExceptionDataCollector',
            'data_collector.events.class' => 'Symfony\\Component\\HttpKernel\\DataCollector\\EventDataCollector',
            'data_collector.logger.class' => 'Symfony\\Component\\HttpKernel\\DataCollector\\LoggerDataCollector',
            'data_collector.time.class' => 'Symfony\\Component\\HttpKernel\\DataCollector\\TimeDataCollector',
            'data_collector.memory.class' => 'Symfony\\Component\\HttpKernel\\DataCollector\\MemoryDataCollector',
            'data_collector.router.class' => 'Symfony\\Bundle\\FrameworkBundle\\DataCollector\\RouterDataCollector',
            'form.resolved_type_factory.data_collector_proxy.class' => 'Symfony\\Component\\Form\\Extension\\DataCollector\\Proxy\\ResolvedTypeFactoryDataCollectorProxy',
            'form.type_extension.form.data_collector.class' => 'Symfony\\Component\\Form\\Extension\\DataCollector\\Type\\DataCollectorTypeExtension',
            'data_collector.form.class' => 'Symfony\\Component\\Form\\Extension\\DataCollector\\FormDataCollector',
            'data_collector.form.extractor.class' => 'Symfony\\Component\\Form\\Extension\\DataCollector\\FormDataExtractor',
            'profiler_listener.only_exceptions' => false,
            'profiler_listener.only_master_requests' => false,
            'profiler.storage.dsn' => ('file:'.__DIR__.'/profiler'),
            'profiler.storage.username' => '',
            'profiler.storage.password' => '',
            'profiler.storage.lifetime' => 86400,
            'router.class' => 'Symfony\\Bundle\\FrameworkBundle\\Routing\\Router',
            'router.request_context.class' => 'Symfony\\Component\\Routing\\RequestContext',
            'routing.loader.class' => 'Symfony\\Bundle\\FrameworkBundle\\Routing\\DelegatingLoader',
            'routing.resolver.class' => 'Symfony\\Component\\Config\\Loader\\LoaderResolver',
            'routing.loader.xml.class' => 'Symfony\\Component\\Routing\\Loader\\XmlFileLoader',
            'routing.loader.yml.class' => 'Symfony\\Component\\Routing\\Loader\\YamlFileLoader',
            'routing.loader.php.class' => 'Symfony\\Component\\Routing\\Loader\\PhpFileLoader',
            'router.options.generator_class' => 'Symfony\\Component\\Routing\\Generator\\UrlGenerator',
            'router.options.generator_base_class' => 'Symfony\\Component\\Routing\\Generator\\UrlGenerator',
            'router.options.generator_dumper_class' => 'Symfony\\Component\\Routing\\Generator\\Dumper\\PhpGeneratorDumper',
            'router.options.matcher_class' => 'Symfony\\Bundle\\FrameworkBundle\\Routing\\RedirectableUrlMatcher',
            'router.options.matcher_base_class' => 'Symfony\\Bundle\\FrameworkBundle\\Routing\\RedirectableUrlMatcher',
            'router.options.matcher_dumper_class' => 'Symfony\\Component\\Routing\\Matcher\\Dumper\\PhpMatcherDumper',
            'router.cache_warmer.class' => 'Symfony\\Bundle\\FrameworkBundle\\CacheWarmer\\RouterCacheWarmer',
            'router.options.matcher.cache_class' => 'appDevDebugProjectContainerUrlMatcher',
            'router.options.generator.cache_class' => 'appDevDebugProjectContainerUrlGenerator',
            'router_listener.class' => 'Symfony\\Component\\HttpKernel\\EventListener\\RouterListener',
            'router.request_context.host' => 'localhost',
            'router.request_context.scheme' => 'http',
            'router.request_context.base_url' => '',
            'router.resource' => ($this->targetDirs[2].'/config/routing_dev.yml'),
            'router.cache_class_prefix' => 'appDevDebugProjectContainer',
            'request_listener.http_port' => 80,
            'request_listener.https_port' => 443,
            'annotations.reader.class' => 'Doctrine\\Common\\Annotations\\AnnotationReader',
            'annotations.cached_reader.class' => 'Doctrine\\Common\\Annotations\\CachedReader',
            'annotations.file_cache_reader.class' => 'Doctrine\\Common\\Annotations\\FileCacheReader',
            'property_accessor.class' => 'Symfony\\Component\\PropertyAccess\\PropertyAccessor',
            'debug.debug_handlers_listener.class' => 'Symfony\\Component\\HttpKernel\\EventListener\\DebugHandlersListener',
            'debug.stopwatch.class' => 'Symfony\\Component\\Stopwatch\\Stopwatch',
            'debug.error_handler.throw_at' => -1,
            'debug.event_dispatcher.class' => 'Symfony\\Component\\HttpKernel\\Debug\\TraceableEventDispatcher',
            'debug.container.dump' => (__DIR__.'/appDevDebugProjectContainer.xml'),
            'debug.controller_resolver.class' => 'Symfony\\Component\\HttpKernel\\Controller\\TraceableControllerResolver',
            'security.context.class' => 'Symfony\\Component\\Security\\Core\\SecurityContext',
            'security.user_checker.class' => 'Symfony\\Component\\Security\\Core\\User\\UserChecker',
            'security.encoder_factory.generic.class' => 'Symfony\\Component\\Security\\Core\\Encoder\\EncoderFactory',
            'security.encoder.digest.class' => 'Symfony\\Component\\Security\\Core\\Encoder\\MessageDigestPasswordEncoder',
            'security.encoder.plain.class' => 'Symfony\\Component\\Security\\Core\\Encoder\\PlaintextPasswordEncoder',
            'security.encoder.pbkdf2.class' => 'Symfony\\Component\\Security\\Core\\Encoder\\Pbkdf2PasswordEncoder',
            'security.encoder.bcrypt.class' => 'Symfony\\Component\\Security\\Core\\Encoder\\BCryptPasswordEncoder',
            'security.user.provider.in_memory.class' => 'Symfony\\Component\\Security\\Core\\User\\InMemoryUserProvider',
            'security.user.provider.in_memory.user.class' => 'Symfony\\Component\\Security\\Core\\User\\User',
            'security.user.provider.chain.class' => 'Symfony\\Component\\Security\\Core\\User\\ChainUserProvider',
            'security.authentication.trust_resolver.class' => 'Symfony\\Component\\Security\\Core\\Authentication\\AuthenticationTrustResolver',
            'security.authentication.trust_resolver.anonymous_class' => 'Symfony\\Component\\Security\\Core\\Authentication\\Token\\AnonymousToken',
            'security.authentication.trust_resolver.rememberme_class' => 'Symfony\\Component\\Security\\Core\\Authentication\\Token\\RememberMeToken',
            'security.authentication.manager.class' => 'Symfony\\Component\\Security\\Core\\Authentication\\AuthenticationProviderManager',
            'security.authentication.session_strategy.class' => 'Symfony\\Component\\Security\\Http\\Session\\SessionAuthenticationStrategy',
            'security.access.decision_manager.class' => 'Symfony\\Component\\Security\\Core\\Authorization\\AccessDecisionManager',
            'security.access.simple_role_voter.class' => 'Symfony\\Component\\Security\\Core\\Authorization\\Voter\\RoleVoter',
            'security.access.authenticated_voter.class' => 'Symfony\\Component\\Security\\Core\\Authorization\\Voter\\AuthenticatedVoter',
            'security.access.role_hierarchy_voter.class' => 'Symfony\\Component\\Security\\Core\\Authorization\\Voter\\RoleHierarchyVoter',
            'security.access.expression_voter.class' => 'Symfony\\Component\\Security\\Core\\Authorization\\Voter\\ExpressionVoter',
            'security.firewall.class' => 'Symfony\\Component\\Security\\Http\\Firewall',
            'security.firewall.map.class' => 'Symfony\\Bundle\\SecurityBundle\\Security\\FirewallMap',
            'security.firewall.context.class' => 'Symfony\\Bundle\\SecurityBundle\\Security\\FirewallContext',
            'security.matcher.class' => 'Symfony\\Component\\HttpFoundation\\RequestMatcher',
            'security.expression_matcher.class' => 'Symfony\\Component\\HttpFoundation\\ExpressionRequestMatcher',
            'security.role_hierarchy.class' => 'Symfony\\Component\\Security\\Core\\Role\\RoleHierarchy',
            'security.http_utils.class' => 'Symfony\\Component\\Security\\Http\\HttpUtils',
            'security.validator.user_password.class' => 'Symfony\\Component\\Security\\Core\\Validator\\Constraints\\UserPasswordValidator',
            'security.expression_language.class' => 'Symfony\\Component\\Security\\Core\\Authorization\\ExpressionLanguage',
            'security.role_hierarchy.roles' => array(

            ),
            'security.authentication.retry_entry_point.class' => 'Symfony\\Component\\Security\\Http\\EntryPoint\\RetryAuthenticationEntryPoint',
            'security.channel_listener.class' => 'Symfony\\Component\\Security\\Http\\Firewall\\ChannelListener',
            'security.authentication.form_entry_point.class' => 'Symfony\\Component\\Security\\Http\\EntryPoint\\FormAuthenticationEntryPoint',
            'security.authentication.listener.form.class' => 'Symfony\\Component\\Security\\Http\\Firewall\\UsernamePasswordFormAuthenticationListener',
            'security.authentication.listener.simple_form.class' => 'Symfony\\Component\\Security\\Http\\Firewall\\SimpleFormAuthenticationListener',
            'security.authentication.listener.simple_preauth.class' => 'Symfony\\Component\\Security\\Http\\Firewall\\SimplePreAuthenticationListener',
            'security.authentication.listener.basic.class' => 'Symfony\\Component\\Security\\Http\\Firewall\\BasicAuthenticationListener',
            'security.authentication.basic_entry_point.class' => 'Symfony\\Component\\Security\\Http\\EntryPoint\\BasicAuthenticationEntryPoint',
            'security.authentication.listener.digest.class' => 'Symfony\\Component\\Security\\Http\\Firewall\\DigestAuthenticationListener',
            'security.authentication.digest_entry_point.class' => 'Symfony\\Component\\Security\\Http\\EntryPoint\\DigestAuthenticationEntryPoint',
            'security.authentication.listener.x509.class' => 'Symfony\\Component\\Security\\Http\\Firewall\\X509AuthenticationListener',
            'security.authentication.listener.anonymous.class' => 'Symfony\\Component\\Security\\Http\\Firewall\\AnonymousAuthenticationListener',
            'security.authentication.switchuser_listener.class' => 'Symfony\\Component\\Security\\Http\\Firewall\\SwitchUserListener',
            'security.logout_listener.class' => 'Symfony\\Component\\Security\\Http\\Firewall\\LogoutListener',
            'security.logout.handler.session.class' => 'Symfony\\Component\\Security\\Http\\Logout\\SessionLogoutHandler',
            'security.logout.handler.cookie_clearing.class' => 'Symfony\\Component\\Security\\Http\\Logout\\CookieClearingLogoutHandler',
            'security.logout.success_handler.class' => 'Symfony\\Component\\Security\\Http\\Logout\\DefaultLogoutSuccessHandler',
            'security.access_listener.class' => 'Symfony\\Component\\Security\\Http\\Firewall\\AccessListener',
            'security.access_map.class' => 'Symfony\\Component\\Security\\Http\\AccessMap',
            'security.exception_listener.class' => 'Symfony\\Component\\Security\\Http\\Firewall\\ExceptionListener',
            'security.context_listener.class' => 'Symfony\\Component\\Security\\Http\\Firewall\\ContextListener',
            'security.authentication.provider.dao.class' => 'Symfony\\Component\\Security\\Core\\Authentication\\Provider\\DaoAuthenticationProvider',
            'security.authentication.provider.simple.class' => 'Symfony\\Component\\Security\\Core\\Authentication\\Provider\\SimpleAuthenticationProvider',
            'security.authentication.provider.pre_authenticated.class' => 'Symfony\\Component\\Security\\Core\\Authentication\\Provider\\PreAuthenticatedAuthenticationProvider',
            'security.authentication.provider.anonymous.class' => 'Symfony\\Component\\Security\\Core\\Authentication\\Provider\\AnonymousAuthenticationProvider',
            'security.authentication.success_handler.class' => 'Symfony\\Component\\Security\\Http\\Authentication\\DefaultAuthenticationSuccessHandler',
            'security.authentication.failure_handler.class' => 'Symfony\\Component\\Security\\Http\\Authentication\\DefaultAuthenticationFailureHandler',
            'security.authentication.simple_success_failure_handler.class' => 'Symfony\\Component\\Security\\Http\\Authentication\\SimpleAuthenticationHandler',
            'security.authentication.provider.rememberme.class' => 'Symfony\\Component\\Security\\Core\\Authentication\\Provider\\RememberMeAuthenticationProvider',
            'security.authentication.listener.rememberme.class' => 'Symfony\\Component\\Security\\Http\\Firewall\\RememberMeListener',
            'security.rememberme.token.provider.in_memory.class' => 'Symfony\\Component\\Security\\Core\\Authentication\\RememberMe\\InMemoryTokenProvider',
            'security.authentication.rememberme.services.persistent.class' => 'Symfony\\Component\\Security\\Http\\RememberMe\\PersistentTokenBasedRememberMeServices',
            'security.authentication.rememberme.services.simplehash.class' => 'Symfony\\Component\\Security\\Http\\RememberMe\\TokenBasedRememberMeServices',
            'security.rememberme.response_listener.class' => 'Symfony\\Component\\Security\\Http\\RememberMe\\ResponseListener',
            'templating.helper.logout_url.class' => 'Symfony\\Bundle\\SecurityBundle\\Templating\\Helper\\LogoutUrlHelper',
            'templating.helper.security.class' => 'Symfony\\Bundle\\SecurityBundle\\Templating\\Helper\\SecurityHelper',
            'twig.extension.logout_url.class' => 'Symfony\\Bridge\\Twig\\Extension\\LogoutUrlExtension',
            'twig.extension.security.class' => 'Symfony\\Bridge\\Twig\\Extension\\SecurityExtension',
            'data_collector.security.class' => 'Symfony\\Bundle\\SecurityBundle\\DataCollector\\SecurityDataCollector',
            'security.access.denied_url' => NULL,
            'security.authentication.manager.erase_credentials' => true,
            'security.authentication.session_strategy.strategy' => 'migrate',
            'security.access.always_authenticate_before_granting' => false,
            'security.authentication.hide_user_not_found' => true,
            'twig.class' => 'Twig\\Environment',
            'twig.loader.filesystem.class' => 'Symfony\\Bundle\\TwigBundle\\Loader\\FilesystemLoader',
            'twig.loader.chain.class' => 'Twig\\Loader\\ChainLoader',
            'templating.engine.twig.class' => 'Symfony\\Bundle\\TwigBundle\\TwigEngine',
            'twig.cache_warmer.class' => 'Symfony\\Bundle\\TwigBundle\\CacheWarmer\\TemplateCacheCacheWarmer',
            'twig.extension.trans.class' => 'Symfony\\Bridge\\Twig\\Extension\\TranslationExtension',
            'twig.extension.actions.class' => 'Symfony\\Bundle\\TwigBundle\\Extension\\ActionsExtension',
            'twig.extension.code.class' => 'Symfony\\Bridge\\Twig\\Extension\\CodeExtension',
            'twig.extension.routing.class' => 'Symfony\\Bridge\\Twig\\Extension\\RoutingExtension',
            'twig.extension.yaml.class' => 'Symfony\\Bridge\\Twig\\Extension\\YamlExtension',
            'twig.extension.form.class' => 'Symfony\\Bridge\\Twig\\Extension\\FormExtension',
            'twig.extension.httpkernel.class' => 'Symfony\\Bridge\\Twig\\Extension\\HttpKernelExtension',
            'twig.extension.debug.stopwatch.class' => 'Symfony\\Bridge\\Twig\\Extension\\StopwatchExtension',
            'twig.extension.expression.class' => 'Symfony\\Bridge\\Twig\\Extension\\ExpressionExtension',
            'twig.form.engine.class' => 'Symfony\\Bridge\\Twig\\Form\\TwigRendererEngine',
            'twig.form.renderer.class' => 'Symfony\\Bridge\\Twig\\Form\\TwigRenderer',
            'twig.translation.extractor.class' => 'Symfony\\Bridge\\Twig\\Translation\\TwigExtractor',
            'twig.exception_listener.class' => 'Symfony\\Component\\HttpKernel\\EventListener\\ExceptionListener',
            'twig.controller.exception.class' => 'Symfony\\Bundle\\TwigBundle\\Controller\\ExceptionController',
            'twig.controller.preview_error.class' => 'Symfony\\Bundle\\TwigBundle\\Controller\\PreviewErrorController',
            'twig.exception_listener.controller' => 'twig.controller.exception:showAction',
            'twig.form.resources' => array(
                0 => 'form_div_layout.html.twig',
            ),
            'monolog.use_microseconds' => true,
            'monolog.swift_mailer.handlers' => array(

            ),
            'monolog.handlers_to_channels' => array(
                'monolog.handler.console' => array(
                    'type' => 'exclusive',
                    'elements' => array(
                        0 => 'event',
                        1 => 'doctrine',
                    ),
                ),
                'monolog.handler.main' => array(
                    'type' => 'exclusive',
                    'elements' => array(
                        0 => 'event',
                    ),
                ),
            ),
            'swiftmailer.class' => 'Swift_Mailer',
            'swiftmailer.transport.sendmail.class' => 'Swift_Transport_SendmailTransport',
            'swiftmailer.transport.mail.class' => 'Swift_Transport_MailTransport',
            'swiftmailer.transport.failover.class' => 'Swift_Transport_FailoverTransport',
            'swiftmailer.plugin.redirecting.class' => 'Swift_Plugins_RedirectingPlugin',
            'swiftmailer.plugin.impersonate.class' => 'Swift_Plugins_ImpersonatePlugin',
            'swiftmailer.plugin.messagelogger.class' => 'Swift_Plugins_MessageLogger',
            'swiftmailer.plugin.antiflood.class' => 'Swift_Plugins_AntiFloodPlugin',
            'swiftmailer.transport.smtp.class' => 'Swift_Transport_EsmtpTransport',
            'swiftmailer.plugin.blackhole.class' => 'Swift_Plugins_BlackholePlugin',
            'swiftmailer.spool.file.class' => 'Swift_FileSpool',
            'swiftmailer.spool.memory.class' => 'Swift_MemorySpool',
            'swiftmailer.email_sender.listener.class' => 'Symfony\\Bundle\\SwiftmailerBundle\\EventListener\\EmailSenderListener',
            'swiftmailer.data_collector.class' => 'Symfony\\Bundle\\SwiftmailerBundle\\DataCollector\\MessageDataCollector',
            'swiftmailer.mailer.default.transport.name' => 'smtp',
            'swiftmailer.mailer.default.transport.smtp.encryption' => NULL,
            'swiftmailer.mailer.default.transport.smtp.port' => 25,
            'swiftmailer.mailer.default.transport.smtp.host' => '127.0.0.1',
            'swiftmailer.mailer.default.transport.smtp.username' => NULL,
            'swiftmailer.mailer.default.transport.smtp.password' => NULL,
            'swiftmailer.mailer.default.transport.smtp.auth_mode' => NULL,
            'swiftmailer.mailer.default.transport.smtp.timeout' => 30,
            'swiftmailer.mailer.default.transport.smtp.source_ip' => NULL,
            'swiftmailer.mailer.default.transport.smtp.local_domain' => NULL,
            'swiftmailer.spool.default.memory.path' => (__DIR__.'/swiftmailer/spool/default'),
            'swiftmailer.mailer.default.spool.enabled' => true,
            'swiftmailer.mailer.default.plugin.impersonate' => NULL,
            'swiftmailer.mailer.default.single_address' => NULL,
            'swiftmailer.mailer.default.delivery.enabled' => true,
            'swiftmailer.spool.enabled' => true,
            'swiftmailer.delivery.enabled' => true,
            'swiftmailer.single_address' => NULL,
            'swiftmailer.mailers' => array(
                'default' => 'swiftmailer.mailer.default',
            ),
            'swiftmailer.default_mailer' => 'default',
            'doctrine_cache.apc.class' => 'Doctrine\\Common\\Cache\\ApcCache',
            'doctrine_cache.apcu.class' => 'Doctrine\\Common\\Cache\\ApcuCache',
            'doctrine_cache.array.class' => 'Doctrine\\Common\\Cache\\ArrayCache',
            'doctrine_cache.chain.class' => 'Doctrine\\Common\\Cache\\ChainCache',
            'doctrine_cache.couchbase.class' => 'Doctrine\\Common\\Cache\\CouchbaseCache',
            'doctrine_cache.couchbase.connection.class' => 'Couchbase',
            'doctrine_cache.couchbase.hostnames' => 'localhost:8091',
            'doctrine_cache.file_system.class' => 'Doctrine\\Common\\Cache\\FilesystemCache',
            'doctrine_cache.php_file.class' => 'Doctrine\\Common\\Cache\\PhpFileCache',
            'doctrine_cache.memcache.class' => 'Doctrine\\Common\\Cache\\MemcacheCache',
            'doctrine_cache.memcache.connection.class' => 'Memcache',
            'doctrine_cache.memcache.host' => 'localhost',
            'doctrine_cache.memcache.port' => 11211,
            'doctrine_cache.memcached.class' => 'Doctrine\\Common\\Cache\\MemcachedCache',
            'doctrine_cache.memcached.connection.class' => 'Memcached',
            'doctrine_cache.memcached.host' => 'localhost',
            'doctrine_cache.memcached.port' => 11211,
            'doctrine_cache.mongodb.class' => 'Doctrine\\Common\\Cache\\MongoDBCache',
            'doctrine_cache.mongodb.collection.class' => 'MongoCollection',
            'doctrine_cache.mongodb.connection.class' => 'MongoClient',
            'doctrine_cache.mongodb.server' => 'localhost:27017',
            'doctrine_cache.predis.client.class' => 'Predis\\Client',
            'doctrine_cache.predis.scheme' => 'tcp',
            'doctrine_cache.predis.host' => 'localhost',
            'doctrine_cache.predis.port' => 6379,
            'doctrine_cache.redis.class' => 'Doctrine\\Common\\Cache\\RedisCache',
            'doctrine_cache.redis.connection.class' => 'Redis',
            'doctrine_cache.redis.host' => 'localhost',
            'doctrine_cache.redis.port' => 6379,
            'doctrine_cache.riak.class' => 'Doctrine\\Common\\Cache\\RiakCache',
            'doctrine_cache.riak.bucket.class' => 'Riak\\Bucket',
            'doctrine_cache.riak.connection.class' => 'Riak\\Connection',
            'doctrine_cache.riak.bucket_property_list.class' => 'Riak\\BucketPropertyList',
            'doctrine_cache.riak.host' => 'localhost',
            'doctrine_cache.riak.port' => 8087,
            'doctrine_cache.sqlite3.class' => 'Doctrine\\Common\\Cache\\SQLite3Cache',
            'doctrine_cache.sqlite3.connection.class' => 'SQLite3',
            'doctrine_cache.void.class' => 'Doctrine\\Common\\Cache\\VoidCache',
            'doctrine_cache.wincache.class' => 'Doctrine\\Common\\Cache\\WinCacheCache',
            'doctrine_cache.xcache.class' => 'Doctrine\\Common\\Cache\\XcacheCache',
            'doctrine_cache.zenddata.class' => 'Doctrine\\Common\\Cache\\ZendDataCache',
            'doctrine_cache.security.acl.cache.class' => 'Doctrine\\Bundle\\DoctrineCacheBundle\\Acl\\Model\\AclCache',
            'doctrine.dbal.logger.chain.class' => 'Doctrine\\DBAL\\Logging\\LoggerChain',
            'doctrine.dbal.logger.profiling.class' => 'Doctrine\\DBAL\\Logging\\DebugStack',
            'doctrine.dbal.logger.class' => 'Symfony\\Bridge\\Doctrine\\Logger\\DbalLogger',
            'doctrine.dbal.configuration.class' => 'Doctrine\\DBAL\\Configuration',
            'doctrine.data_collector.class' => 'Doctrine\\Bundle\\DoctrineBundle\\DataCollector\\DoctrineDataCollector',
            'doctrine.dbal.connection.event_manager.class' => 'Symfony\\Bridge\\Doctrine\\ContainerAwareEventManager',
            'doctrine.dbal.connection_factory.class' => 'Doctrine\\Bundle\\DoctrineBundle\\ConnectionFactory',
            'doctrine.dbal.events.mysql_session_init.class' => 'Doctrine\\DBAL\\Event\\Listeners\\MysqlSessionInit',
            'doctrine.dbal.events.oracle_session_init.class' => 'Doctrine\\DBAL\\Event\\Listeners\\OracleSessionInit',
            'doctrine.class' => 'Doctrine\\Bundle\\DoctrineBundle\\Registry',
            'doctrine.entity_managers' => array(
                'default' => 'doctrine.orm.default_entity_manager',
            ),
            'doctrine.default_entity_manager' => 'default',
            'doctrine.dbal.connection_factory.types' => array(

            ),
            'doctrine.connections' => array(
                'default' => 'doctrine.dbal.default_connection',
            ),
            'doctrine.default_connection' => 'default',
            'doctrine.orm.configuration.class' => 'Doctrine\\ORM\\Configuration',
            'doctrine.orm.entity_manager.class' => 'Doctrine\\ORM\\EntityManager',
            'doctrine.orm.manager_configurator.class' => 'Doctrine\\Bundle\\DoctrineBundle\\ManagerConfigurator',
            'doctrine.orm.cache.array.class' => 'Doctrine\\Common\\Cache\\ArrayCache',
            'doctrine.orm.cache.apc.class' => 'Doctrine\\Common\\Cache\\ApcCache',
            'doctrine.orm.cache.memcache.class' => 'Doctrine\\Common\\Cache\\MemcacheCache',
            'doctrine.orm.cache.memcache_host' => 'localhost',
            'doctrine.orm.cache.memcache_port' => 11211,
            'doctrine.orm.cache.memcache_instance.class' => 'Memcache',
            'doctrine.orm.cache.memcached.class' => 'Doctrine\\Common\\Cache\\MemcachedCache',
            'doctrine.orm.cache.memcached_host' => 'localhost',
            'doctrine.orm.cache.memcached_port' => 11211,
            'doctrine.orm.cache.memcached_instance.class' => 'Memcached',
            'doctrine.orm.cache.redis.class' => 'Doctrine\\Common\\Cache\\RedisCache',
            'doctrine.orm.cache.redis_host' => 'localhost',
            'doctrine.orm.cache.redis_port' => 6379,
            'doctrine.orm.cache.redis_instance.class' => 'Redis',
            'doctrine.orm.cache.xcache.class' => 'Doctrine\\Common\\Cache\\XcacheCache',
            'doctrine.orm.cache.wincache.class' => 'Doctrine\\Common\\Cache\\WinCacheCache',
            'doctrine.orm.cache.zenddata.class' => 'Doctrine\\Common\\Cache\\ZendDataCache',
            'doctrine.orm.metadata.driver_chain.class' => 'Doctrine\\Common\\Persistence\\Mapping\\Driver\\MappingDriverChain',
            'doctrine.orm.metadata.annotation.class' => 'Doctrine\\ORM\\Mapping\\Driver\\AnnotationDriver',
            'doctrine.orm.metadata.xml.class' => 'Doctrine\\ORM\\Mapping\\Driver\\SimplifiedXmlDriver',
            'doctrine.orm.metadata.yml.class' => 'Doctrine\\ORM\\Mapping\\Driver\\SimplifiedYamlDriver',
            'doctrine.orm.metadata.php.class' => 'Doctrine\\ORM\\Mapping\\Driver\\PHPDriver',
            'doctrine.orm.metadata.staticphp.class' => 'Doctrine\\ORM\\Mapping\\Driver\\StaticPHPDriver',
            'doctrine.orm.proxy_cache_warmer.class' => 'Symfony\\Bridge\\Doctrine\\CacheWarmer\\ProxyCacheWarmer',
            'form.type_guesser.doctrine.class' => 'Symfony\\Bridge\\Doctrine\\Form\\DoctrineOrmTypeGuesser',
            'doctrine.orm.validator.unique.class' => 'Symfony\\Bridge\\Doctrine\\Validator\\Constraints\\UniqueEntityValidator',
            'doctrine.orm.validator_initializer.class' => 'Symfony\\Bridge\\Doctrine\\Validator\\DoctrineInitializer',
            'doctrine.orm.security.user.provider.class' => 'Symfony\\Bridge\\Doctrine\\Security\\User\\EntityUserProvider',
            'doctrine.orm.listeners.resolve_target_entity.class' => 'Doctrine\\ORM\\Tools\\ResolveTargetEntityListener',
            'doctrine.orm.listeners.attach_entity_listeners.class' => 'Doctrine\\ORM\\Tools\\AttachEntityListenersListener',
            'doctrine.orm.naming_strategy.default.class' => 'Doctrine\\ORM\\Mapping\\DefaultNamingStrategy',
            'doctrine.orm.naming_strategy.underscore.class' => 'Doctrine\\ORM\\Mapping\\UnderscoreNamingStrategy',
            'doctrine.orm.quote_strategy.default.class' => 'Doctrine\\ORM\\Mapping\\DefaultQuoteStrategy',
            'doctrine.orm.quote_strategy.ansi.class' => 'Doctrine\\ORM\\Mapping\\AnsiQuoteStrategy',
            'doctrine.orm.entity_listener_resolver.class' => 'Doctrine\\Bundle\\DoctrineBundle\\Mapping\\ContainerAwareEntityListenerResolver',
            'doctrine.orm.second_level_cache.default_cache_factory.class' => 'Doctrine\\ORM\\Cache\\DefaultCacheFactory',
            'doctrine.orm.second_level_cache.default_region.class' => 'Doctrine\\ORM\\Cache\\Region\\DefaultRegion',
            'doctrine.orm.second_level_cache.filelock_region.class' => 'Doctrine\\ORM\\Cache\\Region\\FileLockRegion',
            'doctrine.orm.second_level_cache.logger_chain.class' => 'Doctrine\\ORM\\Cache\\Logging\\CacheLoggerChain',
            'doctrine.orm.second_level_cache.logger_statistics.class' => 'Doctrine\\ORM\\Cache\\Logging\\StatisticsCacheLogger',
            'doctrine.orm.second_level_cache.cache_configuration.class' => 'Doctrine\\ORM\\Cache\\CacheConfiguration',
            'doctrine.orm.second_level_cache.regions_configuration.class' => 'Doctrine\\ORM\\Cache\\RegionsConfiguration',
            'doctrine.orm.auto_generate_proxy_classes' => true,
            'doctrine.orm.proxy_dir' => (__DIR__.'/doctrine/orm/Proxies'),
            'doctrine.orm.proxy_namespace' => 'Proxies',
            'sensio_framework_extra.view.guesser.class' => 'Sensio\\Bundle\\FrameworkExtraBundle\\Templating\\TemplateGuesser',
            'sensio_framework_extra.controller.listener.class' => 'Sensio\\Bundle\\FrameworkExtraBundle\\EventListener\\ControllerListener',
            'sensio_framework_extra.routing.loader.annot_dir.class' => 'Symfony\\Component\\Routing\\Loader\\AnnotationDirectoryLoader',
            'sensio_framework_extra.routing.loader.annot_file.class' => 'Symfony\\Component\\Routing\\Loader\\AnnotationFileLoader',
            'sensio_framework_extra.routing.loader.annot_class.class' => 'Sensio\\Bundle\\FrameworkExtraBundle\\Routing\\AnnotatedRouteControllerLoader',
            'sensio_framework_extra.converter.listener.class' => 'Sensio\\Bundle\\FrameworkExtraBundle\\EventListener\\ParamConverterListener',
            'sensio_framework_extra.converter.manager.class' => 'Sensio\\Bundle\\FrameworkExtraBundle\\Request\\ParamConverter\\ParamConverterManager',
            'sensio_framework_extra.converter.doctrine.class' => 'Sensio\\Bundle\\FrameworkExtraBundle\\Request\\ParamConverter\\DoctrineParamConverter',
            'sensio_framework_extra.converter.datetime.class' => 'Sensio\\Bundle\\FrameworkExtraBundle\\Request\\ParamConverter\\DateTimeParamConverter',
            'doctrine_migrations.dir_name' => ($this->targetDirs[2].'/DoctrineMigrations'),
            'doctrine_migrations.namespace' => 'Application\\Migrations',
            'doctrine_migrations.table_name' => 'migration_versions',
            'doctrine_migrations.name' => 'Application Migrations',
            'doctrine_migrations.organize_migrations' => false,
            'doctrine_migrations.custom_template' => NULL,
            'fos_rest.serializer.exclusion_strategy.version' => '',
            'fos_rest.serializer.exclusion_strategy.groups' => array(

            ),
            'fos_rest.view_handler.jsonp.callback_param' => '',
            'fos_rest.view.exception_wrapper_handler' => 'FOS\\RestBundle\\View\\ExceptionWrapperHandler',
            'fos_rest.view_handler.default.class' => 'FOS\\RestBundle\\View\\ViewHandler',
            'fos_rest.view_handler.jsonp.class' => 'FOS\\RestBundle\\View\\JsonpHandler',
            'fos_rest.serializer.exception_wrapper_serialize_handler.class' => 'FOS\\RestBundle\\Serializer\\ExceptionWrapperSerializeHandler',
            'fos_rest.routing.loader.controller.class' => 'FOS\\RestBundle\\Routing\\Loader\\RestRouteLoader',
            'fos_rest.routing.loader.yaml_collection.class' => 'FOS\\RestBundle\\Routing\\Loader\\RestYamlCollectionLoader',
            'fos_rest.routing.loader.xml_collection.class' => 'FOS\\RestBundle\\Routing\\Loader\\RestXmlCollectionLoader',
            'fos_rest.routing.loader.processor.class' => 'FOS\\RestBundle\\Routing\\Loader\\RestRouteProcessor',
            'fos_rest.routing.loader.reader.controller.class' => 'FOS\\RestBundle\\Routing\\Loader\\Reader\\RestControllerReader',
            'fos_rest.routing.loader.reader.action.class' => 'FOS\\RestBundle\\Routing\\Loader\\Reader\\RestActionReader',
            'fos_rest.format_negotiator.class' => 'FOS\\RestBundle\\Negotiation\\FormatNegotiator',
            'fos_rest.inflector.class' => 'FOS\\RestBundle\\Inflector\\DoctrineInflector',
            'fos_rest.request_matcher.class' => 'Symfony\\Component\\HttpFoundation\\RequestMatcher',
            'fos_rest.violation_formatter.class' => 'FOS\\RestBundle\\Util\\ViolationFormatter',
            'fos_rest.request.param_fetcher.class' => 'FOS\\RestBundle\\Request\\ParamFetcher',
            'fos_rest.request.param_fetcher.reader.class' => 'FOS\\RestBundle\\Request\\ParamReader',
            'fos_rest.cache_dir' => (__DIR__.'/fos_rest'),
            'fos_rest.routing.loader.default_format' => NULL,
            'fos_rest.routing.loader.include_format' => true,
            'fos_rest.form.extension.csrf_disable.class' => 'FOS\\RestBundle\\Form\\Extension\\DisableCSRFExtension',
            'fos_rest.disable_csrf_role' => 'ROLE_API',
            'fos_rest.serializer.serialize_null' => false,
            'fos_rest.exception_listener.class' => 'Symfony\\Component\\HttpKernel\\EventListener\\ExceptionListener',
            'fos_rest.controller.exception.class' => 'FOS\\RestBundle\\Controller\\ExceptionController',
            'fos_rest.exception_listener.controller' => 'fos_rest.controller.exception:showAction',
            'fos_rest.exception.debug' => true,
            'fos_rest.exception.codes' => array(
                'Symfony\\Component\\Routing\\Exception\\ResourceNotFoundException' => 404,
                'Doctrine\\ORM\\OptimisticLockException' => 409,
                'Sch\\MainBundle\\Exception\\BadRequestDataException' => 400,
            ),
            'fos_rest.exception.messages' => array(
                'Symfony\\Component\\Routing\\Exception\\ResourceNotFoundException' => true,
                'Sch\\MainBundle\\Exception\\BadRequestDataException' => true,
            ),
            'fos_rest.converter.request_body.validation_errors_argument' => 'validationErrors',
            'fos_rest.mime_types' => array(

            ),
            'fos_rest.view_response_listener.class' => 'FOS\\RestBundle\\EventListener\\ViewResponseListener',
            'fos_rest.view_response_listener.force_view' => true,
            'fos_rest.formats' => array(
                'xml' => false,
                'json' => false,
                'html' => true,
            ),
            'fos_rest.force_redirects' => array(
                'html' => 302,
            ),
            'fos_rest.failed_validation' => 400,
            'fos_rest.empty_content' => 204,
            'fos_rest.serialize_null' => false,
            'fos_rest.default_engine' => 'twig',
            'fos_rest.normalizer.camel_keys.class' => 'FOS\\RestBundle\\Normalizer\\CamelKeysNormalizer',
            'fos_rest.decoder.json.class' => 'FOS\\RestBundle\\Decoder\\JsonDecoder',
            'fos_rest.decoder.jsontoform.class' => 'FOS\\RestBundle\\Decoder\\JsonToFormDecoder',
            'fos_rest.decoder.xml.class' => 'FOS\\RestBundle\\Decoder\\XmlDecoder',
            'fos_rest.decoder_provider.class' => 'FOS\\RestBundle\\Decoder\\ContainerDecoderProvider',
            'fos_rest.body_listener.class' => 'FOS\\RestBundle\\EventListener\\BodyListener',
            'fos_rest.throw_exception_on_unsupported_content_type' => false,
            'fos_rest.body_default_format' => NULL,
            'fos_rest.decoders' => array(
                'json' => 'fos_rest.decoder.json',
                'xml' => 'fos_rest.decoder.xml',
            ),
            'fos_rest.format_listener.class' => 'FOS\\RestBundle\\EventListener\\FormatListener',
            'fos_rest.version_listener.class' => 'FOS\\RestBundle\\EventListener\\VersionListener',
            'fos_rest.format_listener.rules' => array(
                0 => array(
                    'path' => '^/',
                    'priorities' => array(
                        0 => 'json',
                        1 => 'xml',
                        2 => 'html',
                    ),
                    'fallback_format' => NULL,
                    'prefer_extension' => true,
                    'host' => NULL,
                    'methods' => NULL,
                    'stop' => false,
                    'exception_fallback_format' => NULL,
                ),
            ),
            'fos_rest.param_fetcher_listener.class' => 'FOS\\RestBundle\\EventListener\\ParamFetcherListener',
            'fos_rest.param_fetcher_listener.set_params_as_attributes' => false,
            'fos_rest.allowed_methods_listener.class' => 'FOS\\RestBundle\\EventListener\\AllowedMethodsListener',
            'fos_rest.allowed_methods_loader.class' => 'FOS\\RestBundle\\Response\\AllowedMethodsLoader\\AllowedMethodsRouterLoader',
            'fos_rest.access_denied_listener.class' => 'FOS\\RestBundle\\EventListener\\AccessDeniedListener',
            'fos_rest.access_denied_listener.formats' => array(
                'json' => true,
            ),
            'fos_rest.access_denied_listener.unauthorized_challenge' => NULL,
            'nelmio_api_doc.motd.template' => 'NelmioApiDocBundle::Components/motd.html.twig',
            'nelmio_api_doc.exclude_sections' => array(

            ),
            'nelmio_api_doc.default_sections_opened' => true,
            'nelmio_api_doc.api_name' => 'API documentation',
            'nelmio_api_doc.sandbox.enabled' => true,
            'nelmio_api_doc.sandbox.endpoint' => NULL,
            'nelmio_api_doc.sandbox.accept_type' => NULL,
            'nelmio_api_doc.sandbox.body_format.formats' => array(
                0 => 'form',
                1 => 'json',
            ),
            'nelmio_api_doc.sandbox.body_format.default_format' => 'form',
            'nelmio_api_doc.sandbox.request_format.method' => 'format_param',
            'nelmio_api_doc.sandbox.request_format.default_format' => 'json',
            'nelmio_api_doc.sandbox.request_format.formats' => array(
                'json' => 'application/json',
                'xml' => 'application/xml',
            ),
            'nelmio_api_doc.sandbox.entity_to_choice' => true,
            'nelmio_api_doc.formatter.abstract_formatter.class' => 'Nelmio\\ApiDocBundle\\Formatter\\AbstractFormatter',
            'nelmio_api_doc.formatter.markdown_formatter.class' => 'Nelmio\\ApiDocBundle\\Formatter\\MarkdownFormatter',
            'nelmio_api_doc.formatter.simple_formatter.class' => 'Nelmio\\ApiDocBundle\\Formatter\\SimpleFormatter',
            'nelmio_api_doc.formatter.html_formatter.class' => 'Nelmio\\ApiDocBundle\\Formatter\\HtmlFormatter',
            'nelmio_api_doc.formatter.swagger_formatter.class' => 'Nelmio\\ApiDocBundle\\Formatter\\SwaggerFormatter',
            'nelmio_api_doc.sandbox.authentication' => NULL,
            'nelmio_api_doc.extractor.api_doc_extractor.class' => 'Nelmio\\ApiDocBundle\\Extractor\\ApiDocExtractor',
            'nelmio_api_doc.form.extension.description_form_type_extension.class' => 'Nelmio\\ApiDocBundle\\Form\\Extension\\DescriptionFormTypeExtension',
            'nelmio_api_doc.twig.extension.extra_markdown.class' => 'Nelmio\\ApiDocBundle\\Twig\\Extension\\MarkdownExtension',
            'nelmio_api_doc.doc_comment_extractor.class' => 'Nelmio\\ApiDocBundle\\Util\\DocCommentExtractor',
            'nelmio_api_doc.extractor.handler.fos_rest.class' => 'Nelmio\\ApiDocBundle\\Extractor\\Handler\\FosRestHandler',
            'nelmio_api_doc.extractor.handler.jms_security.class' => 'Nelmio\\ApiDocBundle\\Extractor\\Handler\\JmsSecurityExtraHandler',
            'nelmio_api_doc.extractor.handler.sensio_framework_extra.class' => 'Nelmio\\ApiDocBundle\\Extractor\\Handler\\SensioFrameworkExtraHandler',
            'nelmio_api_doc.extractor.handler.phpdoc.class' => 'Nelmio\\ApiDocBundle\\Extractor\\Handler\\PhpDocHandler',
            'nelmio_api_doc.parser.collection_parser.class' => 'Nelmio\\ApiDocBundle\\Parser\\CollectionParser',
            'nelmio_api_doc.parser.form_errors_parser.class' => 'Nelmio\\ApiDocBundle\\Parser\\FormErrorsParser',
            'nelmio_api_doc.parser.json_serializable_parser.class' => 'Nelmio\\ApiDocBundle\\Parser\\JsonSerializableParser',
            'nelmio_api_doc.request_listener.parameter' => '_doc',
            'nelmio_api_doc.event_listener.request.class' => 'Nelmio\\ApiDocBundle\\EventListener\\RequestListener',
            'nelmio_api_doc.swagger.base_path' => '/api',
            'nelmio_api_doc.swagger.swagger_version' => '1.2',
            'nelmio_api_doc.swagger.api_version' => '0.1',
            'nelmio_api_doc.swagger.info' => array(
                'title' => 'Symfony2',
                'description' => 'My awesome Symfony2 app!',
                'TermsOfServiceUrl' => NULL,
                'contact' => NULL,
                'license' => NULL,
                'licenseUrl' => NULL,
            ),
            'nelmio_api_doc.swagger.model_naming_strategy' => 'dot_notation',
            'jms_serializer.metadata.file_locator.class' => 'Metadata\\Driver\\FileLocator',
            'jms_serializer.metadata.annotation_driver.class' => 'JMS\\Serializer\\Metadata\\Driver\\AnnotationDriver',
            'jms_serializer.metadata.chain_driver.class' => 'Metadata\\Driver\\DriverChain',
            'jms_serializer.metadata.yaml_driver.class' => 'JMS\\Serializer\\Metadata\\Driver\\YamlDriver',
            'jms_serializer.metadata.xml_driver.class' => 'JMS\\Serializer\\Metadata\\Driver\\XmlDriver',
            'jms_serializer.metadata.php_driver.class' => 'JMS\\Serializer\\Metadata\\Driver\\PhpDriver',
            'jms_serializer.metadata.doctrine_type_driver.class' => 'JMS\\Serializer\\Metadata\\Driver\\DoctrineTypeDriver',
            'jms_serializer.metadata.doctrine_phpcr_type_driver.class' => 'JMS\\Serializer\\Metadata\\Driver\\DoctrinePHPCRTypeDriver',
            'jms_serializer.metadata.lazy_loading_driver.class' => 'Metadata\\Driver\\LazyLoadingDriver',
            'jms_serializer.metadata.metadata_factory.class' => 'Metadata\\MetadataFactory',
            'jms_serializer.metadata.cache.file_cache.class' => 'Metadata\\Cache\\FileCache',
            'jms_serializer.event_dispatcher.class' => 'JMS\\Serializer\\EventDispatcher\\LazyEventDispatcher',
            'jms_serializer.camel_case_naming_strategy.class' => 'JMS\\Serializer\\Naming\\CamelCaseNamingStrategy',
            'jms_serializer.identical_property_naming_strategy.class' => 'JMS\\Serializer\\Naming\\IdenticalPropertyNamingStrategy',
            'jms_serializer.serialized_name_annotation_strategy.class' => 'JMS\\Serializer\\Naming\\SerializedNameAnnotationStrategy',
            'jms_serializer.cache_naming_strategy.class' => 'JMS\\Serializer\\Naming\\CacheNamingStrategy',
            'jms_serializer.doctrine_object_constructor.class' => 'JMS\\Serializer\\Construction\\DoctrineObjectConstructor',
            'jms_serializer.unserialize_object_constructor.class' => 'JMS\\Serializer\\Construction\\UnserializeObjectConstructor',
            'jms_serializer.version_exclusion_strategy.class' => 'JMS\\Serializer\\Exclusion\\VersionExclusionStrategy',
            'jms_serializer.serializer.class' => 'JMS\\Serializer\\Serializer',
            'jms_serializer.twig_extension.class' => 'JMS\\Serializer\\Twig\\SerializerExtension',
            'jms_serializer.twig_runtime_extension.class' => 'JMS\\Serializer\\Twig\\SerializerRuntimeExtension',
            'jms_serializer.twig_runtime_extension_helper.class' => 'JMS\\Serializer\\Twig\\SerializerRuntimeHelper',
            'jms_serializer.templating.helper.class' => 'JMS\\SerializerBundle\\Templating\\SerializerHelper',
            'jms_serializer.json_serialization_visitor.class' => 'JMS\\Serializer\\JsonSerializationVisitor',
            'jms_serializer.json_serialization_visitor.options' => 0,
            'jms_serializer.json_deserialization_visitor.class' => 'JMS\\Serializer\\JsonDeserializationVisitor',
            'jms_serializer.xml_serialization_visitor.class' => 'JMS\\Serializer\\XmlSerializationVisitor',
            'jms_serializer.xml_deserialization_visitor.class' => 'JMS\\Serializer\\XmlDeserializationVisitor',
            'jms_serializer.xml_deserialization_visitor.doctype_whitelist' => array(

            ),
            'jms_serializer.xml_serialization_visitor.format_output' => true,
            'jms_serializer.yaml_serialization_visitor.class' => 'JMS\\Serializer\\YamlSerializationVisitor',
            'jms_serializer.handler_registry.class' => 'JMS\\Serializer\\Handler\\LazyHandlerRegistry',
            'jms_serializer.datetime_handler.class' => 'JMS\\Serializer\\Handler\\DateHandler',
            'jms_serializer.array_collection_handler.class' => 'JMS\\Serializer\\Handler\\ArrayCollectionHandler',
            'jms_serializer.php_collection_handler.class' => 'JMS\\Serializer\\Handler\\PhpCollectionHandler',
            'jms_serializer.form_error_handler.class' => 'JMS\\Serializer\\Handler\\FormErrorHandler',
            'jms_serializer.constraint_violation_handler.class' => 'JMS\\Serializer\\Handler\\ConstraintViolationHandler',
            'jms_serializer.doctrine_proxy_subscriber.class' => 'JMS\\Serializer\\EventDispatcher\\Subscriber\\DoctrineProxySubscriber',
            'jms_serializer.stopwatch_subscriber.class' => 'JMS\\SerializerBundle\\Serializer\\StopwatchEventSubscriber',
            'jms_serializer.configured_context_factory.class' => 'JMS\\SerializerBundle\\ContextFactory\\ConfiguredContextFactory',
            'jms_serializer.expression_evaluator.class' => 'JMS\\Serializer\\Expression\\ExpressionEvaluator',
            'jms_serializer.expression_language.class' => 'Symfony\\Component\\ExpressionLanguage\\ExpressionLanguage',
            'jms_serializer.expression_language.function_provider.class' => 'JMS\\SerializerBundle\\ExpressionLanguage\\BasicSerializerFunctionsProvider',
            'jms_serializer.accessor_strategy.default.class' => 'JMS\\Serializer\\Accessor\\DefaultAccessorStrategy',
            'jms_serializer.accessor_strategy.expression.class' => 'JMS\\Serializer\\Accessor\\ExpressionAccessorStrategy',
            'sonata.core.flashmessage.manager.class' => 'Sonata\\CoreBundle\\FlashMessage\\FlashManager',
            'sonata.core.twig.extension.flashmessage.class' => 'Sonata\\CoreBundle\\Twig\\Extension\\FlashMessageExtension',
            'sonata.core.form_type' => 'standard',
            'sonata.core.form.mapping.type' => array(

            ),
            'sonata.core.form.mapping.extension' => array(

            ),
            'sonata.block.service.container.class' => 'Sonata\\BlockBundle\\Block\\Service\\ContainerBlockService',
            'sonata.block.service.empty.class' => 'Sonata\\BlockBundle\\Block\\Service\\EmptyBlockService',
            'sonata.block.service.text.class' => 'Sonata\\BlockBundle\\Block\\Service\\TextBlockService',
            'sonata.block.service.rss.class' => 'Sonata\\BlockBundle\\Block\\Service\\RssBlockService',
            'sonata.block.service.menu.class' => 'Sonata\\BlockBundle\\Block\\Service\\MenuBlockService',
            'sonata.block.service.template.class' => 'Sonata\\BlockBundle\\Block\\Service\\TemplateBlockService',
            'sonata.block.exception.strategy.manager.class' => 'Sonata\\BlockBundle\\Exception\\Strategy\\StrategyManager',
            'sonata.block.container.types' => array(
                0 => 'sonata.block.service.container',
                1 => 'sonata.page.block.container',
                2 => 'sonata.dashboard.block.container',
                3 => 'cmf.block.container',
                4 => 'cmf.block.slideshow',
            ),
            'sonata_block.blocks' => array(
                'sonata.admin.block.admin_list' => array(
                    'contexts' => array(
                        0 => 'admin',
                    ),
                    'templates' => array(

                    ),
                    'cache' => 'sonata.cache.noop',
                    'settings' => array(

                    ),
                ),
            ),
            'sonata_block.blocks_by_class' => array(

            ),
            'sonata_block.cache_blocks' => array(
                'by_type' => array(
                    'sonata.admin.block.admin_list' => 'sonata.cache.noop',
                ),
            ),
            'knp_menu.factory.class' => 'Knp\\Menu\\MenuFactory',
            'knp_menu.factory_extension.routing.class' => 'Knp\\Menu\\Integration\\Symfony\\RoutingExtension',
            'knp_menu.helper.class' => 'Knp\\Menu\\Twig\\Helper',
            'knp_menu.matcher.class' => 'Knp\\Menu\\Matcher\\Matcher',
            'knp_menu.menu_provider.chain.class' => 'Knp\\Menu\\Provider\\ChainProvider',
            'knp_menu.menu_provider.container_aware.class' => 'Knp\\Bundle\\MenuBundle\\Provider\\ContainerAwareProvider',
            'knp_menu.menu_provider.builder_alias.class' => 'Knp\\Bundle\\MenuBundle\\Provider\\BuilderAliasProvider',
            'knp_menu.renderer_provider.class' => 'Knp\\Bundle\\MenuBundle\\Renderer\\ContainerAwareProvider',
            'knp_menu.renderer.list.class' => 'Knp\\Menu\\Renderer\\ListRenderer',
            'knp_menu.renderer.list.options' => array(

            ),
            'knp_menu.listener.voters.class' => 'Knp\\Bundle\\MenuBundle\\EventListener\\VoterInitializerListener',
            'knp_menu.voter.router.class' => 'Knp\\Menu\\Matcher\\Voter\\RouteVoter',
            'knp_menu.twig.extension.class' => 'Knp\\Menu\\Twig\\MenuExtension',
            'knp_menu.renderer.twig.class' => 'Knp\\Menu\\Renderer\\TwigRenderer',
            'knp_menu.renderer.twig.options' => array(

            ),
            'knp_menu.renderer.twig.template' => '@KnpMenu/menu.html.twig',
            'knp_menu.default_renderer' => 'twig',
            'sonata.admin.manipulator.acl.object.orm.class' => 'Sonata\\DoctrineORMAdminBundle\\Util\\ObjectAclManipulator',
            'sonata_doctrine_orm_admin.entity_manager' => NULL,
            'sonata_doctrine_orm_admin.templates' => array(
                'types' => array(
                    'list' => array(
                        'array' => '@SonataAdmin/CRUD/list_array.html.twig',
                        'boolean' => '@SonataAdmin/CRUD/list_boolean.html.twig',
                        'date' => '@SonataAdmin/CRUD/list_date.html.twig',
                        'time' => '@SonataAdmin/CRUD/list_time.html.twig',
                        'datetime' => '@SonataAdmin/CRUD/list_datetime.html.twig',
                        'text' => '@SonataAdmin/CRUD/list_string.html.twig',
                        'textarea' => '@SonataAdmin/CRUD/list_string.html.twig',
                        'email' => '@SonataAdmin/CRUD/list_email.html.twig',
                        'trans' => '@SonataAdmin/CRUD/list_trans.html.twig',
                        'string' => '@SonataAdmin/CRUD/list_string.html.twig',
                        'smallint' => '@SonataAdmin/CRUD/list_string.html.twig',
                        'bigint' => '@SonataAdmin/CRUD/list_string.html.twig',
                        'integer' => '@SonataAdmin/CRUD/list_string.html.twig',
                        'decimal' => '@SonataAdmin/CRUD/list_string.html.twig',
                        'identifier' => '@SonataAdmin/CRUD/list_string.html.twig',
                        'currency' => '@SonataAdmin/CRUD/list_currency.html.twig',
                        'percent' => '@SonataAdmin/CRUD/list_percent.html.twig',
                        'choice' => '@SonataAdmin/CRUD/list_choice.html.twig',
                        'url' => '@SonataAdmin/CRUD/list_url.html.twig',
                        'html' => '@SonataAdmin/CRUD/list_html.html.twig',
                    ),
                    'show' => array(
                        'array' => '@SonataAdmin/CRUD/show_array.html.twig',
                        'boolean' => '@SonataAdmin/CRUD/show_boolean.html.twig',
                        'date' => '@SonataAdmin/CRUD/show_date.html.twig',
                        'time' => '@SonataAdmin/CRUD/show_time.html.twig',
                        'datetime' => '@SonataAdmin/CRUD/show_datetime.html.twig',
                        'text' => '@SonataAdmin/CRUD/base_show_field.html.twig',
                        'email' => '@SonataAdmin/CRUD/show_email.html.twig',
                        'trans' => '@SonataAdmin/CRUD/show_trans.html.twig',
                        'string' => '@SonataAdmin/CRUD/base_show_field.html.twig',
                        'smallint' => '@SonataAdmin/CRUD/base_show_field.html.twig',
                        'bigint' => '@SonataAdmin/CRUD/base_show_field.html.twig',
                        'integer' => '@SonataAdmin/CRUD/base_show_field.html.twig',
                        'decimal' => '@SonataAdmin/CRUD/base_show_field.html.twig',
                        'currency' => '@SonataAdmin/CRUD/show_currency.html.twig',
                        'percent' => '@SonataAdmin/CRUD/show_percent.html.twig',
                        'choice' => '@SonataAdmin/CRUD/show_choice.html.twig',
                        'url' => '@SonataAdmin/CRUD/show_url.html.twig',
                        'html' => '@SonataAdmin/CRUD/show_html.html.twig',
                    ),
                ),
                'form' => array(
                    0 => '@SonataDoctrineORMAdmin/Form/form_admin_fields.html.twig',
                ),
                'filter' => array(
                    0 => '@SonataDoctrineORMAdmin/Form/filter_admin_fields.html.twig',
                ),
            ),
            'sonata.admin.twig.extension.x_editable_type_mapping' => array(
                'choice' => 'select',
                'boolean' => 'select',
                'text' => 'text',
                'textarea' => 'textarea',
                'html' => 'textarea',
                'email' => 'email',
                'string' => 'text',
                'smallint' => 'text',
                'bigint' => 'text',
                'integer' => 'number',
                'decimal' => 'number',
                'currency' => 'number',
                'percent' => 'number',
                'url' => 'url',
                'date' => 'date',
            ),
            'sonata.admin.configuration.global_search.empty_boxes' => 'show',
            'sonata.admin.configuration.templates' => array(
                'user_block' => '@SonataAdmin/Core/user_block.html.twig',
                'add_block' => '@SonataAdmin/Core/add_block.html.twig',
                'layout' => '@SonataAdmin/standard_layout.html.twig',
                'ajax' => '@SonataAdmin/ajax_layout.html.twig',
                'dashboard' => '@SonataAdmin/Core/dashboard.html.twig',
                'search' => '@SonataAdmin/Core/search.html.twig',
                'list' => '@SonataAdmin/CRUD/list.html.twig',
                'filter' => '@SonataAdmin/Form/filter_admin_fields.html.twig',
                'show' => '@SonataAdmin/CRUD/show.html.twig',
                'show_compare' => '@SonataAdmin/CRUD/show_compare.html.twig',
                'edit' => '@SonataAdmin/CRUD/edit.html.twig',
                'preview' => '@SonataAdmin/CRUD/preview.html.twig',
                'history' => '@SonataAdmin/CRUD/history.html.twig',
                'acl' => '@SonataAdmin/CRUD/acl.html.twig',
                'history_revision_timestamp' => '@SonataAdmin/CRUD/history_revision_timestamp.html.twig',
                'action' => '@SonataAdmin/CRUD/action.html.twig',
                'select' => '@SonataAdmin/CRUD/list__select.html.twig',
                'list_block' => '@SonataAdmin/Block/block_admin_list.html.twig',
                'search_result_block' => '@SonataAdmin/Block/block_search_result.html.twig',
                'short_object_description' => '@SonataAdmin/Helper/short-object-description.html.twig',
                'delete' => '@SonataAdmin/CRUD/delete.html.twig',
                'batch' => '@SonataAdmin/CRUD/list__batch.html.twig',
                'batch_confirmation' => '@SonataAdmin/CRUD/batch_confirmation.html.twig',
                'inner_list_row' => '@SonataAdmin/CRUD/list_inner_row.html.twig',
                'outer_list_rows_mosaic' => '@SonataAdmin/CRUD/list_outer_rows_mosaic.html.twig',
                'outer_list_rows_list' => '@SonataAdmin/CRUD/list_outer_rows_list.html.twig',
                'outer_list_rows_tree' => '@SonataAdmin/CRUD/list_outer_rows_tree.html.twig',
                'base_list_field' => '@SonataAdmin/CRUD/base_list_field.html.twig',
                'pager_links' => '@SonataAdmin/Pager/links.html.twig',
                'pager_results' => '@SonataAdmin/Pager/results.html.twig',
                'tab_menu_template' => '@SonataAdmin/Core/tab_menu_template.html.twig',
                'knp_menu_template' => '@SonataAdmin/Menu/sonata_menu.html.twig',
                'action_create' => '@SonataAdmin/CRUD/dashboard__action_create.html.twig',
                'button_acl' => '@SonataAdmin/Button/acl_button.html.twig',
                'button_create' => '@SonataAdmin/Button/create_button.html.twig',
                'button_edit' => '@SonataAdmin/Button/edit_button.html.twig',
                'button_history' => '@SonataAdmin/Button/history_button.html.twig',
                'button_list' => '@SonataAdmin/Button/list_button.html.twig',
                'button_show' => '@SonataAdmin/Button/show_button.html.twig',
            ),
            'sonata.admin.configuration.admin_services' => array(

            ),
            'sonata.admin.configuration.dashboard_groups' => array(

            ),
            'sonata.admin.configuration.dashboard_blocks' => array(
                0 => array(
                    'position' => 'left',
                    'settings' => array(

                    ),
                    'type' => 'sonata.admin.block.admin_list',
                    'roles' => array(

                    ),
                ),
            ),
            'sonata.admin.configuration.sort_admins' => false,
            'sonata.admin.configuration.breadcrumbs' => array(
                'child_admin_route' => 'edit',
            ),
            'sonata.admin.security.acl_user_manager' => NULL,
            'sonata.admin.configuration.security.role_admin' => 'ROLE_SONATA_ADMIN',
            'sonata.admin.configuration.security.role_super_admin' => 'ROLE_SUPER_ADMIN',
            'sonata.admin.configuration.security.information' => array(

            ),
            'sonata.admin.configuration.security.admin_permissions' => array(
                0 => 'CREATE',
                1 => 'LIST',
                2 => 'DELETE',
                3 => 'UNDELETE',
                4 => 'EXPORT',
                5 => 'OPERATOR',
                6 => 'MASTER',
            ),
            'sonata.admin.configuration.security.object_permissions' => array(
                0 => 'VIEW',
                1 => 'EDIT',
                2 => 'DELETE',
                3 => 'UNDELETE',
                4 => 'OPERATOR',
                5 => 'MASTER',
                6 => 'OWNER',
            ),
            'sonata.admin.security.handler.noop.class' => 'Sonata\\AdminBundle\\Security\\Handler\\NoopSecurityHandler',
            'sonata.admin.security.handler.role.class' => 'Sonata\\AdminBundle\\Security\\Handler\\RoleSecurityHandler',
            'sonata.admin.security.handler.acl.class' => 'Sonata\\AdminBundle\\Security\\Handler\\AclSecurityHandler',
            'sonata.admin.security.mask.builder.class' => 'Sonata\\AdminBundle\\Security\\Acl\\Permission\\MaskBuilder',
            'sonata.admin.manipulator.acl.admin.class' => 'Sonata\\AdminBundle\\Util\\AdminAclManipulator',
            'sonata.admin.object.manipulator.acl.admin.class' => 'Sonata\\AdminBundle\\Util\\AdminObjectAclManipulator',
            'sonata.admin.extension.map' => array(
                'admins' => array(

                ),
                'excludes' => array(

                ),
                'implements' => array(

                ),
                'extends' => array(

                ),
                'instanceof' => array(

                ),
                'uses' => array(

                ),
            ),
            'sonata.admin.configuration.filters.persist' => false,
            'sonata.admin.configuration.filters.persister' => 'sonata.admin.filter_persister.session',
            'sonata.admin.configuration.show.mosaic.button' => true,
            'sonata.admin.configuration.translate_group_label' => false,
            'web_profiler.controller.profiler.class' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController',
            'web_profiler.controller.router.class' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\RouterController',
            'web_profiler.controller.exception.class' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ExceptionController',
            'twig.extension.webprofiler.class' => 'Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension',
            'web_profiler.debug_toolbar.position' => 'bottom',
            'web_profiler.debug_toolbar.class' => 'Symfony\\Bundle\\WebProfilerBundle\\EventListener\\WebDebugToolbarListener',
            'web_profiler.debug_toolbar.intercept_redirects' => false,
            'web_profiler.debug_toolbar.mode' => 2,
            'sensio_distribution.webconfigurator.class' => 'Sensio\\Bundle\\DistributionBundle\\Configurator\\Configurator',
            'sensio_distribution.webconfigurator.doctrine_step.class' => 'Sensio\\Bundle\\DistributionBundle\\Configurator\\Step\\DoctrineStep',
            'sensio_distribution.webconfigurator.secret_step.class' => 'Sensio\\Bundle\\DistributionBundle\\Configurator\\Step\\SecretStep',
            'sensio_distribution.security_checker.class' => 'SensioLabs\\Security\\SecurityChecker',
            'sensio_distribution.security_checker.command.class' => 'SensioLabs\\Security\\Command\\SecurityCheckerCommand',
            'data_collector.templates' => array(
                'data_collector.request' => array(
                    0 => 'request',
                    1 => '@WebProfiler/Collector/request.html.twig',
                ),
                'data_collector.time' => array(
                    0 => 'time',
                    1 => '@WebProfiler/Collector/time.html.twig',
                ),
                'data_collector.memory' => array(
                    0 => 'memory',
                    1 => '@WebProfiler/Collector/memory.html.twig',
                ),
                'data_collector.ajax' => array(
                    0 => 'ajax',
                    1 => '@WebProfiler/Collector/ajax.html.twig',
                ),
                'data_collector.form' => array(
                    0 => 'form',
                    1 => '@WebProfiler/Collector/form.html.twig',
                ),
                'data_collector.exception' => array(
                    0 => 'exception',
                    1 => '@WebProfiler/Collector/exception.html.twig',
                ),
                'data_collector.logger' => array(
                    0 => 'logger',
                    1 => '@WebProfiler/Collector/logger.html.twig',
                ),
                'data_collector.events' => array(
                    0 => 'events',
                    1 => '@WebProfiler/Collector/events.html.twig',
                ),
                'data_collector.router' => array(
                    0 => 'router',
                    1 => '@WebProfiler/Collector/router.html.twig',
                ),
                'data_collector.translation' => array(
                    0 => 'translation',
                    1 => '@WebProfiler/Collector/translation.html.twig',
                ),
                'data_collector.security' => array(
                    0 => 'security',
                    1 => '@Security/Collector/security.html.twig',
                ),
                'data_collector.twig' => array(
                    0 => 'twig',
                    1 => '@WebProfiler/Collector/twig.html.twig',
                ),
                'data_collector.doctrine' => array(
                    0 => 'db',
                    1 => '@Doctrine/Collector/db.html.twig',
                ),
                'swiftmailer.data_collector' => array(
                    0 => 'swiftmailer',
                    1 => '@Swiftmailer/Collector/swiftmailer.html.twig',
                ),
                'data_collector.dump' => array(
                    0 => 'dump',
                    1 => '@Debug/Profiler/dump.html.twig',
                ),
                'sonata.block.data_collector' => array(
                    0 => 'block',
                    1 => '@SonataBlock/Profiler/block.html.twig',
                ),
                'data_collector.config' => array(
                    0 => 'config',
                    1 => '@WebProfiler/Collector/config.html.twig',
                ),
            ),
            'console.command.ids' => array(
                0 => 'doctrine_cache.contains_command',
                1 => 'doctrine_cache.delete_command',
                2 => 'doctrine_cache.flush_command',
                3 => 'doctrine_cache.stats_command',
                4 => 'doctrine.database_create_command',
                5 => 'doctrine.database_drop_command',
                6 => 'doctrine.generate_entities_command',
                7 => 'doctrine.mapping_import_command',
                8 => 'doctrine.cache_clear_metadata_command',
                9 => 'doctrine.cache_clear_query_cache_command',
                10 => 'doctrine.cache_clear_result_command',
                11 => 'doctrine.cache_collection_region_command',
                12 => 'doctrine.mapping_convert_command',
                13 => 'doctrine.schema_create_command',
                14 => 'doctrine.schema_drop_command',
                15 => 'doctrine.ensure_production_settings_command',
                16 => 'doctrine.clear_entity_region_command',
                17 => 'doctrine.database_import_command',
                18 => 'doctrine.mapping_info_command',
                19 => 'doctrine.clear_query_region_command',
                20 => 'doctrine.query_dql_command',
                21 => 'doctrine.query_sql_command',
                22 => 'doctrine.schema_update_command',
                23 => 'doctrine.schema_validate_command',
                24 => 'doctrine_migrations.diff_command',
                25 => 'doctrine_migrations.execute_command',
                26 => 'doctrine_migrations.generate_command',
                27 => 'doctrine_migrations.latest_command',
                28 => 'doctrine_migrations.migrate_command',
                29 => 'doctrine_migrations.status_command',
                30 => 'doctrine_migrations.version_command',
                31 => 'sonata\\corebundle\\command\\sonatadumpdoctrinemetacommand',
                32 => 'sonata\\corebundle\\command\\sonatalistformmappingcommand',
                33 => 'sonata\\blockbundle\\command\\debugblockscommand',
                34 => 'sonata\\adminbundle\\command\\createclasscachecommand',
                35 => 'sonata\\adminbundle\\command\\explainadmincommand',
                36 => 'sonata\\adminbundle\\command\\generateadmincommand',
                37 => 'sonata\\adminbundle\\command\\generateobjectaclcommand',
                38 => 'sonata\\adminbundle\\command\\listadmincommand',
                39 => 'sonata\\adminbundle\\command\\setupaclcommand',
                40 => 'sensio_distribution.security_checker.command',
            ),
            'nelmio_api_doc.parser.form_type_parser.class' => 'Nelmio\\ApiDocBundle\\Parser\\FormTypeParser',
            'nelmio_api_doc.parser.validation_parser.class' => 'Nelmio\\ApiDocBundle\\Parser\\ValidationParser',
            'nelmio_api_doc.parser.jms_metadata_parser.class' => 'Nelmio\\ApiDocBundle\\Parser\\JmsMetadataParser',
            'sonata.core.form.types' => array(
                0 => 'form.type.form',
                1 => 'form.type.birthday',
                2 => 'form.type.checkbox',
                3 => 'form.type.choice',
                4 => 'form.type.collection',
                5 => 'form.type.country',
                6 => 'form.type.date',
                7 => 'form.type.datetime',
                8 => 'form.type.email',
                9 => 'form.type.file',
                10 => 'form.type.hidden',
                11 => 'form.type.integer',
                12 => 'form.type.language',
                13 => 'form.type.locale',
                14 => 'form.type.money',
                15 => 'form.type.number',
                16 => 'form.type.password',
                17 => 'form.type.percent',
                18 => 'form.type.radio',
                19 => 'form.type.range',
                20 => 'form.type.repeated',
                21 => 'form.type.search',
                22 => 'form.type.textarea',
                23 => 'form.type.text',
                24 => 'form.type.time',
                25 => 'form.type.timezone',
                26 => 'form.type.url',
                27 => 'form.type.button',
                28 => 'form.type.submit',
                29 => 'form.type.reset',
                30 => 'form.type.currency',
                31 => 'form.type.entity',
                32 => 'sonata.core.form.type.array',
                33 => 'sonata.core.form.type.boolean',
                34 => 'sonata.core.form.type.collection',
                35 => 'sonata.core.form.type.translatable_choice',
                36 => 'sonata.core.form.type.date_range',
                37 => 'sonata.core.form.type.datetime_range',
                38 => 'sonata.core.form.type.date_picker',
                39 => 'sonata.core.form.type.datetime_picker',
                40 => 'sonata.core.form.type.date_range_picker',
                41 => 'sonata.core.form.type.datetime_range_picker',
                42 => 'sonata.core.form.type.equal',
                43 => 'sonata.core.form.type.color_selector',
                44 => 'sonata.core.form.type.color',
                45 => 'sonata.block.form.type.block',
                46 => 'sonata.block.form.type.container_template',
                47 => 'sonata.admin.form.type.admin',
                48 => 'sonata.admin.form.type.model_choice',
                49 => 'sonata.admin.form.type.model_list',
                50 => 'sonata.admin.form.type.model_reference',
                51 => 'sonata.admin.form.type.model_hidden',
                52 => 'sonata.admin.form.type.model_autocomplete',
                53 => 'sonata.admin.form.type.collection',
                54 => 'sonata.admin.doctrine_orm.form.type.choice_field_mask',
                55 => 'sonata.admin.form.filter.type.number',
                56 => 'sonata.admin.form.filter.type.choice',
                57 => 'sonata.admin.form.filter.type.default',
                58 => 'sonata.admin.form.filter.type.date',
                59 => 'sonata.admin.form.filter.type.daterange',
                60 => 'sonata.admin.form.filter.type.datetime',
                61 => 'sonata.admin.form.filter.type.datetime_range',
            ),
            'sonata.core.form.type_extensions' => array(
                0 => 'form.type_extension.form.http_foundation',
                1 => 'form.type_extension.form.validator',
                2 => 'form.type_extension.repeated.validator',
                3 => 'form.type_extension.submit.validator',
                4 => 'form.type_extension.upload.validator',
                5 => 'form.type_extension.csrf',
                6 => 'form.type_extension.form.data_collector',
                7 => 'fos_rest.form.extension.csrf_disable',
                8 => 'nelmio_api_doc.form.extension.description_form_type_extension',
                9 => 'sonata.admin.form.extension.field',
                10 => 'sonata.admin.form.extension.field.mopa',
                11 => 'sonata.admin.form.extension.choice',
            ),
        );
    }
}

class DoctrineORMEntityManager_000000000bc6206e000055ee6367fe948665dee8663b3ed20fa65d22263820c0 extends \Doctrine\ORM\EntityManager implements \ProxyManager\Proxy\VirtualProxyInterface
{

    /**
     * @var \Closure|null initializer responsible for generating the wrapped object
     */
    private $valueHolder5bbc48102967d049572354 = null;

    /**
     * @var \Closure|null initializer responsible for generating the wrapped object
     */
    private $initializer5bbc48102969d685735094 = null;

    /**
     * @var bool[] map of public properties of the parent class
     */
    private static $publicProperties5bbc48102962d538851186 = array(
        
    );

    /**
     * {@inheritDoc}
     */
    public function getConnection()
    {
        $this->initializer5bbc48102969d685735094 && ($this->initializer5bbc48102969d685735094->__invoke($valueHolder5bbc48102967d049572354, $this, 'getConnection', array(), $this->initializer5bbc48102969d685735094) || 1) && $this->valueHolder5bbc48102967d049572354 = $valueHolder5bbc48102967d049572354;

        return $this->valueHolder5bbc48102967d049572354->getConnection();
    }

    /**
     * {@inheritDoc}
     */
    public function getMetadataFactory()
    {
        $this->initializer5bbc48102969d685735094 && ($this->initializer5bbc48102969d685735094->__invoke($valueHolder5bbc48102967d049572354, $this, 'getMetadataFactory', array(), $this->initializer5bbc48102969d685735094) || 1) && $this->valueHolder5bbc48102967d049572354 = $valueHolder5bbc48102967d049572354;

        return $this->valueHolder5bbc48102967d049572354->getMetadataFactory();
    }

    /**
     * {@inheritDoc}
     */
    public function getExpressionBuilder()
    {
        $this->initializer5bbc48102969d685735094 && ($this->initializer5bbc48102969d685735094->__invoke($valueHolder5bbc48102967d049572354, $this, 'getExpressionBuilder', array(), $this->initializer5bbc48102969d685735094) || 1) && $this->valueHolder5bbc48102967d049572354 = $valueHolder5bbc48102967d049572354;

        return $this->valueHolder5bbc48102967d049572354->getExpressionBuilder();
    }

    /**
     * {@inheritDoc}
     */
    public function beginTransaction()
    {
        $this->initializer5bbc48102969d685735094 && ($this->initializer5bbc48102969d685735094->__invoke($valueHolder5bbc48102967d049572354, $this, 'beginTransaction', array(), $this->initializer5bbc48102969d685735094) || 1) && $this->valueHolder5bbc48102967d049572354 = $valueHolder5bbc48102967d049572354;

        return $this->valueHolder5bbc48102967d049572354->beginTransaction();
    }

    /**
     * {@inheritDoc}
     */
    public function getCache()
    {
        $this->initializer5bbc48102969d685735094 && ($this->initializer5bbc48102969d685735094->__invoke($valueHolder5bbc48102967d049572354, $this, 'getCache', array(), $this->initializer5bbc48102969d685735094) || 1) && $this->valueHolder5bbc48102967d049572354 = $valueHolder5bbc48102967d049572354;

        return $this->valueHolder5bbc48102967d049572354->getCache();
    }

    /**
     * {@inheritDoc}
     */
    public function transactional($func)
    {
        $this->initializer5bbc48102969d685735094 && ($this->initializer5bbc48102969d685735094->__invoke($valueHolder5bbc48102967d049572354, $this, 'transactional', array('func' => $func), $this->initializer5bbc48102969d685735094) || 1) && $this->valueHolder5bbc48102967d049572354 = $valueHolder5bbc48102967d049572354;

        return $this->valueHolder5bbc48102967d049572354->transactional($func);
    }

    /**
     * {@inheritDoc}
     */
    public function commit()
    {
        $this->initializer5bbc48102969d685735094 && ($this->initializer5bbc48102969d685735094->__invoke($valueHolder5bbc48102967d049572354, $this, 'commit', array(), $this->initializer5bbc48102969d685735094) || 1) && $this->valueHolder5bbc48102967d049572354 = $valueHolder5bbc48102967d049572354;

        return $this->valueHolder5bbc48102967d049572354->commit();
    }

    /**
     * {@inheritDoc}
     */
    public function rollback()
    {
        $this->initializer5bbc48102969d685735094 && ($this->initializer5bbc48102969d685735094->__invoke($valueHolder5bbc48102967d049572354, $this, 'rollback', array(), $this->initializer5bbc48102969d685735094) || 1) && $this->valueHolder5bbc48102967d049572354 = $valueHolder5bbc48102967d049572354;

        return $this->valueHolder5bbc48102967d049572354->rollback();
    }

    /**
     * {@inheritDoc}
     */
    public function getClassMetadata($className)
    {
        $this->initializer5bbc48102969d685735094 && ($this->initializer5bbc48102969d685735094->__invoke($valueHolder5bbc48102967d049572354, $this, 'getClassMetadata', array('className' => $className), $this->initializer5bbc48102969d685735094) || 1) && $this->valueHolder5bbc48102967d049572354 = $valueHolder5bbc48102967d049572354;

        return $this->valueHolder5bbc48102967d049572354->getClassMetadata($className);
    }

    /**
     * {@inheritDoc}
     */
    public function createQuery($dql = '')
    {
        $this->initializer5bbc48102969d685735094 && ($this->initializer5bbc48102969d685735094->__invoke($valueHolder5bbc48102967d049572354, $this, 'createQuery', array('dql' => $dql), $this->initializer5bbc48102969d685735094) || 1) && $this->valueHolder5bbc48102967d049572354 = $valueHolder5bbc48102967d049572354;

        return $this->valueHolder5bbc48102967d049572354->createQuery($dql);
    }

    /**
     * {@inheritDoc}
     */
    public function createNamedQuery($name)
    {
        $this->initializer5bbc48102969d685735094 && ($this->initializer5bbc48102969d685735094->__invoke($valueHolder5bbc48102967d049572354, $this, 'createNamedQuery', array('name' => $name), $this->initializer5bbc48102969d685735094) || 1) && $this->valueHolder5bbc48102967d049572354 = $valueHolder5bbc48102967d049572354;

        return $this->valueHolder5bbc48102967d049572354->createNamedQuery($name);
    }

    /**
     * {@inheritDoc}
     */
    public function createNativeQuery($sql, \Doctrine\ORM\Query\ResultSetMapping $rsm)
    {
        $this->initializer5bbc48102969d685735094 && ($this->initializer5bbc48102969d685735094->__invoke($valueHolder5bbc48102967d049572354, $this, 'createNativeQuery', array('sql' => $sql, 'rsm' => $rsm), $this->initializer5bbc48102969d685735094) || 1) && $this->valueHolder5bbc48102967d049572354 = $valueHolder5bbc48102967d049572354;

        return $this->valueHolder5bbc48102967d049572354->createNativeQuery($sql, $rsm);
    }

    /**
     * {@inheritDoc}
     */
    public function createNamedNativeQuery($name)
    {
        $this->initializer5bbc48102969d685735094 && ($this->initializer5bbc48102969d685735094->__invoke($valueHolder5bbc48102967d049572354, $this, 'createNamedNativeQuery', array('name' => $name), $this->initializer5bbc48102969d685735094) || 1) && $this->valueHolder5bbc48102967d049572354 = $valueHolder5bbc48102967d049572354;

        return $this->valueHolder5bbc48102967d049572354->createNamedNativeQuery($name);
    }

    /**
     * {@inheritDoc}
     */
    public function createQueryBuilder()
    {
        $this->initializer5bbc48102969d685735094 && ($this->initializer5bbc48102969d685735094->__invoke($valueHolder5bbc48102967d049572354, $this, 'createQueryBuilder', array(), $this->initializer5bbc48102969d685735094) || 1) && $this->valueHolder5bbc48102967d049572354 = $valueHolder5bbc48102967d049572354;

        return $this->valueHolder5bbc48102967d049572354->createQueryBuilder();
    }

    /**
     * {@inheritDoc}
     */
    public function flush($entity = null)
    {
        $this->initializer5bbc48102969d685735094 && ($this->initializer5bbc48102969d685735094->__invoke($valueHolder5bbc48102967d049572354, $this, 'flush', array('entity' => $entity), $this->initializer5bbc48102969d685735094) || 1) && $this->valueHolder5bbc48102967d049572354 = $valueHolder5bbc48102967d049572354;

        return $this->valueHolder5bbc48102967d049572354->flush($entity);
    }

    /**
     * {@inheritDoc}
     */
    public function find($entityName, $id, $lockMode = null, $lockVersion = null)
    {
        $this->initializer5bbc48102969d685735094 && ($this->initializer5bbc48102969d685735094->__invoke($valueHolder5bbc48102967d049572354, $this, 'find', array('entityName' => $entityName, 'id' => $id, 'lockMode' => $lockMode, 'lockVersion' => $lockVersion), $this->initializer5bbc48102969d685735094) || 1) && $this->valueHolder5bbc48102967d049572354 = $valueHolder5bbc48102967d049572354;

        return $this->valueHolder5bbc48102967d049572354->find($entityName, $id, $lockMode, $lockVersion);
    }

    /**
     * {@inheritDoc}
     */
    public function getReference($entityName, $id)
    {
        $this->initializer5bbc48102969d685735094 && ($this->initializer5bbc48102969d685735094->__invoke($valueHolder5bbc48102967d049572354, $this, 'getReference', array('entityName' => $entityName, 'id' => $id), $this->initializer5bbc48102969d685735094) || 1) && $this->valueHolder5bbc48102967d049572354 = $valueHolder5bbc48102967d049572354;

        return $this->valueHolder5bbc48102967d049572354->getReference($entityName, $id);
    }

    /**
     * {@inheritDoc}
     */
    public function getPartialReference($entityName, $identifier)
    {
        $this->initializer5bbc48102969d685735094 && ($this->initializer5bbc48102969d685735094->__invoke($valueHolder5bbc48102967d049572354, $this, 'getPartialReference', array('entityName' => $entityName, 'identifier' => $identifier), $this->initializer5bbc48102969d685735094) || 1) && $this->valueHolder5bbc48102967d049572354 = $valueHolder5bbc48102967d049572354;

        return $this->valueHolder5bbc48102967d049572354->getPartialReference($entityName, $identifier);
    }

    /**
     * {@inheritDoc}
     */
    public function clear($entityName = null)
    {
        $this->initializer5bbc48102969d685735094 && ($this->initializer5bbc48102969d685735094->__invoke($valueHolder5bbc48102967d049572354, $this, 'clear', array('entityName' => $entityName), $this->initializer5bbc48102969d685735094) || 1) && $this->valueHolder5bbc48102967d049572354 = $valueHolder5bbc48102967d049572354;

        return $this->valueHolder5bbc48102967d049572354->clear($entityName);
    }

    /**
     * {@inheritDoc}
     */
    public function close()
    {
        $this->initializer5bbc48102969d685735094 && ($this->initializer5bbc48102969d685735094->__invoke($valueHolder5bbc48102967d049572354, $this, 'close', array(), $this->initializer5bbc48102969d685735094) || 1) && $this->valueHolder5bbc48102967d049572354 = $valueHolder5bbc48102967d049572354;

        return $this->valueHolder5bbc48102967d049572354->close();
    }

    /**
     * {@inheritDoc}
     */
    public function persist($entity)
    {
        $this->initializer5bbc48102969d685735094 && ($this->initializer5bbc48102969d685735094->__invoke($valueHolder5bbc48102967d049572354, $this, 'persist', array('entity' => $entity), $this->initializer5bbc48102969d685735094) || 1) && $this->valueHolder5bbc48102967d049572354 = $valueHolder5bbc48102967d049572354;

        return $this->valueHolder5bbc48102967d049572354->persist($entity);
    }

    /**
     * {@inheritDoc}
     */
    public function remove($entity)
    {
        $this->initializer5bbc48102969d685735094 && ($this->initializer5bbc48102969d685735094->__invoke($valueHolder5bbc48102967d049572354, $this, 'remove', array('entity' => $entity), $this->initializer5bbc48102969d685735094) || 1) && $this->valueHolder5bbc48102967d049572354 = $valueHolder5bbc48102967d049572354;

        return $this->valueHolder5bbc48102967d049572354->remove($entity);
    }

    /**
     * {@inheritDoc}
     */
    public function refresh($entity)
    {
        $this->initializer5bbc48102969d685735094 && ($this->initializer5bbc48102969d685735094->__invoke($valueHolder5bbc48102967d049572354, $this, 'refresh', array('entity' => $entity), $this->initializer5bbc48102969d685735094) || 1) && $this->valueHolder5bbc48102967d049572354 = $valueHolder5bbc48102967d049572354;

        return $this->valueHolder5bbc48102967d049572354->refresh($entity);
    }

    /**
     * {@inheritDoc}
     */
    public function detach($entity)
    {
        $this->initializer5bbc48102969d685735094 && ($this->initializer5bbc48102969d685735094->__invoke($valueHolder5bbc48102967d049572354, $this, 'detach', array('entity' => $entity), $this->initializer5bbc48102969d685735094) || 1) && $this->valueHolder5bbc48102967d049572354 = $valueHolder5bbc48102967d049572354;

        return $this->valueHolder5bbc48102967d049572354->detach($entity);
    }

    /**
     * {@inheritDoc}
     */
    public function merge($entity)
    {
        $this->initializer5bbc48102969d685735094 && ($this->initializer5bbc48102969d685735094->__invoke($valueHolder5bbc48102967d049572354, $this, 'merge', array('entity' => $entity), $this->initializer5bbc48102969d685735094) || 1) && $this->valueHolder5bbc48102967d049572354 = $valueHolder5bbc48102967d049572354;

        return $this->valueHolder5bbc48102967d049572354->merge($entity);
    }

    /**
     * {@inheritDoc}
     */
    public function copy($entity, $deep = false)
    {
        $this->initializer5bbc48102969d685735094 && ($this->initializer5bbc48102969d685735094->__invoke($valueHolder5bbc48102967d049572354, $this, 'copy', array('entity' => $entity, 'deep' => $deep), $this->initializer5bbc48102969d685735094) || 1) && $this->valueHolder5bbc48102967d049572354 = $valueHolder5bbc48102967d049572354;

        return $this->valueHolder5bbc48102967d049572354->copy($entity, $deep);
    }

    /**
     * {@inheritDoc}
     */
    public function lock($entity, $lockMode, $lockVersion = null)
    {
        $this->initializer5bbc48102969d685735094 && ($this->initializer5bbc48102969d685735094->__invoke($valueHolder5bbc48102967d049572354, $this, 'lock', array('entity' => $entity, 'lockMode' => $lockMode, 'lockVersion' => $lockVersion), $this->initializer5bbc48102969d685735094) || 1) && $this->valueHolder5bbc48102967d049572354 = $valueHolder5bbc48102967d049572354;

        return $this->valueHolder5bbc48102967d049572354->lock($entity, $lockMode, $lockVersion);
    }

    /**
     * {@inheritDoc}
     */
    public function getRepository($entityName)
    {
        $this->initializer5bbc48102969d685735094 && ($this->initializer5bbc48102969d685735094->__invoke($valueHolder5bbc48102967d049572354, $this, 'getRepository', array('entityName' => $entityName), $this->initializer5bbc48102969d685735094) || 1) && $this->valueHolder5bbc48102967d049572354 = $valueHolder5bbc48102967d049572354;

        return $this->valueHolder5bbc48102967d049572354->getRepository($entityName);
    }

    /**
     * {@inheritDoc}
     */
    public function contains($entity)
    {
        $this->initializer5bbc48102969d685735094 && ($this->initializer5bbc48102969d685735094->__invoke($valueHolder5bbc48102967d049572354, $this, 'contains', array('entity' => $entity), $this->initializer5bbc48102969d685735094) || 1) && $this->valueHolder5bbc48102967d049572354 = $valueHolder5bbc48102967d049572354;

        return $this->valueHolder5bbc48102967d049572354->contains($entity);
    }

    /**
     * {@inheritDoc}
     */
    public function getEventManager()
    {
        $this->initializer5bbc48102969d685735094 && ($this->initializer5bbc48102969d685735094->__invoke($valueHolder5bbc48102967d049572354, $this, 'getEventManager', array(), $this->initializer5bbc48102969d685735094) || 1) && $this->valueHolder5bbc48102967d049572354 = $valueHolder5bbc48102967d049572354;

        return $this->valueHolder5bbc48102967d049572354->getEventManager();
    }

    /**
     * {@inheritDoc}
     */
    public function getConfiguration()
    {
        $this->initializer5bbc48102969d685735094 && ($this->initializer5bbc48102969d685735094->__invoke($valueHolder5bbc48102967d049572354, $this, 'getConfiguration', array(), $this->initializer5bbc48102969d685735094) || 1) && $this->valueHolder5bbc48102967d049572354 = $valueHolder5bbc48102967d049572354;

        return $this->valueHolder5bbc48102967d049572354->getConfiguration();
    }

    /**
     * {@inheritDoc}
     */
    public function isOpen()
    {
        $this->initializer5bbc48102969d685735094 && ($this->initializer5bbc48102969d685735094->__invoke($valueHolder5bbc48102967d049572354, $this, 'isOpen', array(), $this->initializer5bbc48102969d685735094) || 1) && $this->valueHolder5bbc48102967d049572354 = $valueHolder5bbc48102967d049572354;

        return $this->valueHolder5bbc48102967d049572354->isOpen();
    }

    /**
     * {@inheritDoc}
     */
    public function getUnitOfWork()
    {
        $this->initializer5bbc48102969d685735094 && ($this->initializer5bbc48102969d685735094->__invoke($valueHolder5bbc48102967d049572354, $this, 'getUnitOfWork', array(), $this->initializer5bbc48102969d685735094) || 1) && $this->valueHolder5bbc48102967d049572354 = $valueHolder5bbc48102967d049572354;

        return $this->valueHolder5bbc48102967d049572354->getUnitOfWork();
    }

    /**
     * {@inheritDoc}
     */
    public function getHydrator($hydrationMode)
    {
        $this->initializer5bbc48102969d685735094 && ($this->initializer5bbc48102969d685735094->__invoke($valueHolder5bbc48102967d049572354, $this, 'getHydrator', array('hydrationMode' => $hydrationMode), $this->initializer5bbc48102969d685735094) || 1) && $this->valueHolder5bbc48102967d049572354 = $valueHolder5bbc48102967d049572354;

        return $this->valueHolder5bbc48102967d049572354->getHydrator($hydrationMode);
    }

    /**
     * {@inheritDoc}
     */
    public function newHydrator($hydrationMode)
    {
        $this->initializer5bbc48102969d685735094 && ($this->initializer5bbc48102969d685735094->__invoke($valueHolder5bbc48102967d049572354, $this, 'newHydrator', array('hydrationMode' => $hydrationMode), $this->initializer5bbc48102969d685735094) || 1) && $this->valueHolder5bbc48102967d049572354 = $valueHolder5bbc48102967d049572354;

        return $this->valueHolder5bbc48102967d049572354->newHydrator($hydrationMode);
    }

    /**
     * {@inheritDoc}
     */
    public function getProxyFactory()
    {
        $this->initializer5bbc48102969d685735094 && ($this->initializer5bbc48102969d685735094->__invoke($valueHolder5bbc48102967d049572354, $this, 'getProxyFactory', array(), $this->initializer5bbc48102969d685735094) || 1) && $this->valueHolder5bbc48102967d049572354 = $valueHolder5bbc48102967d049572354;

        return $this->valueHolder5bbc48102967d049572354->getProxyFactory();
    }

    /**
     * {@inheritDoc}
     */
    public function initializeObject($obj)
    {
        $this->initializer5bbc48102969d685735094 && ($this->initializer5bbc48102969d685735094->__invoke($valueHolder5bbc48102967d049572354, $this, 'initializeObject', array('obj' => $obj), $this->initializer5bbc48102969d685735094) || 1) && $this->valueHolder5bbc48102967d049572354 = $valueHolder5bbc48102967d049572354;

        return $this->valueHolder5bbc48102967d049572354->initializeObject($obj);
    }

    /**
     * {@inheritDoc}
     */
    public function getFilters()
    {
        $this->initializer5bbc48102969d685735094 && ($this->initializer5bbc48102969d685735094->__invoke($valueHolder5bbc48102967d049572354, $this, 'getFilters', array(), $this->initializer5bbc48102969d685735094) || 1) && $this->valueHolder5bbc48102967d049572354 = $valueHolder5bbc48102967d049572354;

        return $this->valueHolder5bbc48102967d049572354->getFilters();
    }

    /**
     * {@inheritDoc}
     */
    public function isFiltersStateClean()
    {
        $this->initializer5bbc48102969d685735094 && ($this->initializer5bbc48102969d685735094->__invoke($valueHolder5bbc48102967d049572354, $this, 'isFiltersStateClean', array(), $this->initializer5bbc48102969d685735094) || 1) && $this->valueHolder5bbc48102967d049572354 = $valueHolder5bbc48102967d049572354;

        return $this->valueHolder5bbc48102967d049572354->isFiltersStateClean();
    }

    /**
     * {@inheritDoc}
     */
    public function hasFilters()
    {
        $this->initializer5bbc48102969d685735094 && ($this->initializer5bbc48102969d685735094->__invoke($valueHolder5bbc48102967d049572354, $this, 'hasFilters', array(), $this->initializer5bbc48102969d685735094) || 1) && $this->valueHolder5bbc48102967d049572354 = $valueHolder5bbc48102967d049572354;

        return $this->valueHolder5bbc48102967d049572354->hasFilters();
    }

    /**
     * @override constructor for lazy initialization
     *
     * @param \Closure|null $initializer
     */
    public function __construct($initializer)
    {
        $this->initializer5bbc48102969d685735094 = $initializer;
    }

    /**
     * @param string $name
     */
    public function & __get($name)
    {
        $this->initializer5bbc48102969d685735094 && ($this->initializer5bbc48102969d685735094->__invoke($valueHolder5bbc48102967d049572354, $this, '__get', array('name' => $name), $this->initializer5bbc48102969d685735094) || 1) && $this->valueHolder5bbc48102967d049572354 = $valueHolder5bbc48102967d049572354;

        if (isset(self::$publicProperties5bbc48102962d538851186[$name])) {
            return $this->valueHolder5bbc48102967d049572354->$name;
        }

        $realInstanceReflection = new \ReflectionClass(get_parent_class($this));

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolder5bbc48102967d049572354;

            $backtrace = debug_backtrace(false);
            trigger_error('Undefined property: ' . get_parent_class($this) . '::$' . $name . ' in ' . $backtrace[0]['file'] . ' on line ' . $backtrace[0]['line'], \E_USER_NOTICE);
            return $targetObject->$name;;
            return;
        }

        $targetObject = $this->valueHolder5bbc48102967d049572354;
        $accessor = function & () use ($targetObject, $name) {
            return $targetObject->$name;
        };
            $backtrace = debug_backtrace(true);
            $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new \stdClass();
            $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $returnValue = & $accessor();

        return $returnValue;
    }

    /**
     * @param string $name
     * @param mixed $value
     */
    public function __set($name, $value)
    {
        $this->initializer5bbc48102969d685735094 && ($this->initializer5bbc48102969d685735094->__invoke($valueHolder5bbc48102967d049572354, $this, '__set', array('name' => $name, 'value' => $value), $this->initializer5bbc48102969d685735094) || 1) && $this->valueHolder5bbc48102967d049572354 = $valueHolder5bbc48102967d049572354;

        $realInstanceReflection = new \ReflectionClass(get_parent_class($this));

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolder5bbc48102967d049572354;

            return $targetObject->$name = $value;;
            return;
        }

        $targetObject = $this->valueHolder5bbc48102967d049572354;
        $accessor = function & () use ($targetObject, $name, $value) {
            return $targetObject->$name = $value;
        };
            $backtrace = debug_backtrace(true);
            $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new \stdClass();
            $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $returnValue = & $accessor();

        return $returnValue;
    }

    /**
     * @param string $name
     */
    public function __isset($name)
    {
        $this->initializer5bbc48102969d685735094 && ($this->initializer5bbc48102969d685735094->__invoke($valueHolder5bbc48102967d049572354, $this, '__isset', array('name' => $name), $this->initializer5bbc48102969d685735094) || 1) && $this->valueHolder5bbc48102967d049572354 = $valueHolder5bbc48102967d049572354;

        $realInstanceReflection = new \ReflectionClass(get_parent_class($this));

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolder5bbc48102967d049572354;

            return isset($targetObject->$name);;
            return;
        }

        $targetObject = $this->valueHolder5bbc48102967d049572354;
        $accessor = function () use ($targetObject, $name) {
            return isset($targetObject->$name);
        };
            $backtrace = debug_backtrace(true);
            $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new \stdClass();
            $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $returnValue = $accessor();

        return $returnValue;
    }

    /**
     * @param string $name
     */
    public function __unset($name)
    {
        $this->initializer5bbc48102969d685735094 && ($this->initializer5bbc48102969d685735094->__invoke($valueHolder5bbc48102967d049572354, $this, '__unset', array('name' => $name), $this->initializer5bbc48102969d685735094) || 1) && $this->valueHolder5bbc48102967d049572354 = $valueHolder5bbc48102967d049572354;

        $realInstanceReflection = new \ReflectionClass(get_parent_class($this));

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolder5bbc48102967d049572354;

            unset($targetObject->$name);;
            return;
        }

        $targetObject = $this->valueHolder5bbc48102967d049572354;
        $accessor = function () use ($targetObject, $name) {
            unset($targetObject->$name);
        };
            $backtrace = debug_backtrace(true);
            $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new \stdClass();
            $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $returnValue = $accessor();

        return $returnValue;
    }

    public function __clone()
    {
        $this->initializer5bbc48102969d685735094 && ($this->initializer5bbc48102969d685735094->__invoke($valueHolder5bbc48102967d049572354, $this, '__clone', array(), $this->initializer5bbc48102969d685735094) || 1) && $this->valueHolder5bbc48102967d049572354 = $valueHolder5bbc48102967d049572354;

        $this->valueHolder5bbc48102967d049572354 = clone $this->valueHolder5bbc48102967d049572354;
    }

    public function __sleep()
    {
        $this->initializer5bbc48102969d685735094 && ($this->initializer5bbc48102969d685735094->__invoke($valueHolder5bbc48102967d049572354, $this, '__sleep', array(), $this->initializer5bbc48102969d685735094) || 1) && $this->valueHolder5bbc48102967d049572354 = $valueHolder5bbc48102967d049572354;

        return array('valueHolder5bbc48102967d049572354');
    }

    public function __wakeup()
    {
    }

    /**
     * {@inheritDoc}
     */
    public function setProxyInitializer(\Closure $initializer = null)
    {
        $this->initializer5bbc48102969d685735094 = $initializer;
    }

    /**
     * {@inheritDoc}
     */
    public function getProxyInitializer()
    {
        return $this->initializer5bbc48102969d685735094;
    }

    /**
     * {@inheritDoc}
     */
    public function initializeProxy()
    {
        return $this->initializer5bbc48102969d685735094 && ($this->initializer5bbc48102969d685735094->__invoke($valueHolder5bbc48102967d049572354, $this, 'initializeProxy', array(), $this->initializer5bbc48102969d685735094) || 1) && $this->valueHolder5bbc48102967d049572354 = $valueHolder5bbc48102967d049572354;
    }

    /**
     * {@inheritDoc}
     */
    public function isProxyInitialized()
    {
        return null !== $this->valueHolder5bbc48102967d049572354;
    }

    /**
     * {@inheritDoc}
     */
    public function getWrappedValueHolderValue()
    {
        return $this->valueHolder5bbc48102967d049572354;
    }


}

class FOSRestBundleSerializerJMSSerializerAdapter_000000000bc63710000055ee6367fe948665dee8663b3ed20fa65d22263820c0 extends \FOS\RestBundle\Serializer\JMSSerializerAdapter implements \ProxyManager\Proxy\VirtualProxyInterface
{

    /**
     * @var \Closure|null initializer responsible for generating the wrapped object
     */
    private $valueHolder5bbc48103cd42044805217 = null;

    /**
     * @var \Closure|null initializer responsible for generating the wrapped object
     */
    private $initializer5bbc48103cd59242397848 = null;

    /**
     * @var bool[] map of public properties of the parent class
     */
    private static $publicProperties5bbc48103cd0d942395385 = array(
        
    );

    /**
     * {@inheritDoc}
     */
    public function serialize($data, $format, $context = null)
    {
        $this->initializer5bbc48103cd59242397848 && ($this->initializer5bbc48103cd59242397848->__invoke($valueHolder5bbc48103cd42044805217, $this, 'serialize', array('data' => $data, 'format' => $format, 'context' => $context), $this->initializer5bbc48103cd59242397848) || 1) && $this->valueHolder5bbc48103cd42044805217 = $valueHolder5bbc48103cd42044805217;

        return $this->valueHolder5bbc48103cd42044805217->serialize($data, $format, $context);
    }

    /**
     * {@inheritDoc}
     */
    public function deserialize($data, $type, $format, $context = null)
    {
        $this->initializer5bbc48103cd59242397848 && ($this->initializer5bbc48103cd59242397848->__invoke($valueHolder5bbc48103cd42044805217, $this, 'deserialize', array('data' => $data, 'type' => $type, 'format' => $format, 'context' => $context), $this->initializer5bbc48103cd59242397848) || 1) && $this->valueHolder5bbc48103cd42044805217 = $valueHolder5bbc48103cd42044805217;

        return $this->valueHolder5bbc48103cd42044805217->deserialize($data, $type, $format, $context);
    }

    /**
     * @override constructor for lazy initialization
     *
     * @param \Closure|null $initializer
     */
    public function __construct($initializer)
    {
        $this->initializer5bbc48103cd59242397848 = $initializer;
    }

    /**
     * @param string $name
     */
    public function & __get($name)
    {
        $this->initializer5bbc48103cd59242397848 && ($this->initializer5bbc48103cd59242397848->__invoke($valueHolder5bbc48103cd42044805217, $this, '__get', array('name' => $name), $this->initializer5bbc48103cd59242397848) || 1) && $this->valueHolder5bbc48103cd42044805217 = $valueHolder5bbc48103cd42044805217;

        if (isset(self::$publicProperties5bbc48103cd0d942395385[$name])) {
            return $this->valueHolder5bbc48103cd42044805217->$name;
        }

        $realInstanceReflection = new \ReflectionClass(get_parent_class($this));

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolder5bbc48103cd42044805217;

            $backtrace = debug_backtrace(false);
            trigger_error('Undefined property: ' . get_parent_class($this) . '::$' . $name . ' in ' . $backtrace[0]['file'] . ' on line ' . $backtrace[0]['line'], \E_USER_NOTICE);
            return $targetObject->$name;;
            return;
        }

        $targetObject = $this->valueHolder5bbc48103cd42044805217;
        $accessor = function & () use ($targetObject, $name) {
            return $targetObject->$name;
        };
            $backtrace = debug_backtrace(true);
            $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new \stdClass();
            $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $returnValue = & $accessor();

        return $returnValue;
    }

    /**
     * @param string $name
     * @param mixed $value
     */
    public function __set($name, $value)
    {
        $this->initializer5bbc48103cd59242397848 && ($this->initializer5bbc48103cd59242397848->__invoke($valueHolder5bbc48103cd42044805217, $this, '__set', array('name' => $name, 'value' => $value), $this->initializer5bbc48103cd59242397848) || 1) && $this->valueHolder5bbc48103cd42044805217 = $valueHolder5bbc48103cd42044805217;

        $realInstanceReflection = new \ReflectionClass(get_parent_class($this));

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolder5bbc48103cd42044805217;

            return $targetObject->$name = $value;;
            return;
        }

        $targetObject = $this->valueHolder5bbc48103cd42044805217;
        $accessor = function & () use ($targetObject, $name, $value) {
            return $targetObject->$name = $value;
        };
            $backtrace = debug_backtrace(true);
            $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new \stdClass();
            $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $returnValue = & $accessor();

        return $returnValue;
    }

    /**
     * @param string $name
     */
    public function __isset($name)
    {
        $this->initializer5bbc48103cd59242397848 && ($this->initializer5bbc48103cd59242397848->__invoke($valueHolder5bbc48103cd42044805217, $this, '__isset', array('name' => $name), $this->initializer5bbc48103cd59242397848) || 1) && $this->valueHolder5bbc48103cd42044805217 = $valueHolder5bbc48103cd42044805217;

        $realInstanceReflection = new \ReflectionClass(get_parent_class($this));

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolder5bbc48103cd42044805217;

            return isset($targetObject->$name);;
            return;
        }

        $targetObject = $this->valueHolder5bbc48103cd42044805217;
        $accessor = function () use ($targetObject, $name) {
            return isset($targetObject->$name);
        };
            $backtrace = debug_backtrace(true);
            $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new \stdClass();
            $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $returnValue = $accessor();

        return $returnValue;
    }

    /**
     * @param string $name
     */
    public function __unset($name)
    {
        $this->initializer5bbc48103cd59242397848 && ($this->initializer5bbc48103cd59242397848->__invoke($valueHolder5bbc48103cd42044805217, $this, '__unset', array('name' => $name), $this->initializer5bbc48103cd59242397848) || 1) && $this->valueHolder5bbc48103cd42044805217 = $valueHolder5bbc48103cd42044805217;

        $realInstanceReflection = new \ReflectionClass(get_parent_class($this));

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolder5bbc48103cd42044805217;

            unset($targetObject->$name);;
            return;
        }

        $targetObject = $this->valueHolder5bbc48103cd42044805217;
        $accessor = function () use ($targetObject, $name) {
            unset($targetObject->$name);
        };
            $backtrace = debug_backtrace(true);
            $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new \stdClass();
            $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $returnValue = $accessor();

        return $returnValue;
    }

    public function __clone()
    {
        $this->initializer5bbc48103cd59242397848 && ($this->initializer5bbc48103cd59242397848->__invoke($valueHolder5bbc48103cd42044805217, $this, '__clone', array(), $this->initializer5bbc48103cd59242397848) || 1) && $this->valueHolder5bbc48103cd42044805217 = $valueHolder5bbc48103cd42044805217;

        $this->valueHolder5bbc48103cd42044805217 = clone $this->valueHolder5bbc48103cd42044805217;
    }

    public function __sleep()
    {
        $this->initializer5bbc48103cd59242397848 && ($this->initializer5bbc48103cd59242397848->__invoke($valueHolder5bbc48103cd42044805217, $this, '__sleep', array(), $this->initializer5bbc48103cd59242397848) || 1) && $this->valueHolder5bbc48103cd42044805217 = $valueHolder5bbc48103cd42044805217;

        return array('valueHolder5bbc48103cd42044805217');
    }

    public function __wakeup()
    {
    }

    /**
     * {@inheritDoc}
     */
    public function setProxyInitializer(\Closure $initializer = null)
    {
        $this->initializer5bbc48103cd59242397848 = $initializer;
    }

    /**
     * {@inheritDoc}
     */
    public function getProxyInitializer()
    {
        return $this->initializer5bbc48103cd59242397848;
    }

    /**
     * {@inheritDoc}
     */
    public function initializeProxy()
    {
        return $this->initializer5bbc48103cd59242397848 && ($this->initializer5bbc48103cd59242397848->__invoke($valueHolder5bbc48103cd42044805217, $this, 'initializeProxy', array(), $this->initializer5bbc48103cd59242397848) || 1) && $this->valueHolder5bbc48103cd42044805217 = $valueHolder5bbc48103cd42044805217;
    }

    /**
     * {@inheritDoc}
     */
    public function isProxyInitialized()
    {
        return null !== $this->valueHolder5bbc48103cd42044805217;
    }

    /**
     * {@inheritDoc}
     */
    public function getWrappedValueHolderValue()
    {
        return $this->valueHolder5bbc48103cd42044805217;
    }


}
