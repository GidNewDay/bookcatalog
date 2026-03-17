<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\data\SqlDataProvider;

class ReportController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['?', '@'], // доступно всем
                    ],
                ],
            ],
        ];
    }

    public function actionTopAuthors()
    {
        $year = Yii::$app->request->get('year', date('Y'));

        // Список всех годов, за которые есть книги (для выпадающего списка)
        $years = (new \yii\db\Query())
            ->select('year')
            ->distinct()
            ->from('books')
            ->orderBy('year DESC')
            ->column();

        // SQL запрос для топа авторов
        $sql = "
            SELECT a.id, a.full_name, COUNT(ba.book_id) as book_count
            FROM authors a
            JOIN book_author ba ON a.id = ba.author_id
            JOIN books b ON ba.book_id = b.id
            WHERE b.year = :year
            GROUP BY a.id, a.full_name
            ORDER BY book_count DESC
            LIMIT 10
        ";

        $dataProvider = new SqlDataProvider([
            'sql' => $sql,
            'params' => [':year' => $year],
            'key' => 'id',
            'pagination' => false, // отключаем пагинацию, чтобы не добавлялся лишний LIMIT
        ]);

        return $this->render('top-authors', [
            'dataProvider' => $dataProvider,
            'years' => $years,
            'selectedYear' => $year,
        ]);
    }
}