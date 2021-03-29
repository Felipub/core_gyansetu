<?php

/* index.twig.html */
class __TwigTemplate_aaac0e1415079261999547e197880cd0deb7f8748e492fa3a3d7d7ac49c534a4 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = array(
            'head' => array($this, 'block_head'),
            'header' => array($this, 'block_header'),
            'sidebar' => array($this, 'block_sidebar'),
            'page' => array($this, 'block_page'),
            'footer' => array($this, 'block_footer'),
            'foot' => array($this, 'block_foot'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 10
        echo "
<!DOCTYPE html>
<html ";
        // line 12
        echo ((($context["rightToLeft"] ?? null)) ? ("dir=\"rtl\"") : (""));
        echo ">
    <head>
        ";
        // line 14
        $this->displayBlock('head', $context, $blocks);
        // line 17
        echo "    </head>
    <body style=\"";
        // line 18
        echo twig_escape_filter($this->env, ($context["bodyBackground"] ?? null), "html", null, true);
        echo "\">
        <div id=\"wrapOuter\" class=\"sm:px-6\">
            <div class=\"mx-auto max-w-6xl text-right text-white text-xs md:text-sm px-2 xl:px-0 ";
        // line 20
        echo ((($context["gibbonHouseIDLogo"] ?? null)) ? ("mt-2") : ("mt-6"));
        echo "\">
                ";
        // line 21
        echo ($context["minorLinks"] ?? null);
        echo "
            </div>

            <div id=\"wrap\" class=\"mx-auto max-w-6xl m-2 shadow-container rounded\">
                ";
        // line 25
        $this->displayBlock('header', $context, $blocks);
        // line 42
        echo "
                <div id=\"content-wrap\" class=\"relative w-full min-h-1/2 flex content-start ";
        // line 43
        echo ((($context["sidebar"] ?? null)) ? ("flex-wrap lg:flex-no-wrap") : ("flex-col"));
        echo " lg:flex-row-reverse bg-transparent-100 clearfix\">

                    ";
        // line 45
        if (($context["sidebar"] ?? null)) {
            // line 46
            echo "                        <div id=\"sidebar\" class=\"w-full lg:w-sidebar px-6 pb-6 lg:border-l\">
                            ";
            // line 47
            $this->displayBlock('sidebar', $context, $blocks);
            // line 50
            echo "                        </div>
                        <br style=\"clear: both\">
                    ";
        }
        // line 53
        echo "
                    <div id=\"content\" class=\"w-full ";
        // line 54
        echo (( !($context["sidebar"] ?? null)) ? ("pt-0 sm:pt-6") : (""));
        echo " lg:flex-1  p-6 lg:pt-0 overflow-x-scroll sm:overflow-x-auto\">

                        ";
        // line 56
        $this->displayBlock('page', $context, $blocks);
        // line 90
        echo "                    </div>


                </div>

                ";
        // line 95
        $this->displayBlock('footer', $context, $blocks);
        // line 114
        echo "            </div>
        </div>

        ";
        // line 117
        $this->displayBlock('foot', $context, $blocks);
        // line 120
        echo "    </body>
</html>
";
    }

    // line 14
    public function block_head($context, array $blocks = array())
    {
        // line 15
        echo "        ";
        echo twig_include($this->env, $context, "head.twig.html");
        echo "
        ";
    }

    // line 25
    public function block_header($context, array $blocks = array())
    {
        // line 26
        echo "                <div id=\"header\" class=\"relative bg-white flex justify-between items-center rounded-t h-24 sm:h-32\">

                    <a id=\"header-logo\" class=\"block max-w-xs sm:max-w-full leading-none\" href=\"";
        // line 28
        echo twig_escape_filter($this->env, ($context["absoluteURL"] ?? null), "html", null, true);
        echo "\">
                        <img class=\"block max-w-full\" alt=\"Logo\" src=\"";
        // line 29
        echo twig_escape_filter($this->env, ($context["absoluteURL"] ?? null), "html", null, true);
        echo "/";
        echo twig_escape_filter($this->env, (((isset($context["organisationLogo"]) || array_key_exists("organisationLogo", $context))) ? (_twig_default_filter(($context["organisationLogo"] ?? null), "/themes/Default/img/logo.png")) : ("/themes/Default/img/logo.png")), "html", null, true);
        echo "\" width=\"400\"/>
                    </a>

                    <div class=\"flex-grow flex justify-end\">
                        ";
        // line 33
        echo ($context["fastFinder"] ?? null);
        echo "
                    </div>
                </div>

                <nav id=\"header-menu\" class=\"w-full bg-gray-200 justify-between\">
                    ";
        // line 38
        echo twig_include($this->env, $context, "menu.twig.html");
        echo "
                </nav>

                ";
    }

    // line 47
    public function block_sidebar($context, array $blocks = array())
    {
        // line 48
        echo "                            ";
        echo twig_include($this->env, $context, "navigation.twig.html");
        echo "
                            ";
    }

    // line 56
    public function block_page($context, array $blocks = array())
    {
        // line 57
        echo "
                        <button id=\"sidebarToggle\" class=\"hidden lg:block absolute top-0 right-0 m-1 px-2 pb-1 text-gray-500 text-2xl bg-transparent font-sans rounded hover:bg-gray-600 hover:text-white leading-tight\">»</button>

                        ";
        // line 60
        if ((($context["content"] ?? null) &&  !($context["sidebar"] ?? null))) {
            // line 61
            echo "                            ";
            echo twig_include($this->env, $context, "navigation.twig.html");
            echo "
                        ";
        }
        // line 63
        echo "
                        ";
        // line 64
        if (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "breadcrumbs", array())) {
            // line 65
            echo "                        <div class=\"sm:pt-10 lg:pt-0\">
                            <div class=\"absolute lg:static top-0 my-6 text-xs text-blue-700\">
                                ";
            // line 67
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "breadcrumbs", array()));
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
            foreach ($context['_seq'] as $context["title"] => $context["src"]) {
                // line 68
                echo "                                    ";
                if (twig_get_attribute($this->env, $this->source, $context["loop"], "last", array())) {
                    // line 69
                    echo "                                        <span class=\"trailEnd\">";
                    echo twig_escape_filter($this->env, $context["title"], "html", null, true);
                    echo "</span>
                                    ";
                } elseif (((twig_get_attribute($this->env, $this->source,                 // line 70
$context["loop"], "revindex", array()) > 5) && (twig_get_attribute($this->env, $this->source, $context["loop"], "index", array()) != 1))) {
                    // line 71
                    echo "                                        <a class=\"text-blue-700 underline\" href=\"";
                    echo twig_escape_filter($this->env, ($context["absoluteURL"] ?? null), "html", null, true);
                    echo "/";
                    echo twig_escape_filter($this->env, $context["src"], "html", null, true);
                    echo "\">...</a> >
                                    ";
                } else {
                    // line 73
                    echo "                                        <a class=\"text-blue-700 underline\" href=\"";
                    echo twig_escape_filter($this->env, ($context["absoluteURL"] ?? null), "html", null, true);
                    echo "/";
                    echo twig_escape_filter($this->env, $context["src"], "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, $context["title"], "html", null, true);
                    echo "</a> >
                                    ";
                }
                // line 75
                echo "                                ";
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
            unset($context['_seq'], $context['_iterated'], $context['title'], $context['src'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 76
            echo "                            </div>
                        </div>
                        ";
        }
        // line 79
        echo "

                        ";
        // line 81
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "alerts", array()));
        foreach ($context['_seq'] as $context["type"] => $context["alerts"]) {
            // line 82
            echo "                            ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($context["alerts"]);
            foreach ($context['_seq'] as $context["_key"] => $context["text"]) {
                // line 83
                echo "                                <div class=\"";
                echo twig_escape_filter($this->env, $context["type"], "html", null, true);
                echo "\">";
                echo $context["text"];
                echo "</div>
                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['text'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 85
            echo "                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['type'], $context['alerts'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 86
        echo "
                        ";
        // line 87
        echo twig_join_filter(($context["content"] ?? null), "
");
        echo "

                        ";
    }

    // line 95
    public function block_footer($context, array $blocks = array())
    {
        // line 96
        echo "                <div class=\"relative bg-transparent-600 text-white text-center text-sm p-6 mb-10 leading-normal rounded-b\">
                    <span class=\"inline-block\">
                        ";
        // line 98
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('__')->getCallable(), array("Powered by")), "html", null, true);
        echo " <a class=\"link-white\" target='_blank' href='https://gibbonedu.org'>Gibbon</a> ";
        echo twig_escape_filter($this->env, ($context["versionName"] ?? null), "html", null, true);
        echo "</span>
                    <span class=\"inline-block\">|  &#169; <a class=\"link-white\" target='_blank' href='http://rossparker.org'>Ross Parker</a> 2010-";
        // line 99
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, "now", "Y"), "html", null, true);
        echo "</span>
                    <br/>

                    <span class=\"text-xs\">
                        ";
        // line 103
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('__')->getCallable(), array("Created under the")), "html", null, true);
        echo " <a class=\"link-white\" target='_blank' href='https://www.gnu.org/licenses/gpl.html'>GNU GPL</a>
                        at <a class=\"link-white\" target='_blank' href='http://www.ichk.edu.hk'>ICHK</a> |
                        <a class=\"link-white\" target='_blank' href='https://gibbonedu.org/about/#ourTeam'>";
        // line 105
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('__')->getCallable(), array("Credits")), "html", null, true);
        echo "</a> |
                        <a class=\"link-white\" target='_blank' href='https://gibbonedu.org/about/#translators'>";
        // line 106
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('__')->getCallable(), array("Translators")), "html", null, true);
        echo "</a>
                        <br/>
                        ";
        // line 108
        echo twig_escape_filter($this->env, ($context["footerThemeAuthor"] ?? null), "html", null, true);
        echo "<br/>
                    </span>

                    <img class=\"absolute right-0 top-0 -mt-2 sm:mr-0 md:mr-12 opacity-75 hidden sm:block\" alt=\"Logo Small\" src=\"";
        // line 111
        echo twig_escape_filter($this->env, ($context["absoluteURL"] ?? null), "html", null, true);
        echo "/themes/";
        echo twig_escape_filter($this->env, (((isset($context["gibbonThemeName"]) || array_key_exists("gibbonThemeName", $context))) ? (_twig_default_filter(($context["gibbonThemeName"] ?? null), "Default")) : ("Default")), "html", null, true);
        echo "/img/logoFooter.png\"/>
                </div>
                ";
    }

    // line 117
    public function block_foot($context, array $blocks = array())
    {
        // line 118
        echo "        ";
        echo twig_include($this->env, $context, "foot.twig.html");
        echo "
        ";
    }

    public function getTemplateName()
    {
        return "index.twig.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  351 => 118,  348 => 117,  339 => 111,  333 => 108,  328 => 106,  324 => 105,  319 => 103,  312 => 99,  306 => 98,  302 => 96,  299 => 95,  291 => 87,  288 => 86,  282 => 85,  271 => 83,  266 => 82,  262 => 81,  258 => 79,  253 => 76,  239 => 75,  229 => 73,  221 => 71,  219 => 70,  214 => 69,  211 => 68,  194 => 67,  190 => 65,  188 => 64,  185 => 63,  179 => 61,  177 => 60,  172 => 57,  169 => 56,  162 => 48,  159 => 47,  151 => 38,  143 => 33,  134 => 29,  130 => 28,  126 => 26,  123 => 25,  116 => 15,  113 => 14,  107 => 120,  105 => 117,  100 => 114,  98 => 95,  91 => 90,  89 => 56,  84 => 54,  81 => 53,  76 => 50,  74 => 47,  71 => 46,  69 => 45,  64 => 43,  61 => 42,  59 => 25,  52 => 21,  48 => 20,  43 => 18,  40 => 17,  38 => 14,  33 => 12,  29 => 10,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{#<!--
Gibbon, Flexible & Open School System
Copyright (C) 2010, Ross Parker

This is a Gibbon template file, written in HTML and Twig syntax.
For info about editing, see: https://twig.symfony.com/doc/2.x/

TODO: add template variable details.
-->#}

<!DOCTYPE html>
<html {{ rightToLeft ? 'dir=\"rtl\"' : '' }}>
    <head>
        {% block head %}
        {{ include('head.twig.html') }}
        {% endblock head %}
    </head>
    <body style=\"{{ bodyBackground }}\">
        <div id=\"wrapOuter\" class=\"sm:px-6\">
            <div class=\"mx-auto max-w-6xl text-right text-white text-xs md:text-sm px-2 xl:px-0 {{ gibbonHouseIDLogo ? 'mt-2' : 'mt-6' }}\">
                {{ minorLinks|raw }}
            </div>

            <div id=\"wrap\" class=\"mx-auto max-w-6xl m-2 shadow-container rounded\">
                {% block header %}
                <div id=\"header\" class=\"relative bg-white flex justify-between items-center rounded-t h-24 sm:h-32\">

                    <a id=\"header-logo\" class=\"block max-w-xs sm:max-w-full leading-none\" href=\"{{ absoluteURL }}\">
                        <img class=\"block max-w-full\" alt=\"Logo\" src=\"{{ absoluteURL }}/{{ organisationLogo|default(\"/themes/Default/img/logo.png\") }}\" width=\"400\"/>
                    </a>

                    <div class=\"flex-grow flex justify-end\">
                        {{ fastFinder|raw }}
                    </div>
                </div>

                <nav id=\"header-menu\" class=\"w-full bg-gray-200 justify-between\">
                    {{ include('menu.twig.html') }}
                </nav>

                {% endblock %}

                <div id=\"content-wrap\" class=\"relative w-full min-h-1/2 flex content-start {{ sidebar ? 'flex-wrap lg:flex-no-wrap' : 'flex-col' }} lg:flex-row-reverse bg-transparent-100 clearfix\">

                    {% if sidebar %}
                        <div id=\"sidebar\" class=\"w-full lg:w-sidebar px-6 pb-6 lg:border-l\">
                            {% block sidebar %}
                            {{ include('navigation.twig.html') }}
                            {% endblock sidebar %}
                        </div>
                        <br style=\"clear: both\">
                    {% endif %}

                    <div id=\"content\" class=\"w-full {{ not sidebar ?'pt-0 sm:pt-6' }} lg:flex-1  p-6 lg:pt-0 overflow-x-scroll sm:overflow-x-auto\">

                        {% block page %}

                        <button id=\"sidebarToggle\" class=\"hidden lg:block absolute top-0 right-0 m-1 px-2 pb-1 text-gray-500 text-2xl bg-transparent font-sans rounded hover:bg-gray-600 hover:text-white leading-tight\">»</button>

                        {% if content and not sidebar %}
                            {{ include('navigation.twig.html') }}
                        {% endif %}

                        {% if page.breadcrumbs %}
                        <div class=\"sm:pt-10 lg:pt-0\">
                            <div class=\"absolute lg:static top-0 my-6 text-xs text-blue-700\">
                                {% for title, src in page.breadcrumbs %}
                                    {% if loop.last %}
                                        <span class=\"trailEnd\">{{ title }}</span>
                                    {% elseif loop.revindex > 5 and loop.index != 1 %}
                                        <a class=\"text-blue-700 underline\" href=\"{{ absoluteURL }}/{{ src }}\">...</a> >
                                    {% else %}
                                        <a class=\"text-blue-700 underline\" href=\"{{ absoluteURL }}/{{ src }}\">{{ title }}</a> >
                                    {% endif %}
                                {% endfor %}
                            </div>
                        </div>
                        {% endif %}


                        {% for type, alerts in page.alerts %}
                            {% for text in alerts %}
                                <div class=\"{{ type }}\">{{ text|raw }}</div>
                            {% endfor %}
                        {% endfor %}

                        {{ content|join(\"\\n\")|raw }}

                        {% endblock %}
                    </div>


                </div>

                {% block footer %}
                <div class=\"relative bg-transparent-600 text-white text-center text-sm p-6 mb-10 leading-normal rounded-b\">
                    <span class=\"inline-block\">
                        {{ __('Powered by') }} <a class=\"link-white\" target='_blank' href='https://gibbonedu.org'>Gibbon</a> {{ versionName }}</span>
                    <span class=\"inline-block\">|  &#169; <a class=\"link-white\" target='_blank' href='http://rossparker.org'>Ross Parker</a> 2010-{{ 'now'|date('Y') }}</span>
                    <br/>

                    <span class=\"text-xs\">
                        {{ __('Created under the') }} <a class=\"link-white\" target='_blank' href='https://www.gnu.org/licenses/gpl.html'>GNU GPL</a>
                        at <a class=\"link-white\" target='_blank' href='http://www.ichk.edu.hk'>ICHK</a> |
                        <a class=\"link-white\" target='_blank' href='https://gibbonedu.org/about/#ourTeam'>{{ __('Credits') }}</a> |
                        <a class=\"link-white\" target='_blank' href='https://gibbonedu.org/about/#translators'>{{ __('Translators') }}</a>
                        <br/>
                        {{ footerThemeAuthor }}<br/>
                    </span>

                    <img class=\"absolute right-0 top-0 -mt-2 sm:mr-0 md:mr-12 opacity-75 hidden sm:block\" alt=\"Logo Small\" src=\"{{ absoluteURL }}/themes/{{ gibbonThemeName|default(\"Default\") }}/img/logoFooter.png\"/>
                </div>
                {% endblock %}
            </div>
        </div>

        {% block foot %}
        {{ include('foot.twig.html') }}
        {% endblock foot %}
    </body>
</html>
", "index.twig.html", "/home/felipe/gibbon/core_gyansetu/resources/templates/index.twig.html");
    }
}
