<?php

/* MainBundle:Default:index.html.twig */
class __TwigTemplate_fda6f76283ce8b3c9ef001a623d3225a2d07f7eae9c3b79537f3bd0112c28b05 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 2
        $this->parent = $this->loadTemplate("::base.html.twig", "MainBundle:Default:index.html.twig", 2);
        $this->blocks = array(
            'stylesheets' => array($this, 'block_stylesheets'),
            'javascripts' => array($this, 'block_javascripts'),
            'body' => array($this, 'block_body'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "::base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "MainBundle:Default:index.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    // line 3
    public function block_stylesheets($context, array $blocks = array())
    {
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "stylesheets"));

        echo " 
  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
  <link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css\">
";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    // line 7
    public function block_javascripts($context, array $blocks = array())
    {
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "javascripts"));

        echo " 
   <script language = \"javascript\" 
      src = \"https://code.jquery.com/jquery-2.2.4.min.js\"></script> 
  <script src=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js\"></script>
   <script language = \"javascript\">  
      \t\$(document).ready(function(){
        \t\$(\"button\").click(function(){
\t         \tvar formData = \$('#content').val()
\t         \tvar Verb = \$('#verb option:selected').val()
\t         \tvar url = \$('#url').val()
\t         \t
\t\t\t\tif (formData.length == 0) {
\t\t\t\t \t\$(\".error\").html(\"<p>Content field is Empty. Please provide some filtered data</p>\");
\t\t\t\t}

\t\t        var checkformData = isJSON(formData)

\t\t        if(!checkformData){
\t\t\t        if (formData == 0) {
\t\t\t\t\t \t\$(\".error\").html(\"<p>Content field is Empty. Please provide some filtered data</p>\");
\t\t\t\t\t} else{
\t\t         \t\t\$(\".error\").html(\"<p>Please provide some enter valid json format. Check the Request Type from below:</p>\");
\t\t         \t}
\t\t        } else {
\t\t        \t\$.ajax({  
\t\t                url:        url,  
\t\t               \ttype:       'GET',  
\t\t               \tdata: \t\t{data: formData},
\t\t               \tdataType:   'json',  
\t\t               \tasync:      true,
\t\t               \tsuccess: function(data) {  
\t\t                   \$(\"#result\").html(JSON.stringify(data));
\t\t               \t},  
\t\t               \terror : function(xhr, textStatus, errorThrown) {  
\t\t                \tconsole.log(textStatus);
\t\t               \t}  
\t\t            }); 
\t\t        }
\t 
\t        });  
     \t});  

\t    function isJSON(str) {

\t\t    if( typeof( str ) !== 'string' ) { 
\t\t        return false;
\t\t    }
\t\t    try {
\t\t        if (JSON.parse(str)) return true;
\t\t    } catch (e) {
\t\t        return false;
\t\t    }
\t\t}
   </script> 
";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    // line 63
    public function block_body($context, array $blocks = array())
    {
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        echo " 
<div class=\"container\" id=\"result\">
  
\t<form class=\"form-inline\" action=\"\">
\t\t<div class=\"form-group\">
\t\t\t<label for=\"verb\">Verb:</label>
\t\t\t<select name=\"verb\" id=\"verb\" class=\"verb\">
\t\t\t\t<option value=\"GET\">GET</option>
\t\t\t\t<option value=\"POST\">POST</option>
\t\t\t</select>
\t\t</div>
\t\t<div class=\"form-group\">
\t\t\t<label for=\"pwd\">Content:</label>
\t\t\t<textarea  id=\"content\" class=\"content\" name=\"content\" required></textarea>
\t\t</div>
\t\t<div class=\"form-group\">
\t\t\t<label for=\"url\">url:</label>
\t\t\t<input type=\"text\" id=\"url\" class=\"url\" name=\"url\">
\t\t</div>
\t\t<button type=\"button\" class=\"btn btn-default\">Submit</button>
\t</form>
<p>
\tPlease enter the content in the below json format
</p>
\tRequest Type::
        {\"year\":\"2018\",\"productType\":\"Cooking Gear\",\"productLine\":\"Camping Equipment\",\"retailerType\":\"Outdoors Shop\",\"product\":\"Camping Equipment\",\"retailerCountry\":\"United States\",\"quater\":\"Q1 2012\",\"orderType\":\"Fax\"}</td>
        <td>Json with filter values</td>
   
</div>
";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    public function getTemplateName()
    {
        return "MainBundle:Default:index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  117 => 63,  51 => 7,  36 => 3,  11 => 2,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("
{% extends '::base.html.twig' %} 
{% block stylesheets %} 
  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
  <link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css\">
{% endblock %}
{% block javascripts %} 
   <script language = \"javascript\" 
      src = \"https://code.jquery.com/jquery-2.2.4.min.js\"></script> 
  <script src=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js\"></script>
   <script language = \"javascript\">  
      \t\$(document).ready(function(){
        \t\$(\"button\").click(function(){
\t         \tvar formData = \$('#content').val()
\t         \tvar Verb = \$('#verb option:selected').val()
\t         \tvar url = \$('#url').val()
\t         \t
\t\t\t\tif (formData.length == 0) {
\t\t\t\t \t\$(\".error\").html(\"<p>Content field is Empty. Please provide some filtered data</p>\");
\t\t\t\t}

\t\t        var checkformData = isJSON(formData)

\t\t        if(!checkformData){
\t\t\t        if (formData == 0) {
\t\t\t\t\t \t\$(\".error\").html(\"<p>Content field is Empty. Please provide some filtered data</p>\");
\t\t\t\t\t} else{
\t\t         \t\t\$(\".error\").html(\"<p>Please provide some enter valid json format. Check the Request Type from below:</p>\");
\t\t         \t}
\t\t        } else {
\t\t        \t\$.ajax({  
\t\t                url:        url,  
\t\t               \ttype:       'GET',  
\t\t               \tdata: \t\t{data: formData},
\t\t               \tdataType:   'json',  
\t\t               \tasync:      true,
\t\t               \tsuccess: function(data) {  
\t\t                   \$(\"#result\").html(JSON.stringify(data));
\t\t               \t},  
\t\t               \terror : function(xhr, textStatus, errorThrown) {  
\t\t                \tconsole.log(textStatus);
\t\t               \t}  
\t\t            }); 
\t\t        }
\t 
\t        });  
     \t});  

\t    function isJSON(str) {

\t\t    if( typeof( str ) !== 'string' ) { 
\t\t        return false;
\t\t    }
\t\t    try {
\t\t        if (JSON.parse(str)) return true;
\t\t    } catch (e) {
\t\t        return false;
\t\t    }
\t\t}
   </script> 
{% endblock %}

{% block body %} 
<div class=\"container\" id=\"result\">
  
\t<form class=\"form-inline\" action=\"\">
\t\t<div class=\"form-group\">
\t\t\t<label for=\"verb\">Verb:</label>
\t\t\t<select name=\"verb\" id=\"verb\" class=\"verb\">
\t\t\t\t<option value=\"GET\">GET</option>
\t\t\t\t<option value=\"POST\">POST</option>
\t\t\t</select>
\t\t</div>
\t\t<div class=\"form-group\">
\t\t\t<label for=\"pwd\">Content:</label>
\t\t\t<textarea  id=\"content\" class=\"content\" name=\"content\" required></textarea>
\t\t</div>
\t\t<div class=\"form-group\">
\t\t\t<label for=\"url\">url:</label>
\t\t\t<input type=\"text\" id=\"url\" class=\"url\" name=\"url\">
\t\t</div>
\t\t<button type=\"button\" class=\"btn btn-default\">Submit</button>
\t</form>
<p>
\tPlease enter the content in the below json format
</p>
\tRequest Type::
        {\"year\":\"2018\",\"productType\":\"Cooking Gear\",\"productLine\":\"Camping Equipment\",\"retailerType\":\"Outdoors Shop\",\"product\":\"Camping Equipment\",\"retailerCountry\":\"United States\",\"quater\":\"Q1 2012\",\"orderType\":\"Fax\"}</td>
        <td>Json with filter values</td>
   
</div>
{% endblock %} ", "MainBundle:Default:index.html.twig", "/var/www/html/UserDemo/src/Sch/MainBundle/Resources/views/Default/index.html.twig");
    }
}
