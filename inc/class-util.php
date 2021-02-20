<?php

namespace Ankur\Plugins\Prism_For_WP;
/**
 * Class Util
 * @package Ankur\Plugins\Prism_For_WP
 */
class Util
{
    // Plugin dir path
    protected $path;

    public function __construct()
    {
        $this->path = plugin_dir_path(APFW_BASE_FILE);
    }

    public function get_themes_list()
    {
        // Base url for demos
        $baseUrl = 'http://prismjs.com/index.html?theme=';

        return [
            1 => ['name' => 'Default', 'url' => $baseUrl . 'prism', 'file' => 'prism'],
            2 => ['name' => 'Coy', 'url' => $baseUrl . 'prism-coy', 'file' => 'prism-coy'],
            3 => ['name' => 'Dark', 'url' => $baseUrl . 'prism-dark', 'file' => 'prism-dark'],
            4 => ['name' => 'Okaidia', 'url' => $baseUrl . 'prism-okaidia', 'file' => 'prism-okaidia'],
            5 => ['name' => 'Tomorrow', 'url' => $baseUrl . 'prism-tomorrow', 'file' => 'prism-tomorrow'],
            6 => ['name' => 'Twilight', 'url' => $baseUrl . 'prism-twilight', 'file' => 'prism-twilight'],
        ];
    }

    public function get_plugins_list()
    {
        // lets not repeat code ,since domains are subject to change
        $baseUrl = 'http://prismjs.com/plugins/';

        // JS and related CSS file name must be same, except extension
        return [
            1 => ['name' => 'Autolinker ', 'url' => $baseUrl . 'autolinker/', 'file' => 'prism-autolinker', 'need_css' => 1],
            2 => ['name' => 'Autoloader ', 'url' => $baseUrl . 'autoloader/', 'file' => 'prism-autoloader', 'need_css' => 0],

            3 => ['name' => 'Command Line', 'url' => $baseUrl . 'command-line/', 'file' => 'prism-command-line', 'need_css' => 1],
            4 => ['name' => 'Copy to Clipboard', 'url' => $baseUrl . 'copy-to-clipboard/', 'file' => 'prism-copy-to-clipboard', 'need_css' => 1],

            5 => ['name' => 'File Highlight ', 'url' => $baseUrl . 'file-highlight/', 'file' => 'prism-file-highlight', 'need_css' => 0],
            6 => ['name' => 'Line Highlight', 'url' => $baseUrl . 'line-highlight/', 'file' => 'prism-line-highlight', 'need_css' => 1],
            7 => ['name' => 'Line Numbers', 'url' => $baseUrl . 'line-numbers/', 'file' => 'prism-line-numbers', 'need_css' => 1],

            8 => ['name' => 'Preview: Base', 'url' => $baseUrl . 'previewer-base/', 'file' => 'prism-previewer-base', 'need_css' => 1],
            9 => ['name' => 'Preview: Angle', 'url' => $baseUrl . 'previewer-angle/', 'file' => 'prism-previewer-angle', 'need_css' => 1],
            10 => ['name' => 'Preview: Color', 'url' => $baseUrl . 'previewer-color/', 'file' => 'prism-previewer-color', 'need_css' => 1],
            11 => ['name' => 'Preview: Easing', 'url' => $baseUrl . 'previewer-easing/', 'file' => 'prism-previewer-easing', 'need_css' => 1],
            12 => ['name' => 'Preview: Gradient', 'url' => $baseUrl . 'previewer-gradient/', 'file' => 'prism-previewer-gradient', 'need_css' => 1],
            13 => ['name' => 'Preview: Time', 'url' => $baseUrl . 'previewer-time/', 'file' => 'prism-previewer-time', 'need_css' => 1],

            14 => ['name' => 'Show Invisibles', 'url' => $baseUrl . 'show-invisibles/', 'file' => 'prism-show-invisibles', 'need_css' => 1],
            15 => ['name' => 'Show Language', 'url' => $baseUrl . 'show-language/', 'file' => 'prism-show-language', 'need_css' => 1],
            // Docs not correctly linking
            // 16 => array('name' => 'WebPlatform Docs', 'url' => $base_url . 'wpd/', 'file' => 'prism-wpd', 'need_css' => 1),
            16 => ['name' => 'Normalize Whitespace', 'url' => $baseUrl . 'normalize-whitespace/', 'file' => 'prism-normalize-whitespace', 'need_css' => 0],
        ];
    }

