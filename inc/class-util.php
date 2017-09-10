<?php

namespace Ankur\Plugins\Prism_For_WP;
/**
 * Class Util
 * @package Ankur\Plugins\Prism_For_WP
 */
class Util
{
    // Plugin dir path
    private $path;

    public function __construct()
    {
        $this->path = plugin_dir_path(APFW_BASE_FILE);
    }

    public function get_themes_list()
    {
        // Base url for demos
        $baseUrl = 'http://prismjs.com/index.html?theme=';

        $list = array(
            1 => array('name' => 'Default', 'url' => $baseUrl . 'prism', 'file' => 'prism'),
            2 => array('name' => 'Coy', 'url' => $baseUrl . 'prism-coy', 'file' => 'prism-coy'),
            3 => array('name' => 'Dark', 'url' => $baseUrl . 'prism-dark', 'file' => 'prism-dark'),
            4 => array('name' => 'Okaidia', 'url' => $baseUrl . 'prism-okaidia', 'file' => 'prism-okaidia'),
            5 => array('name' => 'Tomorrow', 'url' => $baseUrl . 'prism-tomorrow', 'file' => 'prism-tomorrow'),
            6 => array('name' => 'Twilight', 'url' => $baseUrl . 'prism-twilight', 'file' => 'prism-twilight'),

        );
        return $list;
    }

    public function get_plugins_list()
    {
        // lets not repeat code ,since domains are subject to change
        $baseUrl = 'http://prismjs.com/plugins/';

        // JS and related CSS file name must be same, except extension
        $list = array(
            1 => array('name' => 'Autolinker ', 'url' => $baseUrl . 'autolinker/', 'file' => 'prism-autolinker', 'need_css' => 1),
            2 => array('name' => 'Autoloader ', 'url' => $baseUrl . 'autoloader/', 'file' => 'prism-autoloader', 'need_css' => 0),

            3 => array('name' => 'Command Line', 'url' => $baseUrl . 'command-line/', 'file' => 'prism-command-line', 'need_css' => 1),
            4 => array('name' => 'Copy to Clipboard', 'url' => $baseUrl . 'copy-to-clipboard/', 'file' => 'prism-copy-to-clipboard', 'need_css' => 1),

            5 => array('name' => 'File Highlight ', 'url' => $baseUrl . 'file-highlight/', 'file' => 'prism-file-highlight', 'need_css' => 0),
            6 => array('name' => 'Line Highlight', 'url' => $baseUrl . 'line-highlight/', 'file' => 'prism-line-highlight', 'need_css' => 1),
            7 => array('name' => 'Line Numbers', 'url' => $baseUrl . 'line-numbers/', 'file' => 'prism-line-numbers', 'need_css' => 1),

            8 => array('name' => 'Preview: Base', 'url' => $baseUrl . 'previewer-base/', 'file' => 'prism-previewer-base', 'need_css' => 1),
            9 => array('name' => 'Preview: Angle', 'url' => $baseUrl . 'previewer-angle/', 'file' => 'prism-previewer-angle', 'need_css' => 1),
            10 => array('name' => 'Preview: Color', 'url' => $baseUrl . 'previewer-color/', 'file' => 'prism-previewer-color', 'need_css' => 1),
            11 => array('name' => 'Preview: Easing', 'url' => $baseUrl . 'previewer-easing/', 'file' => 'prism-previewer-easing', 'need_css' => 1),
            12 => array('name' => 'Preview: Gradient', 'url' => $baseUrl . 'previewer-gradient/', 'file' => 'prism-previewer-gradient', 'need_css' => 1),
            13 => array('name' => 'Preview: Time', 'url' => $baseUrl . 'previewer-time/', 'file' => 'prism-previewer-time', 'need_css' => 1),

            14 => array('name' => 'Show Invisibles', 'url' => $baseUrl . 'show-invisibles/', 'file' => 'prism-show-invisibles', 'need_css' => 1),
            15 => array('name' => 'Show Language', 'url' => $baseUrl . 'show-language/', 'file' => 'prism-show-language', 'need_css' => 1),
            // Docs not correctly linking
            // 16 => array('name' => 'WebPlatform Docs', 'url' => $base_url . 'wpd/', 'file' => 'prism-wpd', 'need_css' => 1),
            16 => array('name' => 'Normalize Whitespace', 'url' => $baseUrl . 'normalize-whitespace/', 'file' => 'prism-normalize-whitespace', 'need_css' => 0),
        );
        return $list;
    }

