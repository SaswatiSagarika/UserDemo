<?php

/* MainBundle:response:myform.html.twig */
class __TwigTemplate_a2f9d09591c4e2dc676fa38f7110e5ef1e470787629e148493159f77b7abc03d extends Twig_Template
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
    }

    public function getTemplateName()
    {
        return "MainBundle:response:myform.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "MainBundle:response:myform.html.twig", "/var/www/html/EcommerceTe/src/Sch/MainBundle/Resources/views/response/myform.html.twig");
    }
}
