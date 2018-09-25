<?php

/* SonataAdminBundle:CRUD:dashboard__action_create.html.twig */
class __TwigTemplate_fba4ed713738f514536b614afdc9aaf6455293e1b9e6ad30e72af175cdece191 extends Twig_Template
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
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataAdminBundle:CRUD:dashboard__action_create.html.twig"));

        // line 1
        if (twig_test_empty($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "subClasses", array()))) {
            // line 2
            echo "    <a class=\"btn btn-link btn-flat\" href=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["action"]) ? $context["action"] : $this->getContext($context, "action")), "url", array()), "html", null, true);
            echo "\">
        <i class=\"fa fa-";
            // line 3
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["action"]) ? $context["action"] : $this->getContext($context, "action")), "icon", array()), "html", null, true);
            echo "\" aria-hidden=\"true\"></i>
        ";
            // line 4
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans($this->getAttribute((isset($context["action"]) ? $context["action"] : $this->getContext($context, "action")), "label", array()), array(), (($this->getAttribute((isset($context["action"]) ? $context["action"] : null), "translation_domain", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["action"]) ? $context["action"] : null), "translation_domain", array()), "SonataAdminBundle")) : ("SonataAdminBundle"))), "html", null, true);
            echo "
    </a>
";
        } else {
            // line 7
            echo "    <a class=\"btn btn-link btn-flat dropdown-toggle\" data-toggle=\"dropdown\" href=\"#\">
        <i class=\"fa fa-";
            // line 8
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["action"]) ? $context["action"] : $this->getContext($context, "action")), "icon", array()), "html", null, true);
            echo "\" aria-hidden=\"true\"></i>
        ";
            // line 9
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans($this->getAttribute((isset($context["action"]) ? $context["action"] : $this->getContext($context, "action")), "label", array()), array(), (($this->getAttribute((isset($context["action"]) ? $context["action"] : null), "translation_domain", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["action"]) ? $context["action"] : null), "translation_domain", array()), "SonataAdminBundle")) : ("SonataAdminBundle"))), "html", null, true);
            echo "
        <span class=\"caret\"></span>
    </a>
    <ul class=\"dropdown-menu\">
        ";
            // line 13
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_array_keys_filter($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "subclasses", array())));
            foreach ($context['_seq'] as $context["_key"] => $context["subclass"]) {
                // line 14
                echo "            <li>
                <a href=\"";
                // line 15
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateUrl", array(0 => "create", 1 => array("subclass" => $context["subclass"])), "method"), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans($context["subclass"], array(), (($this->getAttribute((isset($context["action"]) ? $context["action"] : null), "translation_domain", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["action"]) ? $context["action"] : null), "translation_domain", array()), "SonataAdminBundle")) : ("SonataAdminBundle"))), "html", null, true);
                echo "</a>
            </li>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['subclass'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 18
            echo "    </ul>
";
        }
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    public function getTemplateName()
    {
        return "SonataAdminBundle:CRUD:dashboard__action_create.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  71 => 18,  60 => 15,  57 => 14,  53 => 13,  46 => 9,  42 => 8,  39 => 7,  33 => 4,  29 => 3,  24 => 2,  22 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% if admin.subClasses is empty %}
    <a class=\"btn btn-link btn-flat\" href=\"{{ action.url }}\">
        <i class=\"fa fa-{{ action.icon }}\" aria-hidden=\"true\"></i>
        {{ action.label|trans({}, action.translation_domain|default('SonataAdminBundle')) }}
    </a>
{% else %}
    <a class=\"btn btn-link btn-flat dropdown-toggle\" data-toggle=\"dropdown\" href=\"#\">
        <i class=\"fa fa-{{ action.icon }}\" aria-hidden=\"true\"></i>
        {{ action.label|trans({}, action.translation_domain|default('SonataAdminBundle')) }}
        <span class=\"caret\"></span>
    </a>
    <ul class=\"dropdown-menu\">
        {% for subclass in admin.subclasses|keys %}
            <li>
                <a href=\"{{ admin.generateUrl('create', {'subclass': subclass}) }}\">{{ subclass|trans({}, action.translation_domain|default('SonataAdminBundle')) }}</a>
            </li>
        {% endfor %}
    </ul>
{% endif %}
", "SonataAdminBundle:CRUD:dashboard__action_create.html.twig", "/var/www/html/UserDemo/vendor/sonata-project/admin-bundle/src/Resources/views/CRUD/dashboard__action_create.html.twig");
    }
}
