<?php

namespace App\Models;

class NewGraph
{
    private array $adjacencyMatrix;
    private array $nodeNames;
    private array $colorsVector;
    private array $coloredVertices;
    private int $matrixSize;

    public function __construct($sizeMatrix, $nodeNames)
    {
        // init adjacency table
        $this->matrixSize = $sizeMatrix;
        $this->nodeNames  = $nodeNames;
        for ($i = 0; $i < $this->matrixSize; $i++) {
            for ($y = 0; $y < $this->matrixSize; $y++) {
                $this->adjacencyMatrix[$i][$y] = 0;
            }
        }
        // init colors vector = result of coloring
        $this->colorsVector[0] = 0;
        for ($i = 1; $i < $this->matrixSize; $i++) {
            $this->colorsVector[$i] = 0;
        }
        // init colored vertices
        for ($i = 0; $i < $this->matrixSize; $i++) {
            $this->coloredVertices[$i] = false;
        }
    }

    public function __destruct()
    {
        reset($this->adjacencyMatrix);
        reset($this->nodeNames);
        reset($this->coloredVertices);
        reset($this->colorsVector);
        $this->matrixSize = 0;
    }

    public function getNodeName($index)
    {
        return $this->nodeNames[$index];
    }

    public function getNodeIndex($nodeName)
    {
        $result = array_search($nodeName, $this->nodeNames);

        if ($result === false) {
            throw new \RuntimeException("Node name not found");
        }

        return $result;
    }

    public function setEdge($nodeName1, $columnName2): bool
    {
        $row    = $this->getNodeIndex($nodeName1);
        $column = $this->getNodeIndex($columnName2);

        if ($row > $this->matrixSize || $column > $this->matrixSize) {
            return false;
        }
        $this->adjacencyMatrix[$row][$column] = $this->adjacencyMatrix[$column][$row] = 1;
        return true;
    }


    public function listElements()
    {
        echo "__ |";
        for ($y = 0; $y < $this->matrixSize; $y++) {
            echo $this->getNodeName($y) . " | ";
        }
        echo "<br>\n";
        for ($i = 0; $i < $this->matrixSize; $i++) {
            echo $this->getNodeName($i) . " | ";
            for ($y = 0; $y < $this->matrixSize; $y++) {
                echo $this->adjacencyMatrix[$i][$y] . " | ";
            }
            echo "<br>\n";
        }
    }

    public function getColors()
    {
        echo "<p>\n";
        for ($i = 0; $i < $this->matrixSize; $i++) {
            echo "Vertex " . $i . " --->  Color " . $this->colorsVector[$i] . "<br>\n";
        }
        echo "</p>\n";
    }

    public function getAdjacencyMatrix()
    {
        return $this->adjacencyMatrix;
    }

    public function getColorsVector()
    {
        return $this->colorsVector;
    }

    public function getColoredVector()
    {
        return $this->coloredVertices;
    }

    public function getLevel($index)
    {
        return count(array_filter($this->adjacencyMatrix[$index], function ($value) {
            return $value == 1;
        }));
    }

    public function coloringGraph()
    {
        $m                    = 0;
        $cloneAdjacencyMatrix = $this->adjacencyMatrix;

        while (true) {
            // Tim node bac cao nhat chua to mau
            $maxLevel     = -1;
            $maxNodeIndex = 0;
            for ($i = 0; $i < $this->matrixSize; $i++) {
                if ($this->coloredVertices[$i] == false) {
                    $level = $this->getLevel($i);
                    if ($level > $maxLevel) {
                        $maxLevel     = $level;
                        $maxNodeIndex = $i;
                    }
                }
            }
            // If not found, out while loop
            if ($maxLevel == -1) {
                break;
            }
            $this->colorsVector[$maxNodeIndex]    = ++$m;
            $this->coloredVertices[$maxNodeIndex] = true;

            // Tim cac dinh co cung level nhung khong lien ke voi maxNodeIndex
            $list = [$maxNodeIndex];
            for ($i = 0; $i < $this->matrixSize; $i++) {
                if ($this->coloredVertices[$i] == false && $this->adjacencyMatrix[$maxNodeIndex][$i] == 0) {
                    $this->colorsVector[$i]    = $m;
                    $this->coloredVertices[$i] = true;
                    $list[]                    = $i;
                }
            }

            // Xoa canh noi cac dinh trong list
            foreach ($list as $node) {
                for ($i = 0; $i < $this->matrixSize; $i++) {
                    $this->adjacencyMatrix[$node][$i] = 0;
                    $this->adjacencyMatrix[$i][$node] = 0;
                }
            }
        }

        $this->adjacencyMatrix = $cloneAdjacencyMatrix;
    }

