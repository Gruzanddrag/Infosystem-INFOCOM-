<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $umk app\models\Umk */
?>
<div class="pdf-content">
    <h1 class="umk-title">Отчет книгообеспеченности учебно методических комплексов</h1>
    <ul class="umk-ul">
        <?php 
            foreach($umks as $umk){ 
            echo '<li class="umk-li">';
            echo '<div class="umk-block">';
            echo Html::tag('h2', Html::encode("{$umk->umkName} ({$umk->umkStatus->umkStatusText})"), [
                'class' => 'umk-block--title',
            ]);
            echo '<div class="umk-block--student-requrement">';
                echo Html::tag('h3', 'Секции УМК');
                echo '<ol class="umk-ol">';
                    foreach($umk->sections as $section){
                            echo '<li>';
                            echo Html::tag('h3', Html::encode($section->sectionName));
                            if(count($section->nonInetSectionResources) > 0) {
                                echo Html::ul($section->sectionResources, ['item' => function($item, $index) {
                                    $resource = $item->resource;
                                    $str = $resource->resourceName;
                                    $state = $item->getResourceState();
                                    if($state == 'booked') {
                                        $stateText = 'Зарезервированно';
                                    } else if ($state == 'stable') {
                                        $stateText = 'Есть на складе';
                                    } else {
                                        $stateText = 'Не хватает на складе';
                                    }
                                    if($item->resource->resourceTypeId != 3) {
                                    $str = Html::encode("{$str}, количество: ") . Html::tag('b',"{$item->count} - {$stateText}", [
                                        'class' => "umk-resource-{$state}"
                                    ]);
                                    }
                                    if($resource->resourceTypeId != 3){
                                        return Html::tag(
                                            'li',
                                        $str
                                        );
                                    }
                                }]);
                            } else {
                                echo Html::ul([1], ['item' => function($item, $index) {
                                    return Html::encode('Нет подходящей литературы');
                                }]);
                            }
                            echo '</li>';
                    } 
                echo '</ol>';
                echo Html::tag('h3', Html::encode('Литература для всего УМК'));
                if(count($umk->nonInetUmkResources) > 0) {
                    echo Html::ul($umk->nonInetUmkResources, ['item' => function($item, $index) {
                        $resource = $item->resource;
                        $str = $resource->resourceName;
                        $state = $item->getResourceState();
                        if($state == 'booked') {
                            $stateText = 'Зарезервированно';
                        } else if ($state == 'stable') {
                            $stateText = 'Есть на складе';
                        } else {
                            $stateText = 'Не хватает на складе';
                        }
                        if($item->resource->resourceTypeId != 3) {
                        $str = Html::encode("{$str}, количество: ") . Html::tag('b',"{$item->count} - {$stateText}", [
                            'class' => "umk-resource-{$state}"
                        ]);
                        }
                        return Html::tag(
                            'li',
                        $str
                        );
                    }]);
                } else {
                    echo Html::ul([1], ['item' => function($item, $index) {
                        return Html::encode('Нет подходящей литературы');
                    }]);
                }
            echo '</div>';
            echo '</div>';
            echo '</li>';
        }?>
    </ul>
</div>
