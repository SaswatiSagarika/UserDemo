<?php

/* SonataDoctrineORMAdminBundle:CRUD:edit_orm_many_to_one.html.twig */
class __TwigTemplate_4f303a5c54241fa115b499d2acfd7e0f3dbd4c1c9c20de88e426cc9bd7534d94 extends Twig_Template
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
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataDoctrineORMAdminBundle:CRUD:edit_orm_many_to_one.html.twig"));

        // line 11
        echo "
";
        // line 13
        echo "
";
        // line 14
        if ( !$this->getAttribute($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : $this->getContext($context, "sonata_admin")), "field_description", array()), "hasassociationadmin", array())) {
            // line 15
            echo "    ";
            echo twig_escape_filter($this->env, $this->env->getExtension('Sonata\AdminBundle\Twig\Extension\SonataAdminExtension')->renderRelationElement((isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")), $this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : $this->getContext($context, "sonata_admin")), "field_description", array())), "html", null, true);
            echo "
";
        } elseif (($this->getAttribute(        // line 16
(isset($context["sonata_admin"]) ? $context["sonata_admin"] : $this->getContext($context, "sonata_admin")), "edit", array()) == "inline")) {
            // line 17
            echo "    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : $this->getContext($context, "sonata_admin")), "field_description", array()), "associationadmin", array()), "formfielddescriptions", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["field_description"]) {
                // line 18
                echo "        ";
                echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), $this->getAttribute($context["field_description"], "name", array()), array(), "array"), 'row');
                echo "
    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['field_description'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        } else {
            // line 21
            echo "    <div id=\"field_container_";
            echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id")), "html", null, true);
            echo "\" class=\"field-container\">
        ";
            // line 22
            if (($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : $this->getContext($context, "sonata_admin")), "edit", array()) == "list")) {
                // line 23
                echo "            <span id=\"field_widget_";
                echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id")), "html", null, true);
                echo "\" class=\"field-short-description\">
                ";
                // line 24
                if ($this->getAttribute($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : $this->getContext($context, "sonata_admin")), "admin", array()), "id", array(0 => $this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : $this->getContext($context, "sonata_admin")), "value", array())), "method")) {
                    // line 25
                    echo "                    ";
                    echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\HttpKernelExtension')->renderFragment($this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("sonata_admin_short_object_information", array("code" => $this->getAttribute($this->getAttribute($this->getAttribute(                    // line 26
(isset($context["sonata_admin"]) ? $context["sonata_admin"] : $this->getContext($context, "sonata_admin")), "field_description", array()), "associationadmin", array()), "code", array()), "objectId" => $this->getAttribute($this->getAttribute($this->getAttribute(                    // line 27
(isset($context["sonata_admin"]) ? $context["sonata_admin"] : $this->getContext($context, "sonata_admin")), "field_description", array()), "associationadmin", array()), "id", array(0 => $this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : $this->getContext($context, "sonata_admin")), "value", array())), "method"), "uniqid" => $this->getAttribute($this->getAttribute($this->getAttribute(                    // line 28
(isset($context["sonata_admin"]) ? $context["sonata_admin"] : $this->getContext($context, "sonata_admin")), "field_description", array()), "associationadmin", array()), "uniqid", array()), "linkParameters" => $this->getAttribute($this->getAttribute($this->getAttribute(                    // line 29
(isset($context["sonata_admin"]) ? $context["sonata_admin"] : $this->getContext($context, "sonata_admin")), "field_description", array()), "options", array()), "link_parameters", array()))));
                    // line 30
                    echo "
                ";
                } elseif (($this->getAttribute($this->getAttribute($this->getAttribute(                // line 31
(isset($context["sonata_admin"]) ? $context["sonata_admin"] : null), "field_description", array(), "any", false, true), "options", array(), "any", false, true), "placeholder", array(), "any", true, true) && $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : $this->getContext($context, "sonata_admin")), "field_description", array()), "options", array()), "placeholder", array()))) {
                    // line 32
                    echo "                    <span class=\"inner-field-short-description\">
                        ";
                    // line 33
                    echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : $this->getContext($context, "sonata_admin")), "field_description", array()), "options", array()), "placeholder", array()), array(), "SonataAdminBundle"), "html", null, true);
                    echo "
                    </span>
                ";
                }
                // line 36
                echo "            </span>
            <span style=\"display: none\" >
                ";
                // line 38
                echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'widget');
                echo "
            </span>
        ";
            } else {
                // line 41
                echo "            <span id=\"field_widget_";
                echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id")), "html", null, true);
                echo "\" >
                ";
                // line 42
                echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'widget');
                echo "
            </span>
        ";
            }
            // line 45
            echo "
        <div id=\"field_actions_";
            // line 46
            echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id")), "html", null, true);
            echo "\" class=\"field-actions\">
            ";
            // line 47
            $context["display_btn_list"] = (((($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : $this->getContext($context, "sonata_admin")), "edit", array()) == "list") && $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : $this->getContext($context, "sonata_admin")), "field_description", array()), "associationadmin", array()), "hasRoute", array(0 => "list"), "method")) && $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : $this->getContext($context, "sonata_admin")), "field_description", array()), "associationadmin", array()), "isGranted", array(0 => "LIST"), "method")) && (isset($context["btn_list"]) ? $context["btn_list"] : $this->getContext($context, "btn_list")));
            // line 48
            echo "            ";
            $context["display_btn_add"] = (((($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : $this->getContext($context, "sonata_admin")), "edit", array()) != "admin") && $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : $this->getContext($context, "sonata_admin")), "field_description", array()), "associationadmin", array()), "hasRoute", array(0 => "create"), "method")) && $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : $this->getContext($context, "sonata_admin")), "field_description", array()), "associationadmin", array()), "isGranted", array(0 => "CREATE"), "method")) && (isset($context["btn_add"]) ? $context["btn_add"] : $this->getContext($context, "btn_add")));
            // line 49
            echo "            ";
            if (((isset($context["display_btn_list"]) ? $context["display_btn_list"] : $this->getContext($context, "display_btn_list")) || (isset($context["display_btn_add"]) ? $context["display_btn_add"] : $this->getContext($context, "display_btn_add")))) {
                // line 50
                echo "            <div class=\"btn-group\">
                ";
                // line 51
                if ((isset($context["display_btn_list"]) ? $context["display_btn_list"] : $this->getContext($context, "display_btn_list"))) {
                    // line 52
                    echo "                    <a  href=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : $this->getContext($context, "sonata_admin")), "field_description", array()), "associationadmin", array()), "generateUrl", array(0 => "list", 1 => $this->getAttribute($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : $this->getContext($context, "sonata_admin")), "field_description", array()), "getOption", array(0 => "link_parameters", 1 => array()), "method")), "method"), "html", null, true);
                    echo "\"
                        onclick=\"return start_field_dialog_form_list_";
                    // line 53
                    echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id")), "html", null, true);
                    echo "(this);\"
                        class=\"btn btn-info btn-sm sonata-ba-action\"
                        title=\"";
                    // line 55
                    echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans((isset($context["btn_list"]) ? $context["btn_list"] : $this->getContext($context, "btn_list")), array(), (isset($context["btn_catalogue"]) ? $context["btn_catalogue"] : $this->getContext($context, "btn_catalogue"))), "html", null, true);
                    echo "\"
                        >
                        <i class=\"fa fa-list\"></i>
                        ";
                    // line 58
                    echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans((isset($context["btn_list"]) ? $context["btn_list"] : $this->getContext($context, "btn_list")), array(), (isset($context["btn_catalogue"]) ? $context["btn_catalogue"] : $this->getContext($context, "btn_catalogue"))), "html", null, true);
                    echo "
                    </a>
                ";
                }
                // line 61
                echo "
                ";
                // line 62
                if ((isset($context["display_btn_add"]) ? $context["display_btn_add"] : $this->getContext($context, "display_btn_add"))) {
                    // line 63
                    echo "                    <a  href=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : $this->getContext($context, "sonata_admin")), "field_description", array()), "associationadmin", array()), "generateUrl", array(0 => "create", 1 => $this->getAttribute($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : $this->getContext($context, "sonata_admin")), "field_description", array()), "getOption", array(0 => "link_parameters", 1 => array()), "method")), "method"), "html", null, true);
                    echo "\"
                        onclick=\"return start_field_dialog_form_add_";
                    // line 64
                    echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id")), "html", null, true);
                    echo "(this);\"
                        class=\"btn btn-success btn-sm sonata-ba-action\"
                        title=\"";
                    // line 66
                    echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans((isset($context["btn_add"]) ? $context["btn_add"] : $this->getContext($context, "btn_add")), array(), (isset($context["btn_catalogue"]) ? $context["btn_catalogue"] : $this->getContext($context, "btn_catalogue"))), "html", null, true);
                    echo "\"
                        >
                        <i class=\"fa fa-plus-circle\"></i>
                        ";
                    // line 69
                    echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans((isset($context["btn_add"]) ? $context["btn_add"] : $this->getContext($context, "btn_add")), array(), (isset($context["btn_catalogue"]) ? $context["btn_catalogue"] : $this->getContext($context, "btn_catalogue"))), "html", null, true);
                    echo "
                    </a>
                ";
                }
                // line 72
                echo "            </div>
            ";
            }
            // line 74
            echo "
            ";
            // line 75
            if ((((($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : $this->getContext($context, "sonata_admin")), "edit", array()) == "list") && $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : $this->getContext($context, "sonata_admin")), "field_description", array()), "associationadmin", array()), "hasRoute", array(0 => "delete"), "method")) && $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : $this->getContext($context, "sonata_admin")), "field_description", array()), "associationadmin", array()), "isGranted", array(0 => "DELETE"), "method")) && (isset($context["btn_delete"]) ? $context["btn_delete"] : $this->getContext($context, "btn_delete")))) {
                // line 76
                echo "                <a  href=\"\"
                    onclick=\"return remove_selected_element_";
                // line 77
                echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id")), "html", null, true);
                echo "(this);\"
                    class=\"btn btn-danger btn-sm sonata-ba-action\"
                    title=\"";
                // line 79
                echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans((isset($context["btn_delete"]) ? $context["btn_delete"] : $this->getContext($context, "btn_delete")), array(), (isset($context["btn_catalogue"]) ? $context["btn_catalogue"] : $this->getContext($context, "btn_catalogue"))), "html", null, true);
                echo "\"
                    >
                    <i class=\"fa fa-minus-circle\"></i>
                    ";
                // line 82
                echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans((isset($context["btn_delete"]) ? $context["btn_delete"] : $this->getContext($context, "btn_delete")), array(), (isset($context["btn_catalogue"]) ? $context["btn_catalogue"] : $this->getContext($context, "btn_catalogue"))), "html", null, true);
                echo "
                </a>
            ";
            }
            // line 85
            echo "        </div>

        ";
            // line 87
            $this->loadTemplate("@SonataDoctrineORMAdmin/CRUD/edit_modal.html.twig", "SonataDoctrineORMAdminBundle:CRUD:edit_orm_many_to_one.html.twig", 87)->display($context);
            // line 88
            echo "    </div>

    ";
            // line 90
            $this->loadTemplate("@SonataDoctrineORMAdmin/CRUD/edit_orm_many_association_script.html.twig", "SonataDoctrineORMAdminBundle:CRUD:edit_orm_many_to_one.html.twig", 90)->display($context);
        }
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    public function getTemplateName()
    {
        return "SonataDoctrineORMAdminBundle:CRUD:edit_orm_many_to_one.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  216 => 90,  212 => 88,  210 => 87,  206 => 85,  200 => 82,  194 => 79,  189 => 77,  186 => 76,  184 => 75,  181 => 74,  177 => 72,  171 => 69,  165 => 66,  160 => 64,  155 => 63,  153 => 62,  150 => 61,  144 => 58,  138 => 55,  133 => 53,  128 => 52,  126 => 51,  123 => 50,  120 => 49,  117 => 48,  115 => 47,  111 => 46,  108 => 45,  102 => 42,  97 => 41,  91 => 38,  87 => 36,  81 => 33,  78 => 32,  76 => 31,  73 => 30,  71 => 29,  70 => 28,  69 => 27,  68 => 26,  66 => 25,  64 => 24,  59 => 23,  57 => 22,  52 => 21,  42 => 18,  37 => 17,  35 => 16,  30 => 15,  28 => 14,  25 => 13,  22 => 11,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("{#

This file is part of the Sonata package.

(c) Thomas Rabaix <thomas.rabaix@sonata-project.org>

For the full copyright and license information, please view the LICENSE
file that was distributed with this source code.

#}

{% sonata_template_deprecate '@SonataAdmin/CRUD/Association/edit_many_to_one.html.twig' %}

{% if not sonata_admin.field_description.hasassociationadmin%}
    {{ value|render_relation_element(sonata_admin.field_description) }}
{% elseif sonata_admin.edit == 'inline' %}
    {% for field_description in sonata_admin.field_description.associationadmin.formfielddescriptions %}
        {{ form_row(form[field_description.name])}}
    {% endfor %}
{% else %}
    <div id=\"field_container_{{ id }}\" class=\"field-container\">
        {% if sonata_admin.edit == 'list' %}
            <span id=\"field_widget_{{ id }}\" class=\"field-short-description\">
                {% if sonata_admin.admin.id(sonata_admin.value) %}
                    {{ render(path('sonata_admin_short_object_information', {
                        'code':     sonata_admin.field_description.associationadmin.code,
                        'objectId': sonata_admin.field_description.associationadmin.id(sonata_admin.value),
                        'uniqid':   sonata_admin.field_description.associationadmin.uniqid,
                        'linkParameters': sonata_admin.field_description.options.link_parameters
                    })) }}
                {% elseif sonata_admin.field_description.options.placeholder is defined and sonata_admin.field_description.options.placeholder %}
                    <span class=\"inner-field-short-description\">
                        {{ sonata_admin.field_description.options.placeholder|trans({}, 'SonataAdminBundle') }}
                    </span>
                {% endif %}
            </span>
            <span style=\"display: none\" >
                {{ form_widget(form) }}
            </span>
        {% else %}
            <span id=\"field_widget_{{ id }}\" >
                {{ form_widget(form) }}
            </span>
        {% endif %}

        <div id=\"field_actions_{{ id }}\" class=\"field-actions\">
            {% set display_btn_list = sonata_admin.edit == 'list' and sonata_admin.field_description.associationadmin.hasRoute('list') and sonata_admin.field_description.associationadmin.isGranted('LIST') and btn_list %}
            {% set display_btn_add = sonata_admin.edit != 'admin' and sonata_admin.field_description.associationadmin.hasRoute('create') and sonata_admin.field_description.associationadmin.isGranted('CREATE') and btn_add %}
            {% if display_btn_list or display_btn_add %}
            <div class=\"btn-group\">
                {% if display_btn_list %}
                    <a  href=\"{{ sonata_admin.field_description.associationadmin.generateUrl('list', sonata_admin.field_description.getOption('link_parameters', {})) }}\"
                        onclick=\"return start_field_dialog_form_list_{{ id }}(this);\"
                        class=\"btn btn-info btn-sm sonata-ba-action\"
                        title=\"{{ btn_list|trans({}, btn_catalogue) }}\"
                        >
                        <i class=\"fa fa-list\"></i>
                        {{ btn_list|trans({}, btn_catalogue) }}
                    </a>
                {% endif %}

                {% if display_btn_add %}
                    <a  href=\"{{ sonata_admin.field_description.associationadmin.generateUrl('create', sonata_admin.field_description.getOption('link_parameters', {})) }}\"
                        onclick=\"return start_field_dialog_form_add_{{ id }}(this);\"
                        class=\"btn btn-success btn-sm sonata-ba-action\"
                        title=\"{{ btn_add|trans({}, btn_catalogue) }}\"
                        >
                        <i class=\"fa fa-plus-circle\"></i>
                        {{ btn_add|trans({}, btn_catalogue) }}
                    </a>
                {% endif %}
            </div>
            {% endif %}

            {% if sonata_admin.edit == 'list' and sonata_admin.field_description.associationadmin.hasRoute('delete') and sonata_admin.field_description.associationadmin.isGranted('DELETE') and btn_delete %}
                <a  href=\"\"
                    onclick=\"return remove_selected_element_{{ id }}(this);\"
                    class=\"btn btn-danger btn-sm sonata-ba-action\"
                    title=\"{{ btn_delete|trans({}, btn_catalogue) }}\"
                    >
                    <i class=\"fa fa-minus-circle\"></i>
                    {{ btn_delete|trans({}, btn_catalogue) }}
                </a>
            {% endif %}
        </div>

        {% include '@SonataDoctrineORMAdmin/CRUD/edit_modal.html.twig' %}
    </div>

    {% include '@SonataDoctrineORMAdmin/CRUD/edit_orm_many_association_script.html.twig' %}
{% endif %}
", "SonataDoctrineORMAdminBundle:CRUD:edit_orm_many_to_one.html.twig", "/var/www/html/UserDemo/vendor/sonata-project/doctrine-orm-admin-bundle/src/Resources/views/CRUD/edit_orm_many_to_one.html.twig");
    }
}
