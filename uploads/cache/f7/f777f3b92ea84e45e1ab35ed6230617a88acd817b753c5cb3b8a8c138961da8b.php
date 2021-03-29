<?php

/* menu.twig.html */
class __TwigTemplate_181725059b155894361c751972dd4e0761a85b5e5f9549f4a1d4af29410d2088 extends Twig_Template
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
        // line 10
        echo "
<ul class=\"list-none flex flex-wrap items-center m-0 px-2 border-t border-b\">
    <li class=\"pl-2 mt-1\">
        <a class=\"block uppercase font-bold text-sm text-gray-800 hover:text-purple-500 no-underline px-2 py-3\" href=\"";
        // line 13
        echo twig_escape_filter($this->env, ($context["absoluteURL"] ?? null), "html", null, true);
        echo "/index.php\">";
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('__')->getCallable(), array("Home")), "html", null, true);
        echo "</a>
    </li>

    ";
        // line 16
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["menuMain"] ?? null));
        foreach ($context['_seq'] as $context["categoryName"] => $context["items"]) {
            if (($context["isLoggedIn"] ?? null)) {
                // line 17
                echo "    <li class=\"sm:relative group mt-1\">
        <a class=\"block uppercase font-bold text-sm text-gray-800 hover:text-purple-500 no-underline px-2 py-3\" href=\"#\">";
                // line 18
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('__')->getCallable(), array($context["categoryName"])), "html", null, true);
                echo "</a>

        <ul class=\"list-none bg-transparent-900 absolute hidden group-hover:block w-full sm:w-48 left-0 m-0 -mt-1 py-1 sm:p-1 z-50\">
            ";
                // line 21
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($context["items"]);
                foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                    // line 22
                    echo "            <li class=\"hover:bg-purple-700\">
                <a class=\"block text-sm text-white focus:text-purple-200 text-left no-underline px-1 py-2 md:py-1 leading-normal\" href=\"";
                    // line 23
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "url", array()), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('__')->getCallable(), array(twig_get_attribute($this->env, $this->source, $context["item"], "name", array()), twig_get_attribute($this->env, $this->source, $context["item"], "textDomain", array()))), "html", null, true);
                    echo "</a>
            </li>
            ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 26
                echo "        </ul>
    </li>
    ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['categoryName'], $context['items'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 29
        echo "
    <li class=\"notificationTray self-end flex-grow\">
        ";
        // line 31
        echo ($context["notificationTray"] ?? null);
        echo "
    </li>
</ul>


";
    }

    public function getTemplateName()
    {
        return "menu.twig.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  81 => 31,  77 => 29,  68 => 26,  57 => 23,  54 => 22,  50 => 21,  44 => 18,  41 => 17,  36 => 16,  28 => 13,  23 => 10,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{#<!--
Gibbon, Flexible & Open School System
Copyright (C) 2010, Ross Parker

This is a Gibbon template file, written in HTML and Twig syntax.
For info about editing, see: https://twig.symfony.com/doc/2.x/

Main Menu: Displays the top-level categories and active modules.
-->#}

<ul class=\"list-none flex flex-wrap items-center m-0 px-2 border-t border-b\">
    <li class=\"pl-2 mt-1\">
        <a class=\"block uppercase font-bold text-sm text-gray-800 hover:text-purple-500 no-underline px-2 py-3\" href=\"{{ absoluteURL }}/index.php\">{{ __('Home') }}</a>
    </li>

    {% for categoryName, items in menuMain if isLoggedIn %}
    <li class=\"sm:relative group mt-1\">
        <a class=\"block uppercase font-bold text-sm text-gray-800 hover:text-purple-500 no-underline px-2 py-3\" href=\"#\">{{ __(categoryName) }}</a>

        <ul class=\"list-none bg-transparent-900 absolute hidden group-hover:block w-full sm:w-48 left-0 m-0 -mt-1 py-1 sm:p-1 z-50\">
            {% for item in items %}
            <li class=\"hover:bg-purple-700\">
                <a class=\"block text-sm text-white focus:text-purple-200 text-left no-underline px-1 py-2 md:py-1 leading-normal\" href=\"{{ item.url }}\">{{ __(item.name, item.textDomain) }}</a>
            </li>
            {% endfor %}
        </ul>
    </li>
    {% endfor %}

    <li class=\"notificationTray self-end flex-grow\">
        {{ notificationTray|raw }}
    </li>
</ul>


", "menu.twig.html", "/home/felipe/gibbon/core_gyansetu/resources/templates/menu.twig.html");
    }
}
