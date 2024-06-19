<?php
/**
 * NewsfeedTag
 *
 * NewsfeedTag represents the model behind the search form about `ommu\newsfeed\models\NewsfeedTag`.
 *
 * @author Putra Sudaryanto <putra@ommu.id>
 * @contact (+62)811-2540-432
 * @copyright Copyright (c) 2020 OMMU (www.ommu.id)
 * @created date 13 July 2020, 07:13 WIB
 * @link https://github.com/ommu/mod-newsfeed
 *
 */

namespace ommu\newsfeed\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use ommu\newsfeed\models\NewsfeedTag as NewsfeedTagModel;

class NewsfeedTag extends NewsfeedTagModel
{
	/**
	 * {@inheritdoc}
	 */
	public function rules()
	{
		return [
			[['id', 'newsfeed_id', 'publish', 'tag_id', 'creation_id'], 'integer'],
			[['creation_date', 'tagBody', 'newsfeedId', 'creationDisplayname'], 'safe'],
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function scenarios()
	{
		// bypass scenarios() implementation in the parent class
		return Model::scenarios();
	}

	/**
	 * Tambahkan fungsi beforeValidate ini pada model search untuk menumpuk validasi pd model induk. 
	 * dan "jangan" tambahkan parent::beforeValidate, cukup "return true" saja.
	 * maka validasi yg akan dipakai hanya pd model ini, semua script yg ditaruh di beforeValidate pada model induk
	 * tidak akan dijalankan.
	 */
	public function beforeValidate() {
		return true;
	}

	/**
	 * Creates data provider instance with search query applied
	 *
	 * @param array $params
	 *
	 * @return ActiveDataProvider
	 */
	public function search($params, $column=null)
	{
        if (!($column && is_array($column))) {
            $query = NewsfeedTagModel::find()->alias('t');
        } else {
            $query = NewsfeedTagModel::find()->alias('t')->select($column);
        }
		$query->joinWith([
			// 'tag tag', 
			// 'newsfeed newsfeed', 
			// 'creation creation'
		]);
        if ((isset($params['sort']) && in_array($params['sort'], ['tagBody', '-tagBody'])) || (isset($params['tagBody']) && $params['tagBody'] != '')) {
            $query->joinWith(['tag tag']);
        }
        if ((isset($params['sort']) && in_array($params['sort'], ['newsfeedId', '-newsfeedId'])) || (isset($params['newsfeedId']) && $params['newsfeedId'] != '')) {
            $query->joinWith(['newsfeed newsfeed']);
        }
        if ((isset($params['sort']) && in_array($params['sort'], ['creationDisplayname', '-creationDisplayname'])) || (isset($params['creationDisplayname']) && $params['creationDisplayname'] != '')) {
            $query->joinWith(['creation creation']);
        }

		$query->groupBy(['id']);

        // add conditions that should always apply here
		$dataParams = [
			'query' => $query,
		];
        // disable pagination agar data pada api tampil semua
        if (isset($params['pagination']) && $params['pagination'] == 0) {
            $dataParams['pagination'] = false;
        }
		$dataProvider = new ActiveDataProvider($dataParams);

		$attributes = array_keys($this->getTableSchema()->columns);
		$attributes['tagBody'] = [
			'asc' => ['tag.body' => SORT_ASC],
			'desc' => ['tag.body' => SORT_DESC],
		];
		$attributes['newsfeedId'] = [
			'asc' => ['newsfeed.id' => SORT_ASC],
			'desc' => ['newsfeed.id' => SORT_DESC],
		];
		$attributes['creationDisplayname'] = [
			'asc' => ['creation.displayname' => SORT_ASC],
			'desc' => ['creation.displayname' => SORT_DESC],
		];
		$dataProvider->setSort([
			'attributes' => $attributes,
			'defaultOrder' => ['id' => SORT_DESC],
		]);

        if (Yii::$app->request->get('id')) {
            unset($params['id']);
        }
		$this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

		// grid filtering conditions
		$query->andFilterWhere([
			't.id' => $this->id,
			't.newsfeed_id' => isset($params['newsfeed']) ? $params['newsfeed'] : $this->newsfeed_id,
			't.tag_id' => isset($params['tag']) ? $params['tag'] : $this->tag_id,
			'cast(t.creation_date as date)' => $this->creation_date,
			't.creation_id' => isset($params['creation']) ? $params['creation'] : $this->creation_id,
		]);

        if (isset($params['trash'])) {
            $query->andFilterWhere(['NOT IN', 't.publish', [0,1]]);
        } else {
            if (!isset($params['publish']) || (isset($params['publish']) && $params['publish'] == '')) {
                $query->andFilterWhere(['IN', 't.publish', [0,1]]);
            } else {
                $query->andFilterWhere(['t.publish' => $this->publish]);
            }
        }

		$query->andFilterWhere(['like', 'tag.body', $this->tagBody])
			->andFilterWhere(['like', 'newsfeed.id', $this->newsfeedId])
			->andFilterWhere(['like', 'creation.displayname', $this->creationDisplayname]);

		return $dataProvider;
	}
}
