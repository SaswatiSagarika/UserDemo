<?php

/* SonataBlockBundle:Block:block_core_rss.html.twig */
class __TwigTemplate_b9740d8d7345099b7408af6ac6120761d4bbac8bd49ee0bd1f44dce0a5bbb731 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'block' => array($this, 'block_block'),
        );
    }

    protected function doGetParent(array $context)
    {
        // line 11
        return $this->loadTemplate($this->getAttribute($this->getAttribute((isset($context["sonata_block"]) ? $context["sonata_block"] : $this->getContext($context, "sonata_block")), "templates", array()), "block_base", array()), "SonataBlockBundle:Block:block_core_rss.html.twig", 11);
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataBlockBundle:Block:block_core_rss.html.twig"));

        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    // line 13
    public function block_block($context, array $blocks = array())
    {
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "block"));

        // line 14
        echo "    <div class=\"panel panel-default ";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["settings"]) ? $context["settings"] : $this->getContext($context, "settings")), "class", array()), "html", null, true);
        echo "\">
        ";
        // line 15
        if ( !twig_test_empty($this->getAttribute((isset($context["settings"]) ? $context["settings"] : $this->getContext($context, "settings")), "title", array()))) {
            // line 16
            echo "            <div class=\"panel-heading\">
                <h4 class=\"panel-title\">
                    ";
            // line 18
            if ($this->getAttribute((isset($context["settings"]) ? $context["settings"] : $this->getContext($context, "settings")), "icon", array())) {
                // line 19
                echo "                        <i class=\"";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["settings"]) ? $context["settings"] : $this->getContext($context, "settings")), "icon", array()), "html", null, true);
                echo "\" aria-hidden=\"true\"></i>
                    ";
            }
            // line 21
            echo "                    ";
            if ($this->getAttribute((isset($context["settings"]) ? $context["settings"] : $this->getContext($context, "settings")), "translation_domain", array())) {
                // line 22
                echo "                        ";
                echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans($this->getAttribute((isset($context["settings"]) ? $context["settings"] : $this->getContext($context, "settings")), "title", array()), array(), $this->getAttribute((isset($context["settings"]) ? $context["settings"] : $this->getContext($context, "settings")), "translation_domain", array())), "html", null, true);
                echo "
                    ";
            } else {
                // line 24
                echo "                        ";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["settings"]) ? $context["settings"] : $this->getContext($context, "settings")), "title", array()), "html", null, true);
                echo "
                    ";
            }
            // line 26
            echo "                </h4>
            </div>
        ";
        }
        // line 29
        echo "
        <div class=\"panel-body\">
            <div class=\"media\">
                ";
        // line 32
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["feeds"]) ? $context["feeds"] : $this->getContext($context, "feeds")));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["feed"]) {
            // line 33
            echo "                    <div class=\"media-body\">
                        <h5 class=\"media-heading\">
                            <a href=\"";
            // line 35
            echo twig_escape_filter($this->env, $this->getAttribute($context["feed"], "link", array()), "html", null, true);
            echo "\" rel=\"nofollow\" title=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["feed"], "title", array()), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute($context["feed"], "title", array()), "html", null, true);
            echo "</a>
                        </h5>
                        ";
            // line 37
            echo $this->getAttribute($context["feed"], "description", array());
            echo "
                    </div>
                ";
            $context['_iterated'] = true;
        }
        if (!$context['_iterated']) {
            // line 40
            echo "                    No feeds available.
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['feed'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 42
        echo "            </div>
        </div>
    </div>
";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    public function getTemplateName()
    {
        return "SonataBlockBundle:Block:block_core_rss.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  116 => 42,  109 => 40,  101 => 37,  92 => 35,  88 => 33,  83 => 32,  78 => 29,  73 => 26,  67 => 24,  61 => 22,  58 => 21,  52 => 19,  50 => 18,  46 => 16,  44 => 15,  39 => 14,  33 => 13,  18 => 11,);
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
{% extends sonata_block.templates.block_base %}

{% block block %}
    <div class=\"panel panel-default {{ settings.class }}\">
        {% if settings.title is not empty %}
            <div class=\"panel-heading\">
                <h4 class=\"panel-title\">
                    {% if settings.icon %}
                        <i class=\"{{ settings.icon }}\" aria-hidden=\"true\"></i>
                    {% endif %}
                    {% if settings.translation_domain %}
                        {{ settings.title|trans({}, settings.translation_domain) }}
                    {% else %}
                        {{ settings.title }}
                    {% endif %}
                </h4>
            </div>
        {% endif %}

        <div class=\"panel-body\">
            <div class=\"media\">
                {% for feed in feeds %}
                    <div class=\"media-body\">
                        <h5 class=\"media-heading\">
                            <a href=\"{{ feed.link }}\" rel=\"nofollow\" title=\"{{ feed.title }}\">{{ feed.title }}</a>
                        </h5>
                        {{ feed.description|raw }}
                    </div>
                {% else %}
                    No feeds available.
                {% endfor %}
            </div>
        </div>
    </div>
{% endblock %}
", "SonataBlockBundle:Block:block_core_rss.html.twig", "/var/www/html/UserDemo/vendor/sonata-project/block-bundle/src/Resources/views/Block/block_core_rss.html.twig");
    }
}
