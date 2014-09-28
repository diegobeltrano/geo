<?php

namespace Brick\Geo\Tests\IO;

use Brick\Geo\Tests\AbstractTestCase;

/**
 * Base class for WKT reader/writer tests.
 */
abstract class WKTAbstractTest extends AbstractTestCase
{
    /**
     * @return array
     */
    public function providerWKT()
    {
        return array_merge(
            $this->providerPointWKT(),
            $this->providerLineStringWKT(),
            $this->providerPolygonWKT(),
            $this->providerMultiPointWKT(),
            $this->providerMultiLineStringWKT(),
            $this->providerMultiPolygonWKT(),
            $this->providerGeometryCollectionWKT()
        );
    }

    /**
     * @return array
     */
    public function providerPointWKT()
    {
        return [
            ['POINT(1 2)', [1, 2], false, false],
            ['POINT Z(2 3 4)', [2, 3, 4], true, false],
            ['POINT M(3 4 5)', [3, 4, 5], false, true],
            ['POINT ZM(4 5 6 7)', [4, 5, 6, 7], true, true],
        ];
    }

    /**
     * @return array
     */
    public function providerLineStringWKT()
    {
        return [
            ['LINESTRING(0 0,1 2,3 4)', [[0, 0], [1, 2], [3, 4]], false, false],
            ['LINESTRING Z(0 1 2,1 2 3,2 3 4)', [[0, 1, 2], [1, 2, 3], [2, 3, 4]], true, false],
            ['LINESTRING M(1 2 3,2 3 4,3 4 5)', [[1, 2, 3], [2, 3, 4], [3, 4, 5]], false, true],
            ['LINESTRING ZM(2 3 4 5,3 4 5 6,4 5 6 7)', [[2, 3, 4, 5], [3, 4, 5, 6], [4, 5, 6, 7]], true, true],
        ];
    }

    /**
     * @return array
     */
    public function providerPolygonWKT()
    {
        return [
            ['POLYGON((0 0,1 2,3 4,0 0))', [[[0, 0], [1, 2], [3, 4], [0, 0]]], false, false],
            ['POLYGON Z((0 1 2,1 2 3,2 3 4,0 1 2))', [[[0, 1, 2], [1, 2, 3], [2, 3, 4], [0, 1, 2]]], true, false],
            ['POLYGON M((1 2 3,2 3 4,3 4 5,1 2 3))', [[[1, 2, 3], [2, 3, 4], [3, 4, 5], [1, 2, 3]]], false, true],
            ['POLYGON ZM((2 3 4 5,3 4 5 6,4 5 6 7,2 3 4 5))', [[[2, 3, 4, 5], [3, 4, 5, 6], [4, 5, 6, 7], [2, 3, 4, 5]]], true, true],

            ['POLYGON((0 0,2 0,0 2,0 0),(0 0,1 0,0 1,0 0))', [[[0, 0], [2, 0], [0, 2], [0, 0]], [[0, 0], [1, 0], [0, 1], [0, 0]]], false, false],
            ['POLYGON Z((0 0 1,2 0 1,0 2 1,0 0 1),(0 0 2,1 0 2,0 1 2,0 0 2))', [[[0, 0, 1], [2, 0, 1], [0, 2, 1], [0, 0, 1]], [[0, 0, 2], [1, 0, 2], [0, 1, 2], [0, 0, 2]]], true, false],
            ['POLYGON M((0 0 1,2 0 1,0 2 1,0 0 1),(0 0 2,1 0 2,0 1 2,0 0 2))', [[[0, 0, 1], [2, 0, 1], [0, 2, 1], [0, 0, 1]], [[0, 0, 2], [1, 0, 2], [0, 1, 2], [0, 0, 2]]], false, true],
            ['POLYGON ZM((0 0 1 2,2 0 1 2,0 2 1 2,0 0 1 2),(0 0 1 2,1 0 1 2,0 1 1 2,0 0 1 2))', [[[0, 0, 1, 2], [2, 0, 1, 2], [0, 2, 1, 2], [0, 0, 1, 2]], [[0, 0, 1, 2], [1, 0, 1, 2], [0, 1, 1, 2], [0, 0, 1, 2]]], true, true],
        ];
    }

    /**
     * @return array
     */
    public function providerMultiPointWKT()
    {
        return [
            ['MULTIPOINT(0 0,1 2,3 4)', [[0, 0], [1, 2], [3, 4]], false, false],
            ['MULTIPOINT Z(0 1 2,1 2 3,2 3 4)', [[0, 1, 2], [1, 2, 3], [2, 3, 4]], true, false],
            ['MULTIPOINT M(1 2 3,2 3 4,3 4 5)', [[1, 2, 3], [2, 3, 4], [3, 4, 5]], false, true],
            ['MULTIPOINT ZM(2 3 4 5,3 4 5 6,4 5 6 7)', [[2, 3, 4, 5], [3, 4, 5, 6], [4, 5, 6, 7]], true, true],
        ];
    }