    public function get_langs_list()
    {
        // Alphabetical order except for dependencies,
        // they must come first. (ex: CSS has to come 
        // before CSS-extras)

        $list = array(
            1 => array('id' => 'markup', 'name' => 'Markup', 'file' => 'prism-markup', 'require' => '', 'in_popup' => 1),
            2 => array('id' => 'css', 'name' => 'CSS', 'file' => 'prism-css', 'require' => '', 'in_popup' => 1),
            3 => array('id' => 'css-extras', 'name' => 'CSS Extras', 'file' => 'prism-css-extras', 'require' => 'css', 'in_popup' => 0),
            4 => array('id' => 'clike', 'name' => 'C-Like', 'file' => 'prism-clike', 'require' => '', 'in_popup' => 1),
            5 => array('id' => 'javascript', 'name' => 'Java-Script', 'file' => 'prism-javascript', 'require' => 'clike', 'in_popup' => 1),
            6 => array('id' => 'php', 'name' => 'PHP', 'file' => 'prism-php', 'require' => 'clike', 'in_popup' => 1),
            7 => array('id' => 'php-extras', 'name' => 'PHP Extras', 'file' => 'prism-php-extras', 'require' => 'php', 'in_popup' => 0),
            8 => array('id' => 'ruby', 'name' => 'Ruby', 'file' => 'prism-ruby', 'require' => 'clike', 'in_popup' => 1),
            9 => array('id' => 'sql', 'name' => 'SQL', 'file' => 'prism-sql', 'require' => '', 'in_popup' => 1),
            10 => array('id' => 'c', 'name' => 'C', 'file' => 'prism-c', 'require' => 'clike', 'in_popup' => 1),
            11 => array('id' => 'abap', 'name' => 'ABAP', 'file' => 'prism-abap', 'require' => '', 'in_popup' => 1),
            12 => array('id' => 'actionscript', 'name' => 'ActionScript', 'file' => 'prism-actionscript', 'require' => 'javascript', 'in_popup' => 1),
            13 => array('id' => 'ada', 'name' => 'Ada', 'file' => 'prism-ada', 'require' => '', 'in_popup' => 1),
            14 => array('id' => 'apacheconf', 'name' => 'Apache Configuration', 'file' => 'prism-apacheconf', 'require' => '', 'in_popup' => 1),
            15 => array('id' => 'apl', 'name' => 'APL', 'file' => 'prism-apl', 'require' => '', 'in_popup' => 1),
            16 => array('id' => 'applescript', 'name' => 'Applescript', 'file' => 'prism-applescript', 'require' => '', 'in_popup' => 1),
            17 => array('id' => 'asciidoc', 'name' => 'AsciiDoc', 'file' => 'prism-asciidoc', 'require' => '', 'in_popup' => 1),
            18 => array('id' => 'aspnet', 'name' => 'ASP.NET (C#)', 'file' => 'prism-aspnet', 'require' => 'markup', 'in_popup' => 1),
            19 => array('id' => 'autoit', 'name' => 'AutoIt', 'file' => 'prism-autoit', 'require' => '', 'in_popup' => 1),
            20 => array('id' => 'autohotkey', 'name' => 'AutoHotkey', 'file' => 'prism-autohotkey', 'require' => '', 'in_popup' => 1),
            21 => array('id' => 'bash', 'name' => 'Bash', 'file' => 'prism-bash', 'require' => '', 'in_popup' => 1),
            22 => array('id' => 'basic', 'name' => 'BASIC', 'file' => 'prism-basic', 'require' => '', 'in_popup' => 1),
            23 => array('id' => 'batch', 'name' => 'Batch', 'file' => 'prism-batch', 'require' => '', 'in_popup' => 1),
            24 => array('id' => 'bison', 'name' => 'Bison', 'file' => 'prism-bison', 'require' => 'c', 'in_popup' => 1),
            25 => array('id' => 'brainfuck', 'name' => 'Brainfuck', 'file' => 'prism-brainfuck', 'require' => '', 'in_popup' => 1),
            26 => array('id' => 'bro', 'name' => 'Bro', 'file' => 'prism-bro', 'require' => '', 'in_popup' => 1),
            27 => array('id' => 'csharp', 'name' => 'C#', 'file' => 'prism-csharp', 'require' => 'c', 'in_popup' => 1),
            28 => array('id' => 'cpp', 'name' => 'C++', 'file' => 'prism-cpp', 'require' => 'c', 'in_popup' => 1),
            29 => array('id' => 'coffeescript', 'name' => 'CoffeeScript', 'file' => 'prism-coffeescript', 'require' => 'javascript', 'in_popup' => 1),
            30 => array('id' => 'crystal', 'name' => 'Crystal', 'file' => 'prism-crystal', 'require' => 'ruby', 'in_popup' => 1),
            31 => array('id' => 'd', 'name' => 'D', 'file' => 'prism-d', 'require' => 'clike', 'in_popup' => 1),
            32 => array('id' => 'dart', 'name' => 'Dart', 'file' => 'prism-dart', 'require' => 'clike', 'in_popup' => 1),
            33 => array('id' => 'diff', 'name' => 'Diff', 'file' => 'prism-diff', 'require' => '', 'in_popup' => 1),
            34 => array('id' => 'django', 'name' => 'Django/Jinja2', 'file' => 'prism-django', 'require' => 'markup', 'in_popup' => 1),
            35 => array('id' => 'docker', 'name' => 'Docker', 'file' => 'prism-docker', 'require' => '', 'in_popup' => 1),
            36 => array('id' => 'eiffel', 'name' => 'Eiffel', 'file' => 'prism-eiffel', 'require' => '', 'in_popup' => 1),
            37 => array('id' => 'elixir', 'name' => 'Elixir', 'file' => 'prism-elixir', 'require' => '', 'in_popup' => 1),
            38 => array('id' => 'erlang', 'name' => 'Erlang', 'file' => 'prism-erlang', 'require' => '', 'in_popup' => 1),
            39 => array('id' => 'fsharp', 'name' => 'F#', 'file' => 'prism-fsharp', 'require' => 'clike', 'in_popup' => 1),
            40 => array('id' => 'fortran', 'name' => 'Fortran', 'file' => 'prism-fortran', 'require' => '', 'in_popup' => 1),
            41 => array('id' => 'gherkin', 'name' => 'Gherkin', 'file' => 'prism-gherkin', 'require' => '', 'in_popup' => 1),
            42 => array('id' => 'git', 'name' => 'Git', 'file' => 'prism-git', 'require' => '', 'in_popup' => 1),
            43 => array('id' => 'glsl', 'name' => 'GLSL', 'file' => 'prism-glsl', 'require' => 'clike', 'in_popup' => 1),
            44 => array('id' => 'go', 'name' => 'Go', 'file' => 'prism-go', 'require' => 'clike', 'in_popup' => 1),
            45 => array('id' => 'graphql', 'name' => 'GraphQL', 'file' => 'prism-graphql', 'require' => '', 'in_popup' => 1),
            46 => array('id' => 'groovy', 'name' => 'Groovy', 'file' => 'prism-groovy', 'require' => 'clike', 'in_popup' => 1),
            47 => array('id' => 'haml', 'name' => 'Haml', 'file' => 'prism-haml', 'require' => 'ruby', 'in_popup' => 1),
            48 => array('id' => 'handlebars', 'name' => 'Handlebars', 'file' => 'prism-handlebars', 'require' => 'markup', 'in_popup' => 1),
            49 => array('id' => 'haskell', 'name' => 'Haskell', 'file' => 'prism-haskell', 'require' => '', 'in_popup' => 1),
            50 => array('id' => 'haxe', 'name' => 'Haxe', 'file' => 'prism-haxe', 'require' => 'clike', 'in_popup' => 1),
            51 => array('id' => 'http', 'name' => 'HTTP', 'file' => 'prism-http', 'require' => '', 'in_popup' => 1),
            52 => array('id' => 'icon', 'name' => 'Icon', 'file' => 'prism-icon', 'require' => '', 'in_popup' => 1),
            53 => array('id' => 'inform7', 'name' => 'Inform 7', 'file' => 'prism-inform7', 'require' => '', 'in_popup' => 1),
            54 => array('id' => 'ini', 'name' => 'Ini', 'file' => 'prism-ini', 'require' => '', 'in_popup' => 1),
            55 => array('id' => 'j', 'name' => 'J', 'file' => 'prism-j', 'require' => '', 'in_popup' => 1),
            56 => array('id' => 'jade', 'name' => 'Jade', 'file' => 'prism-jade', 'require' => 'javascript', 'in_popup' => 1),
            57 => array('id' => 'java', 'name' => 'Java', 'file' => 'prism-java', 'require' => 'clike', 'in_popup' => 1),
            58 => array('id' => 'jolie', 'name' => 'Jolie', 'file' => 'prism-jolie', 'require' => 'clike', 'in_popup' => 1),
            59 => array('id' => 'json', 'name' => 'JSON', 'file' => 'prism-json', 'require' => '', 'in_popup' => 1),
            60 => array('id' => 'julia', 'name' => 'Julia', 'file' => 'prism-julia', 'require' => '', 'in_popup' => 1),
            61 => array('id' => 'keyman', 'name' => 'Keyman', 'file' => 'prism-keyman', 'require' => '', 'in_popup' => 1),
            62 => array('id' => 'kotlin', 'name' => 'Kotlin', 'file' => 'prism-kotlin', 'require' => 'clike', 'in_popup' => 1),
            63 => array('id' => 'latex', 'name' => 'LaTex', 'file' => 'prism-latex', 'require' => '', 'in_popup' => 1),
            64 => array('id' => 'less', 'name' => 'Less', 'file' => 'prism-less', 'require' => 'css', 'in_popup' => 1),
            65 => array('id' => 'livescript', 'name' => 'LiveScript', 'file' => 'prism-livescript', 'require' => '', 'in_popup' => 1),
            66 => array('id' => 'lolcode', 'name' => 'LOLCODE', 'file' => 'prism-lolcode', 'require' => '', 'in_popup' => 1),
            67 => array('id' => 'lua', 'name' => 'Lua', 'file' => 'prism-lua', 'require' => '', 'in_popup' => 1),
            68 => array('id' => 'makefile', 'name' => 'Makefile', 'file' => 'prism-makefile', 'require' => '', 'in_popup' => 1),
            69 => array('id' => 'markdown', 'name' => 'Markdown', 'file' => 'prism-markdown', 'require' => 'markup', 'in_popup' => 1),
            70 => array('id' => 'matlab', 'name' => 'MATLAB', 'file' => 'prism-matlab', 'require' => '', 'in_popup' => 1),
            71 => array('id' => 'mel', 'name' => 'MEL', 'file' => 'prism-mel', 'require' => '', 'in_popup' => 1),
            72 => array('id' => 'mizar', 'name' => 'Mizar', 'file' => 'prism-mizar', 'require' => '', 'in_popup' => 1),
            73 => array('id' => 'monkey', 'name' => 'Monkey', 'file' => 'prism-monkey', 'require' => '', 'in_popup' => 1),
            74 => array('id' => 'nasm', 'name' => 'NASM', 'file' => 'prism-nasm', 'require' => '', 'in_popup' => 1),
            75 => array('id' => 'nginx', 'name' => 'nginx', 'file' => 'prism-nginx', 'require' => 'clike', 'in_popup' => 1),
            76 => array('id' => 'nim', 'name' => 'Nim', 'file' => 'prism-nim', 'require' => '', 'in_popup' => 1),
            77 => array('id' => 'nix', 'name' => 'Nix', 'file' => 'prism-nix', 'require' => '', 'in_popup' => 1),
            78 => array('id' => 'objectivec', 'name' => 'Objective-C', 'file' => 'prism-objectivec', 'require' => 'c', 'in_popup' => 1),
            79 => array('id' => 'ocaml', 'name' => 'OCaml', 'file' => 'prism-ocaml', 'require' => '', 'in_popup' => 1),
            80 => array('id' => 'oz', 'name' => 'Oz', 'file' => 'prism-oz', 'require' => '', 'in_popup' => 1),
            81 => array('id' => 'parigp', 'name' => 'PARI/GP', 'file' => 'prism-parigp', 'require' => '', 'in_popup' => 1),
            82 => array('id' => 'parser', 'name' => 'Parser', 'file' => 'prism-parser', 'require' => 'markup', 'in_popup' => 1),
            83 => array('id' => 'pascal', 'name' => 'Pascal', 'file' => 'prism-pascal', 'require' => '', 'in_popup' => 1),
            84 => array('id' => 'perl', 'name' => 'Perl', 'file' => 'prism-perl', 'require' => '', 'in_popup' => 1),
            85 => array('id' => 'powershell', 'name' => 'PowerShell', 'file' => 'prism-powershell', 'require' => '', 'in_popup' => 1),
            86 => array('id' => 'processing', 'name' => 'Processing', 'file' => 'prism-processing', 'require' => 'clike', 'in_popup' => 1),
            87 => array('id' => 'prolog', 'name' => 'Prolog', 'file' => 'prism-prolog', 'require' => '', 'in_popup' => 1),
            88 => array('id' => 'properties', 'name' => '.properties', 'file' => 'prism-properties', 'require' => '', 'in_popup' => 1),
            89 => array('id' => 'protobuf', 'name' => 'Protocol Buffers', 'file' => 'prism-protobuf', 'require' => 'clike', 'in_popup' => 1),
            90 => array('id' => 'puppet', 'name' => 'Puppet', 'file' => 'prism-puppet', 'require' => '', 'in_popup' => 1),
            91 => array('id' => 'pure', 'name' => 'Pure', 'file' => 'prism-pure', 'require' => '', 'in_popup' => 1),
            92 => array('id' => 'python', 'name' => 'Python', 'file' => 'prism-python', 'require' => '', 'in_popup' => 1),
            93 => array('id' => 'q', 'name' => 'Q', 'file' => 'prism-q', 'require' => '', 'in_popup' => 1),
            94 => array('id' => 'qore', 'name' => 'Qore', 'file' => 'prism-qore', 'require' => 'clike', 'in_popup' => 1),
            95 => array('id' => 'r', 'name' => 'R', 'file' => 'prism-r', 'require' => '', 'in_popup' => 1),
            96 => array('id' => 'jsx', 'name' => 'React JSX', 'file' => 'prism-jsx', 'require' => 'markup', 'in_popup' => 1),
            97 => array('id' => 'reason', 'name' => 'Reason', 'file' => 'prism-reason', 'require' => 'clike', 'in_popup' => 1),
            98 => array('id' => 'rest', 'name' => 'reST (reStructuredText)', 'file' => 'prism-rest', 'require' => '', 'in_popup' => 1),
            99 => array('id' => 'rip', 'name' => 'Rip', 'file' => 'prism-rip', 'require' => '', 'in_popup' => 1),
            100 => array('id' => 'roboconf', 'name' => 'Roboconf', 'file' => 'prism-roboconf', 'require' => '', 'in_popup' => 1),
            101 => array('id' => 'rust', 'name' => 'Rust', 'file' => 'prism-rust', 'require' => '', 'in_popup' => 1),
            102 => array('id' => 'sas', 'name' => 'SAS', 'file' => 'prism-sas', 'require' => '', 'in_popup' => 1),
            103 => array('id' => 'sass', 'name' => 'Sass (Sass)', 'file' => 'prism-sass', 'require' => 'css', 'in_popup' => 1),
            104 => array('id' => 'scss', 'name' => 'Sass (Scss)', 'file' => 'prism-scss', 'require' => 'css', 'in_popup' => 1),
            105 => array('id' => 'scala', 'name' => 'Scala', 'file' => 'prism-scala', 'require' => 'clike', 'in_popup' => 1),
            106 => array('id' => 'scheme', 'name' => 'Scheme', 'file' => 'prism-scheme', 'require' => '', 'in_popup' => 1),
            107 => array('id' => 'smalltalk', 'name' => 'Smalltalk', 'file' => 'prism-smalltalk', 'require' => '', 'in_popup' => 1),
            108 => array('id' => 'smarty', 'name' => 'Smarty', 'file' => 'prism-smarty', 'require' => 'markup', 'in_popup' => 1),
            109 => array('id' => 'stylus', 'name' => 'Stylus', 'file' => 'prism-stylus', 'require' => '', 'in_popup' => 1),
            110 => array('id' => 'swift', 'name' => 'Swift', 'file' => 'prism-swift', 'require' => 'clike', 'in_popup' => 1),
            111 => array('id' => 'tcl', 'name' => 'Tcl', 'file' => 'prism-tcl', 'require' => '', 'in_popup' => 1),
            112 => array('id' => 'textile', 'name' => 'Textile', 'file' => 'prism-textile', 'require' => 'markup', 'in_popup' => 1),
            113 => array('id' => 'twig', 'name' => 'Twig', 'file' => 'prism-twig', 'require' => 'markup', 'in_popup' => 1),
            114 => array('id' => 'typescript', 'name' => 'TypeScript', 'file' => 'prism-typescript', 'require' => 'javascript', 'in_popup' => 1),
            115 => array('id' => 'verilog', 'name' => 'Verilog', 'file' => 'prism-verilog', 'require' => '', 'in_popup' => 1),
            116 => array('id' => 'vhdl', 'name' => 'VHDL', 'file' => 'prism-vhdl', 'require' => '', 'in_popup' => 1),
            117 => array('id' => 'vim', 'name' => 'vim', 'file' => 'prism-vim', 'require' => '', 'in_popup' => 1),
            118 => array('id' => 'wiki', 'name' => 'Wiki markup', 'file' => 'prism-wiki', 'require' => 'markup', 'in_popup' => 1),
            119 => array('id' => 'xojo', 'name' => 'Xojo (REALbasic)', 'file' => 'prism-xojo', 'require' => '', 'in_popup' => 1),
            120 => array('id' => 'yaml', 'name' => 'YAML', 'file' => 'prism-yaml', 'require' => '', 'in_popup' => 1),

        );
        return $list;
    }

