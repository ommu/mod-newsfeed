<?php
/**
 * Newsfeeds
 *
 * Newsfeeds represents the model behind the search form about `ommu\newsfeed\models\Newsfeeds`.
 *
 * @author Putra Sudaryanto <putra@ommu.id>
 * @contact (+62)811-2540-432
 * @copyright Copyright (c) 2020 OMMU (www.ommu.id)
 * @created date 6 January 2020, 11:28 WIB
 * @modified date 31 March 2020, 20:56 WIB
 * @link https://github.com/ommu/mod-newsfeed
 *
 */

namespace ommu\newsfeed\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use ommu\newsfeed\models\Newsfeeds as NewsfeedsModel;

class Newsfeeds extends NewsfeedsModel
{
	/**
	 * {@inheritdoc}
	 */
	public function rules()
	{
		return [
			[['id', 'publish', 'member_id', 'user_id', 'privacy', 'likes', 'comments', 'creation_id', 'modified_id', 'updated_id'], 'integer'],
			[['app', 'newsfeed_type', 'newsfeed_post', 'newsfeed_param', 'creation_date', 'modified_date', 'updated_date', 'memberDisplayname', 'creationDisplayname', 'modifiedDisplayname', 'updatedDisplayname'], 'safe'],
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
            $query = NewsfeedsModel::find()->alias('t');
        } else {
            $query = NewsfeedsModel::find()->alias('t')->select($column);
        }
		$query->joinWith([
			// 'member member', 
			// 'user user', 
			// 'creation creation', 
			// 'modified modified', 
			// 'updated updated'
		]);
        if ((isset($params['sort']) && in_array($params['sort'], ['memberDisplayname', '-memberDisplayname'])) || (isset($params['memberDisplayname']) && $params['memberDisplayname'] != '')) {
            $query->joinWith(['member member', 'user user']);
        }
        if ((isset($params['sort']) && in_array($params['sort'], ['creationDisplayname', '-creationDisplayname'])) || (isset($params['creationDisplayname']) && $params['creationDisplayname'] != '')) {
            $query->joinWith(['creation creation']);
        }
        if ((isset($params['sort']) && in_array($params['sort'], ['modifiedDisplayname', '-modifiedDisplayname'])) || (isset($params['modifiedDisplayname']) && $params['modifiedDisplayname'] != '')) {
            $query->joinWith(['modified modified']);
        }
        if ((isset($params['sort']) && in_array($params['sort'], ['updatedDisplayname', '-updatedDisplayname'])) || (isset($params['updatedDisplayname']) && $params['updatedDisplayname'] != '')) {
            $query->joinWith(['updated updated']);
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
		$attributes['memberDisplayname'] = [
			'asc' => ['member.displayname' => SORT_ASC],
			'desc' => ['member.displayname' => SORT_DESC],
		];
		$attributes['creationDisplayname'] = [
			'asc' => ['creation.displayname' => SORT_ASC],
			'desc' => ['creation.displayname' => SORT_DESC],
		];
		$attributes['modifiedDisplayname'] = [
			'asc' => ['modified.displayname' => SORT_ASC],
			'desc' => ['modified.displayname' => SORT_DESC],
		];
		$attributes['updatedDisplayname'] = [
			'asc' => ['updated.displayname' => SORT_ASC],
			'desc' => ['updated.displayname' => SORT_DESC],
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
			't.member_id' => isset($params['member']) ? $params['member'] : $this->member_id,
			't.user_id' => isset($params['user']) ? $params['user'] : $this->user_id,
			't.privacy' => $this->privacy,
			't.likes' => $this->likes,
			't.comments' => $this->comments,
			'cast(t.creation_date as date)' => $this->creation_date,
			't.creation_id' => isset($params['creation']) ? $params['creation'] : $this->creation_id,
			'cast(t.modified_date as date)' => $this->modified_date,
			't.modified_id' => isset($params['modified']) ? $params['modified'] : $this->modified_id,
			'cast(t.updated_date as date)' => $this->updated_date,
			't.updated_id' => isset($params['updated']) ? $params['updated'] : $this->updated_id,
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

        if (isset($params['memberDisplayname']) && $params['memberDisplayname'] != '') {
            $query->andWhere(['or', 
                ['like', 'member.displayname', $this->memberDisplayname],
                ['like', 'user.displayname', $this->memberDisplayname]
            ]);
        }

		$query->andFilterWhere(['like', 't.app', $this->app])
			->andFilterWhere(['like', 't.newsfeed_type', $this->newsfeed_type])
			->andFilterWhere(['like', 't.newsfeed_post', $this->newsfeed_post])
			->andFilterWhere(['like', 't.newsfeed_param', $this->newsfeed_param])
			->andFilterWhere(['like', 'creation.displayname', $this->creationDisplayname])
			->andFilterWhere(['like', 'modified.displayname', $this->modifiedDisplayname])
			->andFilterWhere(['like', 'updated.displayname', $this->updatedDisplayname]);

		return $dataProvider;
	}
}
