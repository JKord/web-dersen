<?php
namespace Catalog\FilmsBundle\Tests\Helper;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class HelperMethodTest extends \PHPUnit_Framework_TestCase
{
    protected
        $file,
        $image;

    public function setUp()
    {
        $this->file = tempnam(sys_get_temp_dir(), 'upl'); // create file
        imagepng(imagecreatetruecolor(10, 10), $this->file); // create and write image/png to it
        $this->image = new UploadedFile($this->file, 'new_image.png');
    }

    public function tearDown()
    {
        unlink($this->file);
    }

    public function ukr_rusToTranslitData()
    {
        return array(
            array('віа ііва ів аіфва', 'via_iiva_iv_aifva'),
            array('rtre trtger', 'rtre_trtger'),
            array('4534535 рпарап вап35 вап', '4534535_rparap_vap35_vap'),
            array('   --- / 65  44вв 323 ук', '___---_/_65__44vv_323_yk'),
        );
    }

    public function testValidFile()
     {
         $hmMock = $this->getMockBuilder('Catalog\FilmsBundle\Helper\HelperMethod')
             ->disableOriginalConstructor()
             ->setMethods(null)
             ->getMock();

         $res = $hmMock->validFile($this->image);
         $this->assertEquals('image', $res[1]);
     }

    /**
     * @dataProvider ukr_rusToTranslitData
     */
    public function testUkr_rusToTranslit($data, $result)
    {
        $hmMock = $this->getMockBuilder('Catalog\FilmsBundle\Helper\HelperMethod')
            ->disableOriginalConstructor()
            ->setMethods(null)
            ->getMock();

        $this->assertEquals($result, $hmMock->ukr_rusToTranslit($data));
    }
}