    /**
     * @return array
     */
    public function providerMultiLineStringWKT()
    {
        return [
            ['MULTILINESTRING((0 0,1 2,3 4,0 0))', [[[0, 0], [1, 2], [3, 4], [0, 0]]], false, false],
            ['MULTILINESTRING Z((0 1 2,1 2 3,2 3 4,0 1 2))', [[[0, 1, 2], [1, 2, 3], [2, 3, 4], [0, 1, 2]]], true, false],
            ['MULTILINESTRING M((1 2 3,2 3 4,3 4 5,1 2 3))', [[[1, 2, 3], [2, 3, 4], [3, 4, 5], [1, 2, 3]]], false, true],
            ['MULTILINESTRING ZM((2 3 4 5,3 4 5 6,4 5 6 7,2 3 4 5))', [[[2, 3, 4, 5], [3, 4, 5, 6], [4, 5, 6, 7], [2, 3, 4, 5]]], true, true],

            ['MULTILINESTRING((0 0,2 0,0 2,0 0),(0 0,1 0,0 1,0 0))', [[[0, 0], [2, 0], [0, 2], [0, 0]], [[0, 0], [1, 0], [0, 1], [0, 0]]], false, false],
            ['MULTILINESTRING Z((0 0 1,2 0 1,0 2 1,0 0 1),(0 0 2,1 0 2,0 1 2,0 0 2))', [[[0, 0, 1], [2, 0, 1], [0, 2, 1], [0, 0, 1]], [[0, 0, 2], [1, 0, 2], [0, 1, 2], [0, 0, 2]]], true, false],
            ['MULTILINESTRING M((0 0 1,2 0 1,0 2 1,0 0 1),(0 0 2,1 0 2,0 1 2,0 0 2))', [[[0, 0, 1], [2, 0, 1], [0, 2, 1], [0, 0, 1]], [[0, 0, 2], [1, 0, 2], [0, 1, 2], [0, 0, 2]]], false, true],
            ['MULTILINESTRING ZM((0 0 1 2,2 0 1 2,0 2 1 2,0 0 1 2),(0 0 1 2,1 0 1 2,0 1 1 2,0 0 1 2))', [[[0, 0, 1, 2], [2, 0, 1, 2], [0, 2, 1, 2], [0, 0, 1, 2]], [[0, 0, 1, 2], [1, 0, 1, 2], [0, 1, 1, 2], [0, 0, 1, 2]]], true, true],
        ];
    }

    /**
     * @return array
     */
    public function providerMultiPolygonWKT()
    {
        return [
            ['MULTIPOLYGON(((0 0,1 2,3 4,0 0)))', [[[[0, 0], [1, 2], [3, 4], [0, 0]]]], false, false],
            ['MULTIPOLYGON Z(((0 1 2,1 2 3,2 3 4,0 1 2)))', [[[[0, 1, 2], [1, 2, 3], [2, 3, 4], [0, 1, 2]]]], true, false],
            ['MULTIPOLYGON M(((1 2 3,2 3 4,3 4 5,1 2 3)))', [[[[1, 2, 3], [2, 3, 4], [3, 4, 5], [1, 2, 3]]]], false, true],
            ['MULTIPOLYGON ZM(((2 3 4 5,3 4 5 6,4 5 6 7,2 3 4 5)))', [[[[2, 3, 4, 5], [3, 4, 5, 6], [4, 5, 6, 7], [2, 3, 4, 5]]]], true, true],

            ['MULTIPOLYGON(((0 0,2 0,0 2,0 0)),((0 0,1 0,0 1,0 0)))', [[[[0, 0], [2, 0], [0, 2], [0, 0]]], [[[0, 0], [1, 0], [0, 1], [0, 0]]]], false, false],
            ['MULTIPOLYGON Z(((0 0 1,2 0 1,0 2 1,0 0 1)),((0 0 2,1 0 2,0 1 2,0 0 2)))', [[[[0, 0, 1], [2, 0, 1], [0, 2, 1], [0, 0, 1]]], [[[0, 0, 2], [1, 0, 2], [0, 1, 2], [0, 0, 2]]]], true, false],
            ['MULTIPOLYGON M(((0 0 1,2 0 1,0 2 1,0 0 1)),((0 0 2,1 0 2,0 1 2,0 0 2)))', [[[[0, 0, 1], [2, 0, 1], [0, 2, 1], [0, 0, 1]]], [[[0, 0, 2], [1, 0, 2], [0, 1, 2], [0, 0, 2]]]], false, true],
            ['MULTIPOLYGON ZM(((0 0 1 2,2 0 1 2,0 2 1 2,0 0 1 2)),((0 0 1 2,1 0 1 2,0 1 1 2,0 0 1 2)))', [[[[0, 0, 1, 2], [2, 0, 1, 2], [0, 2, 1, 2], [0, 0, 1, 2]]], [[[0, 0, 1, 2], [1, 0, 1, 2], [0, 1, 1, 2], [0, 0, 1, 2]]]], true, true],
        ];
    }

    /**
     * @return array
     */
    public function providerGeometryCollectionWKT()
    {
        return [
            ['GEOMETRYCOLLECTION(POINT(1 2),LINESTRING(2 3,3 4))', [[1, 2], [[2, 3], [3, 4]]], false, false],
            ['GEOMETRYCOLLECTION Z(POINT Z(1 2 3),LINESTRING Z(2 3 4,3 4 5))', [[1, 2, 3], [[2, 3, 4], [3, 4, 5]]], true, false],
            ['GEOMETRYCOLLECTION M(POINT M(1 2 4),LINESTRING M(2 3 5,3 4 6))', [[1, 2, 4], [[2, 3, 5], [3, 4, 6]]], false, true],
            ['GEOMETRYCOLLECTION ZM(POINT ZM(1 2 3 4),LINESTRING ZM(2 3 4 5,3 4 5 6))', [[1, 2, 3, 4], [[2, 3, 4, 5], [3, 4, 5, 6]]], true, true]
        ];
    }
}