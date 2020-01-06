<?php
/**
 * NewsfeedLike
 *
 * NewsfeedLike represents the model behind the search form about `app\modules\newsfeed\models\NewsfeedLike`.
 *
 * @author Putra Sudaryanto <putra@ommu.co>
 * @contact (+62)856-299-4114
 * @copyright Copyright (c) 2020 Ommu Platform (www.ommu.co)
 * @created date 6 January 2020, 11:31 WIB
 * @link https://www.ommu.co
 *
 */

namespace app\modules\newsfeed\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\newsfeed\models\NewsfeedLike as NewsfeedLikeModel;

class NewsfeedLike extends NewsfeedLikeModel
{
	/**
	 * {@inheritdoc}
	 */
	public function rules()
	{
		return [
			[['id', 'publish', 'newsfeed_id', 'member_id', 'user_id', 'updated_id'], 'integer'],
			[['likes_date', 'likes_ip', 'updated_date', 'newsfeedId', 'memberDisplayname', 'userDisplayname', 'updatedDisplayname'], 'safe'],
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
		if(!($column && is_array($column)))
			$query = NewsfeedLikeModel::find()->alias('t');
		else
			$query = NewsfeedLikeModel::find()->alias('t')->select($column);
		$query->joinWith([
			// 'newsfeed newsfeed', 
			// 'member member', 
			// 'user user', 
			// 'updated updated'
		]);
		if((isset($params['sort']) && in_array($params['sort'], ['newsfeedId', '-newsfeedId'])) || (isset($params['newsfeedId']) && $params['newsfeedId'] != ''))
			$query = $query->joinWith(['newsfeed newsfeed']);
		if((isset($params['sort']) && in_array($params['sort'], ['memberDisplayname', '-memberDisplayname'])) || (isset($params['memberDisplayname']) && $params['memberDisplayname'] != ''))
			$query = $query->joinWith(['member member']);
		if((isset($params['sort']) && in_array($params['sort'], ['userDisplayname', '-userDisplayname'])) || (isset($params['userDisplayname']) && $params['userDisplayname'] != ''))
			$query = $query->joinWith(['user user']);
		if((isset($params['sort']) && in_array($params['sort'], ['updatedDisplayname', '-updatedDisplayname'])) || (isset($params['updatedDisplayname']) && $params['updatedDisplayname'] != ''))
			$query = $query->joinWith(['updated updated']);

		$query = $query->groupBy(['id']);

		// add conditions that should always apply here
		$dataParams = [
			'query' => $query,
		];
		// disable pagination agar data pada api tampil semua
		if(isset($params['pagination']) && $params['pagination'] == 0)
			$dataParams['pagination'] = false;
		$dataProvider = new ActiveDataProvider($dataParams);

		$attributes = array_keys($this->getTableSchema()->columns);
		$attributes['newsfeedId'] = [
			'asc' => ['newsfeed.id' => SORT_ASC],
			'desc' => ['newsfeed.id' => SORT_DESC],
		];
		$attributes['memberDisplayname'] = [
			'asc' => ['member.displayname' => SORT_ASC],
			'desc' => ['member.displayname' => SORT_DESC],
		];
		$attributes['userDisplayname'] = [
			'asc' => ['user.displayname' => SORT_ASC],
			'desc' => ['user.displayname' => SORT_DESC],
		];
		$attributes['updatedDisplayname'] = [
			'asc' => ['updated.displayname' => SORT_ASC],
			'desc' => ['updated.displayname' => SORT_DESC],
		];
		$dataProvider->setSort([
			'attributes' => $attributes,
			'defaultOrder' => ['id' => SORT_DESC],
		]);

		if(Yii::$app->request->get('id'))
			unset($params['id']);
		$this->load($params);

		if(!$this->validate()) {
			// uncomment the following line if you do not want to return any records when validation fails
			// $query->where('0=1');
			return $dataProvider;
		}

		// grid filtering conditions
		$query->andFilterWhere([
			't.id' => $this->id,
			't.newsfeed_id' => isset($params['newsfeed']) ? $params['newsfeed'] : $this->newsfeed_id,
			't.member_id' => isset($params['member']) ? $params['member'] : $this->member_id,
			't.user_id' => isset($params['user']) ? $params['user'] : $this->user_id,
			'cast(t.likes_date as date)' => $this->likes_date,
			'cast(t.updated_date as date)' => $this->updated_date,
			't.updated_id' => isset($params['updated']) ? $params['updated'] : $this->updated_id,
		]);

		if(isset($params['trash']))
			$query->andFilterWhere(['NOT IN', 't.publish', [0,1]]);
		else {
			if(!isset($params['publish']) || (isset($params['publish']) && $params['publish'] == ''))
				$query->andFilterWhere(['IN', 't.publish', [0,1]]);
			else
				$query->andFilterWhere(['t.publish' => $this->publish]);
		}

		$query->andFilterWhere(['like', 't.likes_ip', $this->likes_ip])
			->andFilterWhere(['like', 'newsfeed.id', $this->newsfeedId])
			->andFilterWhere(['like', 'member.displayname', $this->memberDisplayname])
			->andFilterWhere(['like', 'user.displayname', $this->userDisplayname])
			->andFilterWhere(['like', 'updated.displayname', $this->updatedDisplayname]);

		return $dataProvider;
	}
}
