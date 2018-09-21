<?php

/* MainBundle:Default:index.html.twig */
class __TwigTemplate_62fe45d53dbc96b751d53d82c65cdd9f5489dce29c55d9a7b7d15273595443b8 extends Twig_Template
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
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_stylesheets($context, array $blocks = array())
    {
        echo " 
  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
  <link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css\">
";
    }

    // line 7
    public function block_javascripts($context, array $blocks = array())
    {
        echo " 
   <script language = \"javascript\" 
      src = \"https://code.jquery.com/jquery-2.2.4.min.js\"></script> 
  <script src=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js\"></script>
   <script language = \"javascript\">  
      \t\$(document).ready(function(){
        \t\$(\"button\").click(function(){
\t         \tvar formData = \$('#content').val()


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
\t\t                url:        '/app_dev.php/api/getRevenue',  
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
    }

    // line 62
    public function block_body($context, array $blocks = array())
    {
        echo " 
<div class=\"container\" id=\"result\">
  
\t<form class=\"form-inline\" action=\"\">
\t\t<div class=\"form-group\">
\t\t\t<label for=\"email\">Verb:</label>
\t\t\t<input type=\"text\" id=\"verb\" class=\"verb\" name=\"Verb\" value=\"GET\">
\t\t</div>
\t\t<div class=\"form-group\">
\t\t\t<label for=\"pwd\">Content:</label>
\t\t\t<textarea  id=\"content\" class=\"content\" name=\"content\" required></textarea>
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
        return array (  98 => 62,  39 => 7,  30 => 3,  11 => 2,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "MainBundle:Default:index.html.twig", "/var/www/html/EcommerceTe/src/Sch/MainBundle/Resources/views/Default/index.html.twig");
    }
}
