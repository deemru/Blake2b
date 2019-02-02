<?php

require __DIR__ . '/../vendor/autoload.php';
use deemru\Blake2b;

$blake2b = new Blake2b();
$hash = $blake2b->hash( 'Hello, world!' );
if( $hash !== hex2bin( 'b5da441cfe72ae042ef4d2b17742907f675de4da57462d4c3609c2e2ed755970' ) )
    exit( 1 );

class tester
{
    private $successful = 0;
    private $failed = 0;
    private $depth = 0;
    private $info = [];
    private $start = [];

    public function pretest( $info )
    {
        $this->info[$this->depth] = $info;
        $this->start[$this->depth] = microtime( true );
        if( !isset( $this->init ) )
            $this->init = $this->start[$this->depth];
        $this->depth++;
    }

    private function ms( $start )
    {
        $ms = ( microtime( true ) - $start ) * 1000;
        $ms = $ms > 100 ? round( $ms ) : $ms;
        $ms = sprintf( $ms > 10 ? ( $ms > 100 ? '%.00f' : '%.01f' ) : '%.02f', $ms );
        return $ms;
    }

    public function test( $cond )
    {
        $this->depth--;
        $ms = $this->ms( $this->start[$this->depth] );
        echo ( $cond ? 'SUCCESS: ' : 'ERROR:   ' ) . "{$this->info[$this->depth]} ($ms ms)\n";
        $cond ? $this->successful++ : $this->failed++;
    }

    public function finish()
    {
        $total = $this->successful + $this->failed;
        $ms = $this->ms( $this->init );
        echo "  TOTAL: {$this->successful}/$total ($ms ms)\n";
        sleep( 3 );

        if( $this->failed > 0 )
            exit( 1 );
    }
}

echo "   TEST: Blake2b\n";
$t = new tester();

$hashes = json_decode( file_get_contents( __DIR__ . '/hashes.json' ), true );
$n = 0;

foreach( $hashes as $test )
foreach( $test as $data => $hash )
{
    $n++;
    $t->pretest( "test #$n" );
    $t->test( $blake2b->hash( hex2bin( $data ) ) === hex2bin( $hash ) );
}

$t->finish();