    public function findByColor($m)
    {
        $ds_lhp = [];
        foreach ($this->colorsVector as $index => $color) {
            if ($color == $m) {
                $label    = $this->getNodeName($index);
                $ds_lhp[] = Lophocphan::where('id', $label)->withCount('sv')->first();
            }
        }

        return ($ds_lhp);
    }

    public function scheduleExamination()
    {
        $this->coloringGraph();
        $m            = 1;
        $ds_lhp       = $this->findByColor($m);
        $ds_lichthi   = [];

        $tuanbd = 1;
        $tuankt = 2;
        $t      = $tuanbd;
        while ($t < $tuankt) {
            $tn = 2;
            while ($tn < 7) {
                $i = 1;
                while ($i <= 5 || $i < 9) {
                    $k = 0;
                    if ($i == 5) {
                        $tgthi = 1;
                    } else {
                        $tgthi = 6 - $i % 5;
                    }
                    while ($k < count($ds_lhp) && $tgthi > 0) {
                        /** @var Lophocphan $lhpK */
                        $lhpK = $ds_lhp[$k];
                        if ($tgthi > $lhpK->tgthi) {
                            $all_phong_thi = Phong::with('lichthi.lophocphan')->where('type', 0)->get();
                            $ds_phong_thi  = $all_phong_thi->filter(function ($phong) use ($t, $tn, $i) {
                                foreach ($phong->lichthi as $lichthi) {
                                    if (
                                        $lichthi->ngayid == $tn &&
                                        $lichthi->tuan == $t &&
                                        ($lichthi->gioid == $i || $lichthi->gioid + $lichthi->lophocphan->tgthi > $i)
                                    ) {
                                        return false;
                                    }
                                }
                                return true;
                            });
                            $tong_suc_chua = $ds_phong_thi->sum('succhua');
                            if ($tong_suc_chua > $lhpK->sv_count) {
                                while ($lhpK->sv_count > 0) {
                                    $ph = null;

                                    // Duyệt qua tất cả các phòng thi,
                                    // tìm phòng có sức chứa lớn hơn số sinh viên còn lại
                                    foreach ($ds_phong_thi as $phong) {
                                        if ($ph == null) {
                                            if ($phong->succhua >= $lhpK->sv_count) {
                                                $ph = $phong;
                                            }
                                        } else {
                                            if ($phong->succhua >= $lhpK->sv_count && $phong->succhua < $ph->succhua) {
                                                $ph = $phong;
                                            }
                                        }
                                    }
                                    // Nếu không tìm được phòng nào có thể chứa hết tất cả sinh viên,
                                    // Lấy phòng lớn nhất, sau đó giảm sĩ số lại, tiếp tục tìm phòng thứ 2 (thi 2 phòng)
                                    if ($ph == null) {
                                        foreach ($ds_phong_thi as $phong) {
                                            if ($ph == null) {
                                                $ph = $phong;
                                            } else {
                                                if ($phong->succhua < $ph->succhua) {
                                                    $ph = $phong;
                                                }
                                            }
                                        }
                                        $lhpK->sv_count -= $ph->succhua;
                                    } else {
                                        $lhpK->sv_count = 0;
                                    }

                                    $ds_lichthi[] = Lichthi::create([
                                        'ngayid'      => $tn,
                                        'gioid'       => $i,
                                        'phongid'     => $ph->id,
                                        'lhpid'       => $lhpK->id,
                                        'thoigianthi' => $tgthi,
                                        'tuan'        => $t,
                                        'type'        => 0,
                                    ]);

                                    // Xoa phong khoi danh sach phong thi
                                    foreach ($ds_phong_thi as $index => $phong) {
                                        if ($phong->id == $ph->id) {
                                            $ds_phong_thi->forget($index);
                                        }
                                    }
                                }
                                // Xoa lhp khoi danh sach lhp
                                unset($ds_lhp[$k]);
                                $ds_lhp = array_values($ds_lhp);
                            } else {
                                $k++;
                            }
                        } else {
                            $k++;
                        }
                    }

                    if (empty($ds_lhp)) {
                        $m++;
                        $ds_lhp = $this->findByColor($m);
                        if (empty($ds_lhp)) {
                            return $ds_lichthi;
                        }
                    }
                    if ($i <= 5) {
                        $i = 6;
                    } elseif ($i < 9) {
                        $i++;
                    }
                }
                $tn++;
            }
            $t++;
        }
        return $ds_lichthi;
    }
}