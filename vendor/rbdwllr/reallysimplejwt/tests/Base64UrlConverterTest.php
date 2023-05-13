<?php
 
use ReallySimpleJWT\Helper\Base64UrlConverter;

class Base64UrlConverterTest extends PHPUnit_Framework_TestCase 
{
	public function testBase64UrlConverter()
	{
		$base64Url = new Base64UrlConverter();

		$base64UrlString = $base64Url->setBase64String('fh778+djfu/90pds==')
							->toBase64Url()
							->getBase64UrlString();

		$this->assertEquals('fh778-djfu_90pds', $base64UrlString); 
	}

	public function testBase64Converter()
	{
		$base64 = new Base64UrlConverter();

		$base64String = $base64->setBase64UrlString('fh778-djfu_90pds')
							->toBase64()
							->getBase64String();

		$this->assertEquals('fh778+djfu/90pds', $base64String);
	}

	public function testBase64Padding()
	{
		$base64Url = new Base64UrlConverter();

		$base64String = base64_encode('Hell');

		$base64UrlString = $base64Url->setBase64String($base64String)
							->toBase64Url()
							->getBase64UrlString();

		$newBase64String = $base64Url->setBase64UrlString($base64UrlString)
							->toBase64()
							->getBase64String();

		$this->assertEquals($base64String, $newBase64String); 
	}

	public function testBase64PaddingTwo()
	{
		$base64Url = new Base64UrlConverter();

		$base64String = base64_encode('Hello');

		$base64UrlString = $base64Url->setBase64String($base64String)
							->toBase64Url()
							->getBase64UrlString();

		$newBase64String = $base64Url->setBase64UrlString($base64UrlString)
							->toBase64()
							->getBase64String();

		$this->assertEquals($base64String, $newBase64String); 
	}

	public function testBase64PaddingThree()
	{
		$base64Url = new Base64UrlConverter();

		$base64String = base64_encode('Hellos');

		$base64UrlString = $base64Url->setBase64String($base64String)
							->toBase64Url()
							->getBase64UrlString();

		$newBase64String = $base64Url->setBase64UrlString($base64UrlString)
							->toBase64()
							->getBase64String();

		$this->assertEquals($base64String, $newBase64String); 
	}
}