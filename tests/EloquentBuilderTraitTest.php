<?php

use Mockery as m;
use Optimus\Api\Controller\EloquentBuilderTrait;

class EloquentBuilderTraitTest extends Orchestra\Testbench\TestCase {

    use EloquentBuilderTrait;

    public function testParametersAreAppliedCorrectly() {
        $mock = m::mock('Illuminate\Database\Eloquent\Builder');
        $mock->shouldReceive('with')->once()->with(m::mustBe([
            'children1', 'children2'
        ]));
        $mock->shouldReceive('orderBy')->once()->with('property');
        $mock->shouldReceive('limit')->once()->with(20);
        $mock->shouldReceive('offset')->once()->with(40);

        $this->applyResourceOptions($mock, [
            'includes' => ['children1', 'children2'],
            'sort' => 'property',
            'limit' => 20,
            'page' => 2
        ]);
    }

    public function testNoParamersAreApplied() {
        $mock = m::mock('Illuminate\Database\Eloquent\Builder');

        $this->applyResourceOptions($mock);
    }

}