    public function get_file_modify_time($file)
    {
        $file = $this->path . 'out/' . $file;
        if (file_exists($file)) {
            $mtime = filemtime($file);
            if ($mtime) {
                return esc_attr($mtime);
            }

        }
        return '';
    }

    public function write_file($data, $file)
    {
        $file = $this->path . 'out/' . $file;
        $handle = fopen($file, 'w');
        if ($handle) {
            if (!fwrite($handle, $data)) {
                //could not write file
                @fclose($handle);

            } else {
                //success
                @fclose($handle);

            }
        }
    }

    public function delete_file($file)
    {
        $file = $this->path . 'out/' . $file;
        if (file_exists($file)) {
            @unlink($file);
        }
    }

    public function minify_css($buffer)
    {
        // Remove comments
        $buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
        // Remove tabs, spaces, newlines, etc.
        $buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '     '), '', $buffer);
        // Remove other spaces before/after ;
        $buffer = preg_replace(array('(( )+{)', '({( )+)'), '{', $buffer);
        $buffer = preg_replace(array('(( )+})', '(}( )+)', '(;( )*})'), '}', $buffer);
        $buffer = preg_replace(array('(;( )+)', '(( )+;)'), ';', $buffer);
        return $buffer;
    }

    /**
     * Load view and show it to front-end
     * @param $file string File name without ext
     * @param $options array Array to be passed to view, not an unused variable
     * @throws \Exception
     */
    public function load_view($file, $options = array())
    {
        $file_path = $this->path . 'views/' . $file . '.php';
        if (is_readable($file_path)) {
            // Make array keys available as variable on view
            extract($options);
            require $file_path;
        } else {
            throw new \Exception('Unable to load template file - ' . esc_html($file_path));
        }
    }


}