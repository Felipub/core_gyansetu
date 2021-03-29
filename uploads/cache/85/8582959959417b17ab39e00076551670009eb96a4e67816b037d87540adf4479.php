<?php

/* components/form.twig.html */
class __TwigTemplate_93ba59a58bbc2abbaa3b097888bdc40cc5e70f13784a7fb3f944770093500f64 extends Twig_Template
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
        // line 8
        echo "
<form ";
        // line 9
        echo twig_get_attribute($this->env, $this->source, ($context["form"] ?? null), "getAttributeString", array());
        echo " onsubmit=\"gibbonFormSubmitted(this)\">

    ";
        // line 11
        if (twig_get_attribute($this->env, $this->source, ($context["form"] ?? null), "getTitle", array())) {
            // line 12
            echo "        <h2>";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["form"] ?? null), "getTitle", array()), "html", null, true);
            echo "</h2>
    ";
        }
        // line 14
        echo "
    ";
        // line 15
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["form"] ?? null), "getHiddenValues", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["values"]) {
            // line 16
            echo "        <input type=\"hidden\" name=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["values"], "name", array()), "html", null, true);
            echo "\" value=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["values"], "value", array()), "html", null, true);
            echo "\">
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['values'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 18
        echo "
    ";
        // line 19
        $context["renderStyle"] = (((twig_in_filter("standardForm", twig_get_attribute($this->env, $this->source, ($context["form"] ?? null), "getClass", array())) || twig_in_filter("noIntBorder", twig_get_attribute($this->env, $this->source, ($context["form"] ?? null), "getClass", array())))) ? ("flex") : ("table"));
        // line 20
        echo "
    <table class=\"";
        // line 21
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["form"] ?? null), "getClass", array()), "html", null, true);
        echo " relative\" cellspacing=\"0\">
    ";
        // line 22
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["form"] ?? null), "getRows", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["row"]) {
            // line 23
            echo "
        ";
            // line 24
            if ((($context["renderStyle"] ?? null) == "flex")) {
                // line 25
                echo "            ";
                $context["rowClass"] = "flex flex-col sm:flex-row justify-between content-center p-0";
                // line 26
                echo "        ";
            }
            // line 27
            echo "
        <tr id=\"";
            // line 28
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["row"], "getID", array()), "html", null, true);
            echo "\" class=\"";
            echo twig_escape_filter($this->env, twig_replace_filter(twig_get_attribute($this->env, $this->source, $context["row"], "getClass", array()), array("standardWidth" => "")), "html", null, true);
            echo " ";
            echo twig_escape_filter($this->env, ($context["rowClass"] ?? null), "html", null, true);
            echo "\">

        ";
            // line 30
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["row"], "getElements", array()));
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
            foreach ($context['_seq'] as $context["_key"] => $context["element"]) {
                // line 31
                echo "            ";
                $context["colspan"] = (((twig_get_attribute($this->env, $this->source, $context["loop"], "last", array()) && (twig_get_attribute($this->env, $this->source, $context["loop"], "length", array()) < ($context["totalColumns"] ?? null)))) ? (((($context["totalColumns"] ?? null) + 1) - twig_get_attribute($this->env, $this->source, $context["loop"], "length", array()))) : (0));
                // line 32
                echo "            
            ";
                // line 33
                if ((($context["renderStyle"] ?? null) == "flex")) {
                    // line 34
                    echo "                ";
                    if (twig_get_attribute($this->env, $this->source, $context["element"], "isInstanceOf", array(0 => "Gibbon\\Forms\\Layout\\Label"), "method")) {
                        // line 35
                        echo "                    ";
                        $context["class"] = "flex flex-col flex-grow justify-center -mb-1 sm:mb-0 ";
                        // line 36
                        echo "                ";
                    } elseif (twig_get_attribute($this->env, $this->source, $context["element"], "isInstanceOf", array(0 => "Gibbon\\Forms\\Layout\\Column"), "method")) {
                        // line 37
                        echo "                    ";
                        $context["class"] = (((twig_get_attribute($this->env, $this->source, $context["loop"], "last", array()) && (twig_get_attribute($this->env, $this->source, $context["loop"], "length", array()) == 2))) ? ("w-full max-w-full sm:max-w-xs flex justify-end") : ("w-full "));
                        // line 38
                        echo "                ";
                    } elseif ((twig_get_attribute($this->env, $this->source, $context["loop"], "last", array()) && (twig_get_attribute($this->env, $this->source, $context["loop"], "length", array()) == 2))) {
                        // line 39
                        echo "                    ";
                        $context["class"] = "w-full max-w-full sm:max-w-xs flex justify-end items-center";
                        // line 40
                        echo "                ";
                    } else {
                        // line 41
                        echo "                    ";
                        $context["class"] = "flex-grow justify-center";
                        // line 42
                        echo "                ";
                    }
                    // line 43
                    echo "            ";
                } else {
                    // line 44
                    echo "                ";
                    $context["class"] = "";
                    echo "  
            ";
                }
                // line 46
                echo "
            <td class=\"";
                // line 47
                echo twig_escape_filter($this->env, ($context["class"] ?? null), "html", null, true);
                echo " px-2 border-b-0 sm:border-b border-t-0 ";
                echo twig_escape_filter($this->env, twig_replace_filter(twig_get_attribute($this->env, $this->source, $context["element"], "getClass", array()), array("standardWidth" => "")), "html", null, true);
                echo "\" ";
                echo ((($context["colspan"] ?? null)) ? (sprintf("colspan=\"%s\"", ($context["colspan"] ?? null))) : (""));
                echo ">
                ";
                // line 48
                echo twig_replace_filter(twig_get_attribute($this->env, $this->source, $context["element"], "getOutput", array()), array("standardWidth" => (((($context["renderStyle"] ?? null) == "flex")) ? ("w-full") : (""))));
                echo "

                ";
                // line 50
                if (twig_get_attribute($this->env, $this->source, $context["element"], "instanceOf", array(0 => "Gibbon\\Forms\\ValidatableInterface"), "method")) {
                    // line 51
                    echo "                <script type=\"text/javascript\">
                    ";
                    // line 52
                    echo twig_get_attribute($this->env, $this->source, $context["element"], "getValidationOutput", array());
                    echo "
                </script>
                ";
                }
                // line 55
                echo "            </td>
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
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['element'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 57
            echo "
        </tr>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['row'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 60
        echo "    </table>

    <script type=\"text/javascript\">
        ";
        // line 63
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["javascript"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["code"]) {
            // line 64
            echo "            ";
            echo $context["code"];
            echo "
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['code'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 66
        echo "    </script>
</form>
";
    }

    public function getTemplateName()
    {
        return "components/form.twig.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  225 => 66,  216 => 64,  212 => 63,  207 => 60,  199 => 57,  184 => 55,  178 => 52,  175 => 51,  173 => 50,  168 => 48,  160 => 47,  157 => 46,  151 => 44,  148 => 43,  145 => 42,  142 => 41,  139 => 40,  136 => 39,  133 => 38,  130 => 37,  127 => 36,  124 => 35,  121 => 34,  119 => 33,  116 => 32,  113 => 31,  96 => 30,  87 => 28,  84 => 27,  81 => 26,  78 => 25,  76 => 24,  73 => 23,  69 => 22,  65 => 21,  62 => 20,  60 => 19,  57 => 18,  46 => 16,  42 => 15,  39 => 14,  33 => 12,  31 => 11,  26 => 9,  23 => 8,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{#<!--
Gibbon, Flexible & Open School System
Copyright (C) 2010, Ross Parker

This is a Gibbon template file, written in HTML and Twig syntax.
For info about editing, see: https://twig.symfony.com/doc/2.x/
-->#}

<form {{ form.getAttributeString|raw }} onsubmit=\"gibbonFormSubmitted(this)\">

    {% if form.getTitle %}
        <h2>{{ form.getTitle }}</h2>
    {% endif %}

    {% for values in form.getHiddenValues %}
        <input type=\"hidden\" name=\"{{ values.name }}\" value=\"{{ values.value }}\">
    {% endfor %}

    {% set renderStyle = \"standardForm\" in form.getClass or \"noIntBorder\" in form.getClass ? 'flex' : 'table' %}

    <table class=\"{{ form.getClass }} relative\" cellspacing=\"0\">
    {% for row in form.getRows %}

        {% if renderStyle == 'flex' %}
            {% set rowClass = 'flex flex-col sm:flex-row justify-between content-center p-0' %}
        {% endif %}

        <tr id=\"{{ row.getID }}\" class=\"{{ row.getClass|replace({'standardWidth': ''}) }} {{ rowClass }}\">

        {% for element in row.getElements %}
            {% set colspan = loop.last and loop.length < totalColumns ? (totalColumns + 1 - loop.length) : 0  %}
            
            {% if renderStyle == 'flex' %}
                {% if element.isInstanceOf('Gibbon\\\\Forms\\\\Layout\\\\Label') %}
                    {% set class = 'flex flex-col flex-grow justify-center -mb-1 sm:mb-0 ' %}
                {% elseif element.isInstanceOf('Gibbon\\\\Forms\\\\Layout\\\\Column') %}
                    {% set class = loop.last and loop.length == 2 ? 'w-full max-w-full sm:max-w-xs flex justify-end' : 'w-full ' %}
                {% elseif loop.last and loop.length == 2 %}
                    {% set class = 'w-full max-w-full sm:max-w-xs flex justify-end items-center' %}
                {% else %}
                    {% set class = 'flex-grow justify-center' %}
                {% endif %}
            {% else %}
                {% set class = '' %}  
            {% endif %}

            <td class=\"{{ class }} px-2 border-b-0 sm:border-b border-t-0 {{ element.getClass|replace({'standardWidth': ''}) }}\" {{ colspan ? 'colspan=\"%s\"'|format(colspan)|raw }}>
                {{ element.getOutput|replace({'standardWidth': renderStyle == 'flex' ? 'w-full' : '' })|raw }}

                {% if element.instanceOf('Gibbon\\\\Forms\\\\ValidatableInterface') %}
                <script type=\"text/javascript\">
                    {{ element.getValidationOutput|raw }}
                </script>
                {% endif %}
            </td>
        {% endfor %}

        </tr>
    {% endfor %}
    </table>

    <script type=\"text/javascript\">
        {% for code in javascript %}
            {{ code|raw }}
        {% endfor %}
    </script>
</form>
", "components/form.twig.html", "/home/felipe/gibbon/core_gyansetu/resources/templates/components/form.twig.html");
    }
}
