<?php

/* SonataDoctrineORMAdminBundle:CRUD:edit_orm_one_to_many_inline_tabs.html.twig */
class __TwigTemplate_bffbd07f2b194d192f4fd216ede7b2499f8608e8ac22896e6495d195db03e26d extends Twig_Template
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
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataDoctrineORMAdminBundle:CRUD:edit_orm_one_to_many_inline_tabs.html.twig"));

        // line 11
        echo "
";
        // line 13
        echo "
<div class=\"sonata-ba-tabs\">
    ";
        // line 15
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "children", array()));
        $context['loop'] = array(
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        );
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["_key"] => $context["nested_group_field"]) {
            // line 16
            echo "        <div>
            <div class=\"nav-tabs-custom\">
                <ul class=\"nav nav-tabs\">
                    ";
            // line 19
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["associationAdmin"]) ? $context["associationAdmin"] : $this->getContext($context, "associationAdmin")), "formgroups", array()));
            $context['loop'] = array(
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            );
            if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
                $length = count($context['_seq']);
                $context['loop']['revindex0'] = $length - 1;
                $context['loop']['revindex'] = $length;
                $context['loop']['length'] = $length;
                $context['loop']['last'] = 1 === $length;
            }
            foreach ($context['_seq'] as $context["name"] => $context["form_group"]) {
                // line 20
                echo "                        <li class=\"";
                if ($this->getAttribute($context["loop"], "first", array())) {
                    echo "active";
                }
                echo "\">
                            <a
                                href=\"#";
                // line 22
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["associationAdmin"]) ? $context["associationAdmin"] : $this->getContext($context, "associationAdmin")), "uniqid", array()), "html", null, true);
                echo "_";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($context["loop"], "parent", array()), "loop", array()), "index", array()), "html", null, true);
                echo "_";
                echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
                echo "\"
                                data-toggle=\"tab\"
                            >
                                <i class=\"icon-exclamation-sign has-errors hide\"></i>
                                ";
                // line 26
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["associationAdmin"]) ? $context["associationAdmin"] : $this->getContext($context, "associationAdmin")), "trans", array(0 => $context["name"], 1 => array(), 2 => $this->getAttribute($context["form_group"], "translation_domain", array())), "method"), "html", null, true);
                echo "
                            </a>
                        </li>
                    ";
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
                if (isset($context['loop']['length'])) {
                    --$context['loop']['revindex0'];
                    --$context['loop']['revindex'];
                    $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['name'], $context['form_group'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 30
            echo "                </ul>

                <div class=\"tab-content\">
                    ";
            // line 33
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["associationAdmin"]) ? $context["associationAdmin"] : $this->getContext($context, "associationAdmin")), "formgroups", array()));
            $context['loop'] = array(
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            );
            if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
                $length = count($context['_seq']);
                $context['loop']['revindex0'] = $length - 1;
                $context['loop']['revindex'] = $length;
                $context['loop']['length'] = $length;
                $context['loop']['last'] = 1 === $length;
            }
            foreach ($context['_seq'] as $context["name"] => $context["form_group"]) {
                // line 34
                echo "                        <div
                            class=\"tab-pane ";
                // line 35
                if ($this->getAttribute($context["loop"], "first", array())) {
                    echo "active";
                }
                echo "\"
                            id=\"";
                // line 36
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["associationAdmin"]) ? $context["associationAdmin"] : $this->getContext($context, "associationAdmin")), "uniqid", array()), "html", null, true);
                echo "_";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($context["loop"], "parent", array()), "loop", array()), "index", array()), "html", null, true);
                echo "_";
                echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
                echo "\"
                        >
                            <fieldset>
                                <div class=\"sonata-ba-collapsed-fields\">
                                    ";
                // line 40
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["form_group"], "fields", array()));
                foreach ($context['_seq'] as $context["_key"] => $context["field_name"]) {
                    if ($this->getAttribute($this->getAttribute($context["nested_group_field"], "children", array(), "any", false, true), $context["field_name"], array(), "array", true, true)) {
                        // line 41
                        echo "                                        ";
                        $context["nested_field"] = $this->getAttribute($this->getAttribute($context["nested_group_field"], "children", array()), $context["field_name"], array(), "array");
                        // line 42
                        echo "                                        <div class=\"sonata-ba-field-";
                        echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id")), "html", null, true);
                        echo "-";
                        echo twig_escape_filter($this->env, $context["field_name"], "html", null, true);
                        echo "\">
                                            ";
                        // line 43
                        if ($this->getAttribute($this->getAttribute((isset($context["associationAdmin"]) ? $context["associationAdmin"] : null), "formfielddescriptions", array(), "any", false, true), $context["field_name"], array(), "array", true, true)) {
                            // line 44
                            echo "                                                ";
                            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock((isset($context["nested_field"]) ? $context["nested_field"] : $this->getContext($context, "nested_field")), 'row', array("inline" => "natural", "edit" => "inline"));
                            // line 47
                            echo "
                                                ";
                            // line 48
                            $context["dummy"] = $this->getAttribute($context["nested_group_field"], "setrendered", array());
                            // line 49
                            echo "                                            ";
                        } else {
                            // line 50
                            echo "                                                ";
                            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock((isset($context["nested_field"]) ? $context["nested_field"] : $this->getContext($context, "nested_field")), 'row');
                            echo "
                                            ";
                        }
                        // line 52
                        echo "                                        </div>
                                    ";
                    }
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['field_name'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 54
                echo "                                </div>
                            </fieldset>
                        </div>
                    ";
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
                if (isset($context['loop']['length'])) {
                    --$context['loop']['revindex0'];
                    --$context['loop']['revindex'];
                    $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['name'], $context['form_group'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 58
            echo "                </div>
            </div>

            ";
            // line 61
            if ($this->getAttribute($context["nested_group_field"], "_delete", array(), "array", true, true)) {
                // line 62
                echo "                ";
                echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->searchAndRenderBlock($this->getAttribute($context["nested_group_field"], "_delete", array(), "array"), 'row', array("label" => "action_delete", "translation_domain" => "SonataAdminBundle"));
                echo "
            ";
            }
            // line 64
            echo "        </div>
    ";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['length'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['nested_group_field'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 66
        echo "</div>
";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    public function getTemplateName()
    {
        return "SonataDoctrineORMAdminBundle:CRUD:edit_orm_one_to_many_inline_tabs.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  234 => 66,  219 => 64,  213 => 62,  211 => 61,  206 => 58,  189 => 54,  181 => 52,  175 => 50,  172 => 49,  170 => 48,  167 => 47,  164 => 44,  162 => 43,  155 => 42,  152 => 41,  147 => 40,  136 => 36,  130 => 35,  127 => 34,  110 => 33,  105 => 30,  87 => 26,  76 => 22,  68 => 20,  51 => 19,  46 => 16,  29 => 15,  25 => 13,  22 => 11,);
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

{% sonata_template_deprecate '@SonataAdmin/CRUD/Association/edit_one_to_many_inline_tabs.html.twig' %}

<div class=\"sonata-ba-tabs\">
    {% for nested_group_field in form.children %}
        <div>
            <div class=\"nav-tabs-custom\">
                <ul class=\"nav nav-tabs\">
                    {% for name, form_group in associationAdmin.formgroups %}
                        <li class=\"{% if loop.first %}active{% endif %}\">
                            <a
                                href=\"#{{ associationAdmin.uniqid }}_{{ loop.parent.loop.index }}_{{ loop.index }}\"
                                data-toggle=\"tab\"
                            >
                                <i class=\"icon-exclamation-sign has-errors hide\"></i>
                                {{ associationAdmin.trans(name, {}, form_group.translation_domain) }}
                            </a>
                        </li>
                    {% endfor %}
                </ul>

                <div class=\"tab-content\">
                    {% for name, form_group in associationAdmin.formgroups %}
                        <div
                            class=\"tab-pane {% if loop.first %}active{% endif %}\"
                            id=\"{{ associationAdmin.uniqid }}_{{ loop.parent.loop.index }}_{{ loop.index }}\"
                        >
                            <fieldset>
                                <div class=\"sonata-ba-collapsed-fields\">
                                    {% for field_name in form_group.fields if nested_group_field.children[field_name] is defined %}
                                        {% set nested_field = nested_group_field.children[field_name] %}
                                        <div class=\"sonata-ba-field-{{ id }}-{{ field_name }}\">
                                            {% if associationAdmin.formfielddescriptions[field_name] is defined %}
                                                {{ form_row(nested_field, {
                                                    'inline': 'natural',
                                                    'edit'  : 'inline'
                                                }) }}
                                                {% set dummy = nested_group_field.setrendered %}
                                            {% else %}
                                                {{ form_row(nested_field) }}
                                            {% endif %}
                                        </div>
                                    {% endfor %}
                                </div>
                            </fieldset>
                        </div>
                    {% endfor %}
                </div>
            </div>

            {% if nested_group_field['_delete'] is defined %}
                {{ form_row(nested_group_field['_delete'], {'label': 'action_delete', 'translation_domain': 'SonataAdminBundle'}) }}
            {% endif %}
        </div>
    {% endfor %}
</div>
", "SonataDoctrineORMAdminBundle:CRUD:edit_orm_one_to_many_inline_tabs.html.twig", "/var/www/html/UserDemo/vendor/sonata-project/doctrine-orm-admin-bundle/src/Resources/views/CRUD/edit_orm_one_to_many_inline_tabs.html.twig");
    }
}