    public function get_langs_list()
    {
        // Alphabetical order except for dependencies,
        // they must come first. (ex: CSS has to come 
        // before CSS-extras)

        return [
            1 => ['id' => 'markup', 'name' => 'Markup', 'file' => 'prism-markup', 'require' => '', 'in_popup' => 1],
            2 => ['id' => 'css', 'name' => 'CSS', 'file' => 'prism-css', 'require' => '', 'in_popup' => 1],
            3 => ['id' => 'css-extras', 'name' => 'CSS Extras', 'file' => 'prism-css-extras', 'require' => 'css', 'in_popup' => 0],
            4 => ['id' => 'clike', 'name' => 'C-Like', 'file' => 'prism-clike', 'require' => '', 'in_popup' => 1],
            5 => ['id' => 'javascript', 'name' => 'Java-Script', 'file' => 'prism-javascript', 'require' => 'clike', 'in_popup' => 1],
            6 => ['id' => 'php', 'name' => 'PHP', 'file' => 'prism-php', 'require' => 'clike', 'in_popup' => 1],
            7 => ['id' => 'php-extras', 'name' => 'PHP Extras', 'file' => 'prism-php-extras', 'require' => 'php', 'in_popup' => 0],
            8 => ['id' => 'ruby', 'name' => 'Ruby', 'file' => 'prism-ruby', 'require' => 'clike', 'in_popup' => 1],
            9 => ['id' => 'sql', 'name' => 'SQL', 'file' => 'prism-sql', 'require' => '', 'in_popup' => 1],
            10 => ['id' => 'c', 'name' => 'C', 'file' => 'prism-c', 'require' => 'clike', 'in_popup' => 1],
            11 => ['id' => 'abap', 'name' => 'ABAP', 'file' => 'prism-abap', 'require' => '', 'in_popup' => 1],
            12 => ['id' => 'actionscript', 'name' => 'ActionScript', 'file' => 'prism-actionscript', 'require' => 'javascript', 'in_popup' => 1],
            13 => ['id' => 'ada', 'name' => 'Ada', 'file' => 'prism-ada', 'require' => '', 'in_popup' => 1],
            14 => ['id' => 'apacheconf', 'name' => 'Apache Configuration', 'file' => 'prism-apacheconf', 'require' => '', 'in_popup' => 1],
            15 => ['id' => 'apl', 'name' => 'APL', 'file' => 'prism-apl', 'require' => '', 'in_popup' => 1],
            16 => ['id' => 'applescript', 'name' => 'Applescript', 'file' => 'prism-applescript', 'require' => '', 'in_popup' => 1],
            17 => ['id' => 'asciidoc', 'name' => 'AsciiDoc', 'file' => 'prism-asciidoc', 'require' => '', 'in_popup' => 1],
            18 => ['id' => 'aspnet', 'name' => 'ASP.NET (C#)', 'file' => 'prism-aspnet', 'require' => 'markup', 'in_popup' => 1],
            19 => ['id' => 'autoit', 'name' => 'AutoIt', 'file' => 'prism-autoit', 'require' => '', 'in_popup' => 1],
            20 => ['id' => 'autohotkey', 'name' => 'AutoHotkey', 'file' => 'prism-autohotkey', 'require' => '', 'in_popup' => 1],
            21 => ['id' => 'bash', 'name' => 'Bash', 'file' => 'prism-bash', 'require' => '', 'in_popup' => 1],
            22 => ['id' => 'basic', 'name' => 'BASIC', 'file' => 'prism-basic', 'require' => '', 'in_popup' => 1],
            23 => ['id' => 'batch', 'name' => 'Batch', 'file' => 'prism-batch', 'require' => '', 'in_popup' => 1],
            24 => ['id' => 'bison', 'name' => 'Bison', 'file' => 'prism-bison', 'require' => 'c', 'in_popup' => 1],
            25 => ['id' => 'brainfuck', 'name' => 'Brainfuck', 'file' => 'prism-brainfuck', 'require' => '', 'in_popup' => 1],
            26 => ['id' => 'bro', 'name' => 'Bro', 'file' => 'prism-bro', 'require' => '', 'in_popup' => 1],
            27 => ['id' => 'csharp', 'name' => 'C#', 'file' => 'prism-csharp', 'require' => 'c', 'in_popup' => 1],
            28 => ['id' => 'cpp', 'name' => 'C++', 'file' => 'prism-cpp', 'require' => 'c', 'in_popup' => 1],
            29 => ['id' => 'coffeescript', 'name' => 'CoffeeScript', 'file' => 'prism-coffeescript', 'require' => 'javascript', 'in_popup' => 1],
            30 => ['id' => 'crystal', 'name' => 'Crystal', 'file' => 'prism-crystal', 'require' => 'ruby', 'in_popup' => 1],
            31 => ['id' => 'd', 'name' => 'D', 'file' => 'prism-d', 'require' => 'clike', 'in_popup' => 1],
            32 => ['id' => 'dart', 'name' => 'Dart', 'file' => 'prism-dart', 'require' => 'clike', 'in_popup' => 1],
            33 => ['id' => 'diff', 'name' => 'Diff', 'file' => 'prism-diff', 'require' => '', 'in_popup' => 1],
            34 => ['id' => 'django', 'name' => 'Django/Jinja2', 'file' => 'prism-django', 'require' => 'markup', 'in_popup' => 1],
            35 => ['id' => 'docker', 'name' => 'Docker', 'file' => 'prism-docker', 'require' => '', 'in_popup' => 1],
            36 => ['id' => 'eiffel', 'name' => 'Eiffel', 'file' => 'prism-eiffel', 'require' => '', 'in_popup' => 1],
            37 => ['id' => 'elixir', 'name' => 'Elixir', 'file' => 'prism-elixir', 'require' => '', 'in_popup' => 1],
            38 => ['id' => 'erlang', 'name' => 'Erlang', 'file' => 'prism-erlang', 'require' => '', 'in_popup' => 1],
            39 => ['id' => 'fsharp', 'name' => 'F#', 'file' => 'prism-fsharp', 'require' => 'clike', 'in_popup' => 1],
            40 => ['id' => 'fortran', 'name' => 'Fortran', 'file' => 'prism-fortran', 'require' => '', 'in_popup' => 1],
            41 => ['id' => 'gherkin', 'name' => 'Gherkin', 'file' => 'prism-gherkin', 'require' => '', 'in_popup' => 1],
            42 => ['id' => 'git', 'name' => 'Git', 'file' => 'prism-git', 'require' => '', 'in_popup' => 1],
            43 => ['id' => 'glsl', 'name' => 'GLSL', 'file' => 'prism-glsl', 'require' => 'clike', 'in_popup' => 1],
            44 => ['id' => 'go', 'name' => 'Go', 'file' => 'prism-go', 'require' => 'clike', 'in_popup' => 1],
            45 => ['id' => 'graphql', 'name' => 'GraphQL', 'file' => 'prism-graphql', 'require' => '', 'in_popup' => 1],
            46 => ['id' => 'groovy', 'name' => 'Groovy', 'file' => 'prism-groovy', 'require' => 'clike', 'in_popup' => 1],
            47 => ['id' => 'haml', 'name' => 'Haml', 'file' => 'prism-haml', 'require' => 'ruby', 'in_popup' => 1],
            48 => ['id' => 'handlebars', 'name' => 'Handlebars', 'file' => 'prism-handlebars', 'require' => 'markup', 'in_popup' => 1],
            49 => ['id' => 'haskell', 'name' => 'Haskell', 'file' => 'prism-haskell', 'require' => '', 'in_popup' => 1],
            50 => ['id' => 'haxe', 'name' => 'Haxe', 'file' => 'prism-haxe', 'require' => 'clike', 'in_popup' => 1],
            51 => ['id' => 'http', 'name' => 'HTTP', 'file' => 'prism-http', 'require' => '', 'in_popup' => 1],
            52 => ['id' => 'icon', 'name' => 'Icon', 'file' => 'prism-icon', 'require' => '', 'in_popup' => 1],
            53 => ['id' => 'inform7', 'name' => 'Inform 7', 'file' => 'prism-inform7', 'require' => '', 'in_popup' => 1],
            54 => ['id' => 'ini', 'name' => 'Ini', 'file' => 'prism-ini', 'require' => '', 'in_popup' => 1],
            55 => ['id' => 'j', 'name' => 'J', 'file' => 'prism-j', 'require' => '', 'in_popup' => 1],
            56 => ['id' => 'jade', 'name' => 'Jade', 'file' => 'prism-jade', 'require' => 'javascript', 'in_popup' => 1],
            57 => ['id' => 'java', 'name' => 'Java', 'file' => 'prism-java', 'require' => 'clike', 'in_popup' => 1],
            58 => ['id' => 'jolie', 'name' => 'Jolie', 'file' => 'prism-jolie', 'require' => 'clike', 'in_popup' => 1],
            59 => ['id' => 'json', 'name' => 'JSON', 'file' => 'prism-json', 'require' => '', 'in_popup' => 1],
            60 => ['id' => 'julia', 'name' => 'Julia', 'file' => 'prism-julia', 'require' => '', 'in_popup' => 1],
            61 => ['id' => 'keyman', 'name' => 'Keyman', 'file' => 'prism-keyman', 'require' => '', 'in_popup' => 1],
            62 => ['id' => 'kotlin', 'name' => 'Kotlin', 'file' => 'prism-kotlin', 'require' => 'clike', 'in_popup' => 1],
            63 => ['id' => 'latex', 'name' => 'LaTex', 'file' => 'prism-latex', 'require' => '', 'in_popup' => 1],
            64 => ['id' => 'less', 'name' => 'Less', 'file' => 'prism-less', 'require' => 'css', 'in_popup' => 1],
            65 => ['id' => 'livescript', 'name' => 'LiveScript', 'file' => 'prism-livescript', 'require' => '', 'in_popup' => 1],
            66 => ['id' => 'lolcode', 'name' => 'LOLCODE', 'file' => 'prism-lolcode', 'require' => '', 'in_popup' => 1],
            67 => ['id' => 'lua', 'name' => 'Lua', 'file' => 'prism-lua', 'require' => '', 'in_popup' => 1],
            68 => ['id' => 'makefile', 'name' => 'Makefile', 'file' => 'prism-makefile', 'require' => '', 'in_popup' => 1],
            69 => ['id' => 'markdown', 'name' => 'Markdown', 'file' => 'prism-markdown', 'require' => 'markup', 'in_popup' => 1],
            70 => ['id' => 'matlab', 'name' => 'MATLAB', 'file' => 'prism-matlab', 'require' => '', 'in_popup' => 1],
            71 => ['id' => 'mel', 'name' => 'MEL', 'file' => 'prism-mel', 'require' => '', 'in_popup' => 1],
            72 => ['id' => 'mizar', 'name' => 'Mizar', 'file' => 'prism-mizar', 'require' => '', 'in_popup' => 1],
            73 => ['id' => 'monkey', 'name' => 'Monkey', 'file' => 'prism-monkey', 'require' => '', 'in_popup' => 1],
            74 => ['id' => 'nasm', 'name' => 'NASM', 'file' => 'prism-nasm', 'require' => '', 'in_popup' => 1],
            75 => ['id' => 'nginx', 'name' => 'nginx', 'file' => 'prism-nginx', 'require' => 'clike', 'in_popup' => 1],
            76 => ['id' => 'nim', 'name' => 'Nim', 'file' => 'prism-nim', 'require' => '', 'in_popup' => 1],
            77 => ['id' => 'nix', 'name' => 'Nix', 'file' => 'prism-nix', 'require' => '', 'in_popup' => 1],
            78 => ['id' => 'objectivec', 'name' => 'Objective-C', 'file' => 'prism-objectivec', 'require' => 'c', 'in_popup' => 1],
            79 => ['id' => 'ocaml', 'name' => 'OCaml', 'file' => 'prism-ocaml', 'require' => '', 'in_popup' => 1],
            80 => ['id' => 'oz', 'name' => 'Oz', 'file' => 'prism-oz', 'require' => '', 'in_popup' => 1],
            81 => ['id' => 'parigp', 'name' => 'PARI/GP', 'file' => 'prism-parigp', 'require' => '', 'in_popup' => 1],
            82 => ['id' => 'parser', 'name' => 'Parser', 'file' => 'prism-parser', 'require' => 'markup', 'in_popup' => 1],
            83 => ['id' => 'pascal', 'name' => 'Pascal', 'file' => 'prism-pascal', 'require' => '', 'in_popup' => 1],
            84 => ['id' => 'perl', 'name' => 'Perl', 'file' => 'prism-perl', 'require' => '', 'in_popup' => 1],
            85 => ['id' => 'powershell', 'name' => 'PowerShell', 'file' => 'prism-powershell', 'require' => '', 'in_popup' => 1],
            86 => ['id' => 'processing', 'name' => 'Processing', 'file' => 'prism-processing', 'require' => 'clike', 'in_popup' => 1],
            87 => ['id' => 'prolog', 'name' => 'Prolog', 'file' => 'prism-prolog', 'require' => '', 'in_popup' => 1],
            88 => ['id' => 'properties', 'name' => '.properties', 'file' => 'prism-properties', 'require' => '', 'in_popup' => 1],
            89 => ['id' => 'protobuf', 'name' => 'Protocol Buffers', 'file' => 'prism-protobuf', 'require' => 'clike', 'in_popup' => 1],
            90 => ['id' => 'puppet', 'name' => 'Puppet', 'file' => 'prism-puppet', 'require' => '', 'in_popup' => 1],
            91 => ['id' => 'pure', 'name' => 'Pure', 'file' => 'prism-pure', 'require' => '', 'in_popup' => 1],
            92 => ['id' => 'python', 'name' => 'Python', 'file' => 'prism-python', 'require' => '', 'in_popup' => 1],
            93 => ['id' => 'q', 'name' => 'Q', 'file' => 'prism-q', 'require' => '', 'in_popup' => 1],
            94 => ['id' => 'qore', 'name' => 'Qore', 'file' => 'prism-qore', 'require' => 'clike', 'in_popup' => 1],
            95 => ['id' => 'r', 'name' => 'R', 'file' => 'prism-r', 'require' => '', 'in_popup' => 1],
            96 => ['id' => 'jsx', 'name' => 'React JSX', 'file' => 'prism-jsx', 'require' => 'markup', 'in_popup' => 1],
            97 => ['id' => 'reason', 'name' => 'Reason', 'file' => 'prism-reason', 'require' => 'clike', 'in_popup' => 1],
            98 => ['id' => 'rest', 'name' => 'reST (reStructuredText)', 'file' => 'prism-rest', 'require' => '', 'in_popup' => 1],
            99 => ['id' => 'rip', 'name' => 'Rip', 'file' => 'prism-rip', 'require' => '', 'in_popup' => 1],
            100 => ['id' => 'roboconf', 'name' => 'Roboconf', 'file' => 'prism-roboconf', 'require' => '', 'in_popup' => 1],
            101 => ['id' => 'rust', 'name' => 'Rust', 'file' => 'prism-rust', 'require' => '', 'in_popup' => 1],
            102 => ['id' => 'sas', 'name' => 'SAS', 'file' => 'prism-sas', 'require' => '', 'in_popup' => 1],
            103 => ['id' => 'sass', 'name' => 'Sass (Sass)', 'file' => 'prism-sass', 'require' => 'css', 'in_popup' => 1],
            104 => ['id' => 'scss', 'name' => 'Sass (Scss)', 'file' => 'prism-scss', 'require' => 'css', 'in_popup' => 1],
            105 => ['id' => 'scala', 'name' => 'Scala', 'file' => 'prism-scala', 'require' => 'clike', 'in_popup' => 1],
            106 => ['id' => 'scheme', 'name' => 'Scheme', 'file' => 'prism-scheme', 'require' => '', 'in_popup' => 1],
            107 => ['id' => 'smalltalk', 'name' => 'Smalltalk', 'file' => 'prism-smalltalk', 'require' => '', 'in_popup' => 1],
            108 => ['id' => 'smarty', 'name' => 'Smarty', 'file' => 'prism-smarty', 'require' => 'markup', 'in_popup' => 1],
            109 => ['id' => 'stylus', 'name' => 'Stylus', 'file' => 'prism-stylus', 'require' => '', 'in_popup' => 1],
            110 => ['id' => 'swift', 'name' => 'Swift', 'file' => 'prism-swift', 'require' => 'clike', 'in_popup' => 1],
            111 => ['id' => 'tcl', 'name' => 'Tcl', 'file' => 'prism-tcl', 'require' => '', 'in_popup' => 1],
            112 => ['id' => 'textile', 'name' => 'Textile', 'file' => 'prism-textile', 'require' => 'markup', 'in_popup' => 1],
            113 => ['id' => 'twig', 'name' => 'Twig', 'file' => 'prism-twig', 'require' => 'markup', 'in_popup' => 1],
            114 => ['id' => 'typescript', 'name' => 'TypeScript', 'file' => 'prism-typescript', 'require' => 'javascript', 'in_popup' => 1],
            115 => ['id' => 'verilog', 'name' => 'Verilog', 'file' => 'prism-verilog', 'require' => '', 'in_popup' => 1],
            116 => ['id' => 'vhdl', 'name' => 'VHDL', 'file' => 'prism-vhdl', 'require' => '', 'in_popup' => 1],
            117 => ['id' => 'vim', 'name' => 'vim', 'file' => 'prism-vim', 'require' => '', 'in_popup' => 1],
            118 => ['id' => 'wiki', 'name' => 'Wiki markup', 'file' => 'prism-wiki', 'require' => 'markup', 'in_popup' => 1],
            119 => ['id' => 'xojo', 'name' => 'Xojo (REALbasic)', 'file' => 'prism-xojo', 'require' => '', 'in_popup' => 1],
            120 => ['id' => 'yaml', 'name' => 'YAML', 'file' => 'prism-yaml', 'require' => '', 'in_popup' => 1],

        ];
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