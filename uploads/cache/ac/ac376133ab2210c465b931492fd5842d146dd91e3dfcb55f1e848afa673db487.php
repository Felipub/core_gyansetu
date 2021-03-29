<?php

/* foot.twig.html */
class __TwigTemplate_d93480b76c74968ba485e1d3e111d4fd2f860d7b846497865f5502b3e3dc1148 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 11
        echo "
";
        // line 12
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "extraFoot", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["code"]) {
            // line 13
            echo "    ";
            echo $context["code"];
            echo "
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['code'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 15
        echo "
";
        // line 16
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "scriptsFoot", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["asset"]) {
            // line 17
            echo "    ";
            $context["assetVersion"] = (( !twig_test_empty(twig_get_attribute($this->env, $this->source, $context["asset"], "version", array()))) ? (twig_get_attribute($this->env, $this->source, $context["asset"], "version", array())) : (($context["version"] ?? null)));
            // line 18
            echo "    ";
            if ((twig_get_attribute($this->env, $this->source, $context["asset"], "type", array()) == "inline")) {
                // line 19
                echo "        <script type=\"text/javascript\">";
                echo twig_get_attribute($this->env, $this->source, $context["asset"], "src", array());
                echo "</script>
    ";
            } else {
                // line 21
                echo "        <script type=\"text/javascript\" src=\"";
                echo twig_escape_filter($this->env, ($context["absoluteURL"] ?? null), "html", null, true);
                echo "/";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["asset"], "src", array()), "html", null, true);
                echo "?v=";
                echo twig_escape_filter($this->env, ($context["assetVersion"] ?? null), "html", null, true);
                echo "\"></script>
    ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['asset'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
    }

    public function getTemplateName()
    {
        return "foot.twig.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  58 => 21,  52 => 19,  49 => 18,  46 => 17,  42 => 16,  39 => 15,  30 => 13,  26 => 12,  23 => 11,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{#<!--
Gibbon, Flexible & Open School System
Copyright (C) 2010, Ross Parker

This is a Gibbon template file, written in HTML and Twig syntax.
For info about editing, see: https://twig.symfony.com/doc/2.x/

Page Foot: Outputs at the bottom, right before the closing </body> tag.
Useful for scripts that need to execute after the page has loaded.
-->#}

{% for code in page.extraFoot %}
    {{ code|raw }}
{% endfor %}

{% for asset in page.scriptsFoot %}
    {% set assetVersion = asset.version is not empty ? asset.version : version %}
    {% if asset.type == 'inline' %}
        <script type=\"text/javascript\">{{ asset.src|raw }}</script>
    {% else %}
        <script type=\"text/javascript\" src=\"{{ absoluteURL }}/{{ asset.src }}?v={{ assetVersion }}\"></script>
    {% endif %}
{% endfor %}
", "foot.twig.html", "/home/felipe/gibbon/core_gyansetu/resources/templates/foot.twig.html");
    }
}
