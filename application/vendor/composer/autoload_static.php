<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit7d514297400665d67b4c6e316f95a2c3
{
    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'FontLib\\' => 8,
        ),
        'D' => 
        array (
            'Dompdf\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'FontLib\\' => 
        array (
            0 => __DIR__ . '/..' . '/phenx/php-font-lib/src/FontLib',
        ),
        'Dompdf\\' => 
        array (
            0 => __DIR__ . '/..' . '/dompdf/dompdf/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'S' => 
        array (
            'Svg\\' => 
            array (
                0 => __DIR__ . '/..' . '/phenx/php-svg-lib/src',
            ),
            'Sabberworm\\CSS' => 
            array (
                0 => __DIR__ . '/..' . '/sabberworm/php-css-parser/lib',
            ),
        ),
    );

    public static $classMap = array (
        'Cpdf' => __DIR__ . '/..' . '/dompdf/dompdf/lib/Cpdf.php',
        'HTML5_Data' => __DIR__ . '/..' . '/dompdf/dompdf/lib/html5lib/Data.php',
        'HTML5_InputStream' => __DIR__ . '/..' . '/dompdf/dompdf/lib/html5lib/InputStream.php',
        'HTML5_Parser' => __DIR__ . '/..' . '/dompdf/dompdf/lib/html5lib/Parser.php',
        'HTML5_Tokenizer' => __DIR__ . '/..' . '/dompdf/dompdf/lib/html5lib/Tokenizer.php',
        'HTML5_TreeBuilder' => __DIR__ . '/..' . '/dompdf/dompdf/lib/html5lib/TreeBuilder.php',
        'RecursiveCallbackFilterIterator' => __DIR__ . '/..' . '/studio-42/elfinder/php/elFinderVolumeLocalFileSystem.class.php',
        'elFinder' => __DIR__ . '/..' . '/studio-42/elfinder/php/elFinder.class.php',
        'elFinderAbortException' => __DIR__ . '/..' . '/studio-42/elfinder/php/elFinder.class.php',
        'elFinderConnector' => __DIR__ . '/..' . '/studio-42/elfinder/php/elFinderConnector.class.php',
        'elFinderEditor' => __DIR__ . '/..' . '/studio-42/elfinder/php/editors/editor.php',
        'elFinderEditorZipArchive' => __DIR__ . '/..' . '/studio-42/elfinder/php/editors/ZipArchive/editor.php',
        'elFinderEditorZohoOffice' => __DIR__ . '/..' . '/studio-42/elfinder/php/editors/ZohoOffice/editor.php',
        'elFinderLibGdBmp' => __DIR__ . '/..' . '/studio-42/elfinder/php/libs/GdBmp.php',
        'elFinderPlugin' => __DIR__ . '/..' . '/studio-42/elfinder/php/elFinderPlugin.php',
        'elFinderPluginAutoResize' => __DIR__ . '/..' . '/studio-42/elfinder/php/plugins/AutoResize/plugin.php',
        'elFinderPluginAutoRotate' => __DIR__ . '/..' . '/studio-42/elfinder/php/plugins/AutoRotate/plugin.php',
        'elFinderPluginNormalizer' => __DIR__ . '/..' . '/studio-42/elfinder/php/plugins/Normalizer/plugin.php',
        'elFinderPluginSanitizer' => __DIR__ . '/..' . '/studio-42/elfinder/php/plugins/Sanitizer/plugin.php',
        'elFinderPluginWatermark' => __DIR__ . '/..' . '/studio-42/elfinder/php/plugins/Watermark/plugin.php',
        'elFinderSession' => __DIR__ . '/..' . '/studio-42/elfinder/php/elFinderSession.php',
        'elFinderSessionInterface' => __DIR__ . '/..' . '/studio-42/elfinder/php/elFinderSessionInterface.php',
        'elFinderVolumeBox' => __DIR__ . '/..' . '/studio-42/elfinder/php/elFinderVolumeBox.class.php',
        'elFinderVolumeDriver' => __DIR__ . '/..' . '/studio-42/elfinder/php/elFinderVolumeDriver.class.php',
        'elFinderVolumeDropbox' => __DIR__ . '/..' . '/studio-42/elfinder/php/elFinderVolumeDropbox.class.php',
        'elFinderVolumeDropbox2' => __DIR__ . '/..' . '/studio-42/elfinder/php/elFinderVolumeDropbox2.class.php',
        'elFinderVolumeFTP' => __DIR__ . '/..' . '/studio-42/elfinder/php/elFinderVolumeFTP.class.php',
        'elFinderVolumeFlysystemGoogleDriveCache' => __DIR__ . '/..' . '/studio-42/elfinder/php/elFinderFlysystemGoogleDriveNetmount.php',
        'elFinderVolumeFlysystemGoogleDriveNetmount' => __DIR__ . '/..' . '/studio-42/elfinder/php/elFinderFlysystemGoogleDriveNetmount.php',
        'elFinderVolumeGoogleDrive' => __DIR__ . '/..' . '/studio-42/elfinder/php/elFinderVolumeGoogleDrive.class.php',
        'elFinderVolumeGroup' => __DIR__ . '/..' . '/studio-42/elfinder/php/elFinderVolumeGroup.class.php',
        'elFinderVolumeLocalFileSystem' => __DIR__ . '/..' . '/studio-42/elfinder/php/elFinderVolumeLocalFileSystem.class.php',
        'elFinderVolumeMySQL' => __DIR__ . '/..' . '/studio-42/elfinder/php/elFinderVolumeMySQL.class.php',
        'elFinderVolumeOneDrive' => __DIR__ . '/..' . '/studio-42/elfinder/php/elFinderVolumeOneDrive.class.php',
        'elFinderVolumeTrash' => __DIR__ . '/..' . '/studio-42/elfinder/php/elFinderVolumeTrash.class.php',
        'elFinderVolumeTrashMySQL' => __DIR__ . '/..' . '/studio-42/elfinder/php/elFinderVolumeTrashMySQL.class.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit7d514297400665d67b4c6e316f95a2c3::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit7d514297400665d67b4c6e316f95a2c3::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit7d514297400665d67b4c6e316f95a2c3::$prefixesPsr0;
            $loader->classMap = ComposerStaticInit7d514297400665d67b4c6e316f95a2c3::$classMap;

        }, null, ClassLoader::class);
    }
}
