<?php

namespace Galoa\ExerciciosPhp\Tests\TextWrap;

use Galoa\ExerciciosPhp\TextWrap\Resolucao;
use PHPUnit\Framework\TestCase;

/**
 * Tests for Galoa\ExerciciosPhp\TextWrap\Resolucao.
 *
 * @codeCoverageIgnore
 */
class TextWrapTest extends TestCase {

  /**
   * Test Setup.
   */
  public function setUp() {
    $this->resolucao = new Resolucao();
    $this->baseString = "Se vi mais longe foi por estar de pé sobre ombros de gigantes";
  }

  /**
   * Checa o retorno para strings vazias.
   *
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::textWrap
   */
  public function testForEmptyStrings() {
    $ret = $this->resolucao->textWrap("", 2018);
    $this->assertCount(1, $ret);
    $this->assertEmpty($ret[0]);
  }

  /**
   * Checa o retorno para strings que apenas um elemento no vetor é suficuente.
   *
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::textWrap
   */
  public function testForOneWord() {
    $ret = $this->resolucao->textWrap("Oi", 5);
    $this->assertCount(1, $ret);
    $this->assertEquals("Oi", $ret[0]);
  }

  /**
   * Testa a quebra de linha para palavras curtas.
   *
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::textWrap
   */
  public function testForSmallWords() {
    $ret = $this->resolucao->textWrap($this->baseString, 8);
    $this->assertCount(10, $ret);
    $this->assertEquals("Se vi", $ret[0]);
    $this->assertEquals("mais", $ret[1]);
    $this->assertEquals("longe", $ret[2]);
    $this->assertEquals("foi por", $ret[3]);
    $this->assertEquals("estar de", $ret[4]);
    $this->assertEquals("pé", $ret[5]);
    $this->assertEquals("sobre", $ret[6]);
    $this->assertEquals("ombros", $ret[7]);
    $this->assertEquals("de", $ret[8]);
    $this->assertEquals("gigantes", $ret[9]);
  }

  /**
   * Testa a quebra de linha para palavras curtas.
   *
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::textWrap
   */
  public function testForSmallWords2() {
    $ret = $this->resolucao->textWrap($this->baseString, 12);
    $this->assertCount(6, $ret);
    $this->assertEquals("Se vi mais", $ret[0]);
    $this->assertEquals("longe foi", $ret[1]);
    $this->assertEquals("por estar de", $ret[2]);
    $this->assertEquals("pé sobre", $ret[3]);
    $this->assertEquals("ombros de", $ret[4]);
    $this->assertEquals("gigantes", $ret[5]);
  }

  /**
   * Testa a quebra de linha para palavras muito pequenas.
   *
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::textWrap
   */
  public function testForSmallWords3() {
    $ret = $this->resolucao->textWrap($this->baseString, 4);
    $this->assertCount(17, $ret);
    $this->assertEquals("Se", $ret[0]);
    $this->assertEquals("vi", $ret[1]);
    $this->assertEquals("mais", $ret[2]);
    $this->assertEquals("long", $ret[3]);
    $this->assertEquals("e", $ret[4]);
    $this->assertEquals("foi", $ret[5]);
    $this->assertEquals("por", $ret[6]);
    $this->assertEquals("esta", $ret[7]);
    $this->assertEquals("r de", $ret[8]);
    $this->assertEquals("pé", $ret[9]);
    $this->assertEquals("sobr", $ret[10]);
    $this->assertEquals("e", $ret[11]);
    $this->assertEquals("ombr", $ret[12]);
    $this->assertEquals("os", $ret[13]);
    $this->assertEquals("de", $ret[14]);
    $this->assertEquals("giga", $ret[15]);
    $this->assertEquals("ntes", $ret[16]);
  }
  /**
   * Testa a quebra de linha para uma palavra grande.
   *
   * @covers Galoa\ExerciciosPhp\TextWrap\Resolucao::textWrap
   */
  public function testOneBigWord() {
    $ret = $this->resolucao->textWrap("Ouro.Soja.Galo.Olho.", 5);
    $this->assertCount(4, $ret);
    $this->assertEquals("Ouro.", $ret[0]);
    $this->assertEquals("Soja.", $ret[1]);
    $this->assertEquals("Galo.", $ret[2]);
    $this->assertEquals("Olho.", $ret[3]);
  }

}
