<?php

/* SonataDoctrineORMAdminBundle:CRUD:edit_orm_one_to_many_sortable_script_table.html.twig */
class __TwigTemplate_7093d0ec9355dea39b2d64d7852e20c6f423958bff0f497998ed60ee46ed592f extends Twig_Template
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
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataDoctrineORMAdminBundle:CRUD:edit_orm_one_to_many_sortable_script_table.html.twig"));

        // line 11
        echo "
";
        // line 13
        echo "
<script type=\"text/javascript\">
    jQuery('div#field_container_";
        // line 15
        echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id")), "html", null, true);
        echo " tbody.sonata-ba-tbody').first().sortable({
        axis: 'y',
        opacity: 0.6,
        items: '> tr',
        stop: apply_position_value_";
        // line 19
        echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id")), "html", null, true);
        echo "
    });

    function apply_position_value_";
        // line 22
        echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id")), "html", null, true);
        echo "() {
        // update the input value position
        jQuery('div#field_container_";
        // line 24
        echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id")), "html", null, true);
        echo " tbody.sonata-ba-tbody td.sonata-ba-td-";
        echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id")), "html", null, true);
        echo "-";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : $this->getContext($context, "sonata_admin")), "field_description", array()), "options", array()), "sortable", array()), "html", null, true);
        echo "').each(function(index, element) {
            // remove the sortable handler and put it back
            jQuery('span.sonata-ba-sortable-handler', element).remove();
            jQuery(element).append('<span class=\"sonata-ba-sortable-handler ui-icon ui-icon-grip-solid-horizontal\"></span>');
            jQuery('input', element).hide();
        });

        jQuery('div#field_container_";
        // line 31
        echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id")), "html", null, true);
        echo " tbody.sonata-ba-tbody td.sonata-ba-td-";
        echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id")), "html", null, true);
        echo "-";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : $this->getContext($context, "sonata_admin")), "field_description", array()), "options", array()), "sortable", array()), "html", null, true);
        echo " input').each(function(index, value) {
            jQuery(value).val(index + 1);
        });
    }

    // refresh the sortable option when a new element is added
    jQuery('#sonata-ba-field-container-";
        // line 37
        echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id")), "html", null, true);
        echo "').bind('sonata.add_element', function() {
        apply_position_value_";
        // line 38
        echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id")), "html", null, true);
        echo "();
        jQuery('div#field_container_";
        // line 39
        echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id")), "html", null, true);
        echo " tbody.sonata-ba-tbody').sortable('refresh');
    });

    apply_position_value_";
        // line 42
        echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id")), "html", null, true);
        echo "();
</script>
";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    public function getTemplateName()
    {
        return "SonataDoctrineORMAdminBundle:CRUD:edit_orm_one_to_many_sortable_script_table.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  88 => 42,  82 => 39,  78 => 38,  74 => 37,  61 => 31,  47 => 24,  42 => 22,  36 => 19,  29 => 15,  25 => 13,  22 => 11,);
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

{% sonata_template_deprecate '@SonataAdmin/CRUD/Association/edit_one_to_many_sortable_script_table.html.twig' %}

<script type=\"text/javascript\">
    jQuery('div#field_container_{{ id }} tbody.sonata-ba-tbody').first().sortable({
        axis: 'y',
        opacity: 0.6,
        items: '> tr',
        stop: apply_position_value_{{ id }}
    });

    function apply_position_value_{{ id }}() {
        // update the input value position
        jQuery('div#field_container_{{ id }} tbody.sonata-ba-tbody td.sonata-ba-td-{{ id }}-{{ sonata_admin.field_description.options.sortable }}').each(function(index, element) {
            // remove the sortable handler and put it back
            jQuery('span.sonata-ba-sortable-handler', element).remove();
            jQuery(element).append('<span class=\"sonata-ba-sortable-handler ui-icon ui-icon-grip-solid-horizontal\"></span>');
            jQuery('input', element).hide();
        });

        jQuery('div#field_container_{{ id }} tbody.sonata-ba-tbody td.sonata-ba-td-{{ id }}-{{ sonata_admin.field_description.options.sortable }} input').each(function(index, value) {
            jQuery(value).val(index + 1);
        });
    }

    // refresh the sortable option when a new element is added
    jQuery('#sonata-ba-field-container-{{ id }}').bind('sonata.add_element', function() {
        apply_position_value_{{ id }}();
        jQuery('div#field_container_{{ id }} tbody.sonata-ba-tbody').sortable('refresh');
    });

    apply_position_value_{{ id }}();
</script>
", "SonataDoctrineORMAdminBundle:CRUD:edit_orm_one_to_many_sortable_script_table.html.twig", "/var/www/html/EcommerceTe/vendor/sonata-project/doctrine-orm-admin-bundle/src/Resources/views/CRUD/edit_orm_one_to_many_sortable_script_table.html.twig");
    }
}
