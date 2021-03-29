<?php

/* head.twig.html */
class __TwigTemplate_7980374836bea29912d1564cc709b7a4af39ba1feb69c8ccb6170c930df9181b extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = array(
            'meta' => array($this, 'block_meta'),
            'styles' => array($this, 'block_styles'),
            'scripts' => array($this, 'block_scripts'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 11
        echo "
";
        // line 12
        $this->displayBlock('meta', $context, $blocks);
        // line 23
        echo "

";
        // line 25
        $this->displayBlock('styles', $context, $blocks);
        // line 35
        echo "

";
        // line 37
        $this->displayBlock('scripts', $context, $blocks);
    }

    // line 12
    public function block_meta($context, array $blocks = array())
    {
        // line 13
        echo "    <title>";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "title", array()), "html", null, true);
        echo "</title>

    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1, shrink-to-fit=no\">
    <meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\"/>
    <meta http-equiv=\"content-language\" content=\"";
        // line 17
        echo twig_escape_filter($this->env, ($context["locale"] ?? null), "html", null, true);
        echo "\"/>
    <meta name=\"author\" content=\"Ross Parker, International College Hong Kong\"/>
    <meta name=\"robots\" content=\"none\"/>
    <meta name=\"Referrer‐Policy\" value=\"no‐referrer | same‐origin\"/>
    <link rel=\"shortcut icon\" type=\"image/x-icon\" href=\"./favicon.ico\"/>
";
    }

    // line 25
    public function block_styles($context, array $blocks = array())
    {
        // line 26
        echo "    ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "stylesheets", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["asset"]) {
            // line 27
            echo "        ";
            $context["assetVersion"] = (( !twig_test_empty(twig_get_attribute($this->env, $this->source, $context["asset"], "version", array()))) ? (twig_get_attribute($this->env, $this->source, $context["asset"], "version", array())) : (($context["version"] ?? null)));
            // line 28
            echo "        ";
            if ((twig_get_attribute($this->env, $this->source, $context["asset"], "type", array()) == "inline")) {
                // line 29
                echo "            <style type=\"text/css\">";
                echo twig_get_attribute($this->env, $this->source, $context["asset"], "src", array());
                echo "</style>
        ";
            } else {
                // line 31
                echo "            <link rel=\"stylesheet\" href=\"";
                echo twig_escape_filter($this->env, ($context["absoluteURL"] ?? null), "html", null, true);
                echo "/";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["asset"], "src", array()), "html", null, true);
                echo "?v=";
                echo twig_escape_filter($this->env, ($context["assetVersion"] ?? null), "html", null, true);
                echo "\" type=\"text/css\" media=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["asset"], "media", array()), "html", null, true);
                echo "\" />
        ";
            }
            // line 33
            echo "    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['asset'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
    }

    // line 37
    public function block_scripts($context, array $blocks = array())
    {
        // line 38
        echo "    ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "scriptsHead", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["asset"]) {
            // line 39
            echo "        ";
            $context["assetVersion"] = (( !twig_test_empty(twig_get_attribute($this->env, $this->source, $context["asset"], "version", array()))) ? (twig_get_attribute($this->env, $this->source, $context["asset"], "version", array())) : (($context["version"] ?? null)));
            // line 40
            echo "        ";
            if ((twig_get_attribute($this->env, $this->source, $context["asset"], "type", array()) == "inline")) {
                // line 41
                echo "            <script type=\"text/javascript\">";
                echo twig_get_attribute($this->env, $this->source, $context["asset"], "src", array());
                echo "</script>
        ";
            } else {
                // line 43
                echo "            <script type=\"text/javascript\" src=\"";
                echo twig_escape_filter($this->env, ($context["absoluteURL"] ?? null), "html", null, true);
                echo "/";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["asset"], "src", array()), "html", null, true);
                echo "?v=";
                echo twig_escape_filter($this->env, ($context["assetVersion"] ?? null), "html", null, true);
                echo "\"></script>
        ";
            }
            // line 45
            echo "    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['asset'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 46
        echo "
    ";
        // line 47
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "extraHead", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["code"]) {
            // line 48
            echo "        ";
            echo $context["code"];
            echo "
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['code'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
    }

    public function getTemplateName()
    {
        return "head.twig.html";
    }

    public function getDebugInfo()
    {
        return array (  149 => 48,  145 => 47,  142 => 46,  136 => 45,  126 => 43,  120 => 41,  117 => 40,  114 => 39,  109 => 38,  106 => 37,  98 => 33,  86 => 31,  80 => 29,  77 => 28,  74 => 27,  69 => 26,  66 => 25,  56 => 17,  48 => 13,  45 => 12,  41 => 37,  37 => 35,  35 => 25,  31 => 23,  29 => 12,  26 => 11,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{#<!--
Gibbon, Flexible & Open School System
Copyright (C) 2010, Ross Parker

This is a Gibbon template file, written in HTML and Twig syntax.
For info about editing, see: https://twig.symfony.com/doc/2.x/

Page Foot: Outputs the contents of the HTML <head> tag. This includes 
all stylesheets and scripts with a 'head' context.
-->#}

{% block meta %}
    <title>{{ page.title }}</title>

    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1, shrink-to-fit=no\">
    <meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\"/>
    <meta http-equiv=\"content-language\" content=\"{{ locale }}\"/>
    <meta name=\"author\" content=\"Ross Parker, International College Hong Kong\"/>
    <meta name=\"robots\" content=\"none\"/>
    <meta name=\"Referrer‐Policy\" value=\"no‐referrer | same‐origin\"/>
    <link rel=\"shortcut icon\" type=\"image/x-icon\" href=\"./favicon.ico\"/>
{% endblock meta %}


{% block styles %}
    {% for asset in page.stylesheets %}
        {% set assetVersion = asset.version is not empty ? asset.version : version %}
        {% if asset.type == 'inline' %}
            <style type=\"text/css\">{{ asset.src|raw }}</style>
        {% else %}
            <link rel=\"stylesheet\" href=\"{{ absoluteURL }}/{{ asset.src }}?v={{ assetVersion }}\" type=\"text/css\" media=\"{{ asset.media }}\" />
        {% endif %}
    {% endfor %}
{% endblock styles %}


{% block scripts %}
    {% for asset in page.scriptsHead %}
        {% set assetVersion = asset.version is not empty ? asset.version : version %}
        {% if asset.type == 'inline' %}
            <script type=\"text/javascript\">{{ asset.src|raw }}</script>
        {% else %}
            <script type=\"text/javascript\" src=\"{{ absoluteURL }}/{{ asset.src }}?v={{ assetVersion }}\"></script>
        {% endif %}
    {% endfor %}

    {% for code in page.extraHead %}
        {{ code|raw }}
    {% endfor %}
{% endblock scripts %}
", "head.twig.html", "/home/felipe/gibbon/core_gyansetu/resources/templates/head.twig.html");
    }
}
