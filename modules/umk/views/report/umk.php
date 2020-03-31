<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $umk app\models\Umk */
$this->title = 'Вход';
?>
<div class="pdf-content">
    <h2 class="umk-title"><?= Html::encode($umk->umkName) ?></h2>
    <div class="umk-block">
        <h4 class="umk-block--title">Цели учебно методического комплекса</h4>
        <div class="umk-block--text">
            <?= HtmlPurifier::process($umk->umkPurpose) ?>
        </div>
    </div>
    <div class="umk-block">
        <h4 class="umk-block--title">Юредическое обоснование</h4>
        <div class="umk-block--text">
            <?= HtmlPurifier::process($umk->umkLawJustification) ?>
        </div>
    </div>
    <div class="umk-block">
        <h4 class="umk-block--title">Требования к студенту</h4>
        <div class="umk-block--student-requrement">
            <?php foreach($requirements as $requirement){
                echo Html::tag('p', Html::encode($requirement->studentRequirementTypeAlias), [
                    'class' => 'umk-block--student-requrement-alias'
                ]); 
                echo Html::ul($umk->getUmkStudentRequirementsByType($requirement->studentRequirementTypeId)->all(), ['item' => function($item, $index) {
                    return Html::tag(
                        'li',
                        Html::encode($item->studentRequirementText)
                    );
                }]);
            }; ?>
        </div>
    </div>
    <div class="umk-block">
        <h4 class="umk-block--title">Разделы Учебно-методического комплекса</h4>
        <div class="umk-block--sections">
            <?php foreach($umk->sections as $section){
                echo '<div class="umk-block--sections-section">'; 
                echo Html::tag('h3', Html::encode($section->sectionName));
                    echo '<div class="umk-block--sections-section-details">'; 
                        echo '<div class="umk-block--sections-section-disciplines">';
                            echo Html::tag('h3', Html::encode('Дисциплины раздела'));
                            echo GridView::widget([
                                'dataProvider' => new ActiveDataProvider([
                                    'query' => $section->getSectionDisciplines()->joinWith(['discipline', 'sectionDisciplineType'])
                                ]),
                                'layout' => '{items}',
                                'columns' => [
                                    'discipline.disciplineName',
                                    'sectionDisciplineType.sectionDisciplineTypeName',
                                    'sectionDisciplineHours'
                                ],
                            ]);
                        echo '</div>';
                        echo '<div class="umk-block--sections-section-des">';
                            echo Html::tag('h3', Html::encode('Описание раздела'));
                            echo HtmlPurifier::process($section->sectionDescription);
                        echo '</div>';
                        echo '<div class="umk-block--sections-section-disciplines">';
                            echo Html::tag('h3', Html::encode('Рекомендованная литература к разделу'));
                            echo GridView::widget([
                                'dataProvider' => new ActiveDataProvider([
                                    'query' => $section->getSectionResources()->joinWith(['resource', 'resource.resourceType'])
                                ]),
                                'layout' => '{items}',
                                'columns' => [
                                    'resource.resourceName',
                                    'resource.resourceUrl',
                                    'resource.resourceType.resourceTypeAlias',
                                    'count',
                                ],
                                'options' => [
                                   'class' => 'grid',
                                ],
                            ]);
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            }; ?>
            <p class="umk-block--student-requrement-type"></p>
        </div>
    </div>
    <div class="umk-block">
        <h4 class="umk-block--title">Рекомендованная литература (для всего учебно-методического комплекса)</h4>
        <div class="umk-block--sections-section-disciplines">
            <?= GridView::widget([
                'dataProvider' => new ActiveDataProvider([
                    'query' => $umk->getUmkResources()->joinWith(['resource', 'resource.resourceType'])
                ]),
                'layout' => '{items}',
                'columns' => [
                    'resource.resourceName',
                    'resource.resourceUrl',
                    'resource.resourceType.resourceTypeAlias',
                    'count',
                ],
            ]) ?>
        </div>
    </div>
</div>
