<?php

/* MainBundle:response:myform.html.twig */
class __TwigTemplate_f14fffa4ae2aeb9764ac233e42b87029c885ca98250e177d555ba2a01d55ff38 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "MainBundle:response:myform.html.twig"));

        // line 1
        echo "<!DOCTYPE html>
<html>
<body>

<h2>HTML Forms</h2>

<form action=\"/action_page.php\">
  Verb:<br>
  <input type=\"text\" name=\"Verb\" value=\"GET\">
  <br>
  Content:<br>
  <textarea></textarea>
  <br><br>
  <input type=\"submit\" value=\"Submit\">
</form> 

<p>If you click the \"Submit\" button, the form-data will be sent to a page called \"/action_page.php\".</p>

</body>
</html>
";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    public function getTemplateName()
    {
        return "MainBundle:response:myform.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  22 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<!DOCTYPE html>
<html>
<body>

<h2>HTML Forms</h2>

<form action=\"/action_page.php\">
  Verb:<br>
  <input type=\"text\" name=\"Verb\" value=\"GET\">
  <br>
  Content:<br>
  <textarea></textarea>
  <br><br>
  <input type=\"submit\" value=\"Submit\">
</form> 

<p>If you click the \"Submit\" button, the form-data will be sent to a page called \"/action_page.php\".</p>

</body>
</html>
", "MainBundle:response:myform.html.twig", "/var/www/html/EcommerceTe/src/Sch/MainBundle/Resources/views/response/myform.html.twig");
    }
}
