<?php
/**
 * @copyright Ilch 2
 * @package ilch
 */

namespace Modules\Startpage\Mappers;

use Modules\Media\Models\Media as MediaModel;
use Modules\Startpage\Models\Startpage as StartpageModel;
use Modules\Admin\Models\Box as BoxModel;

class Startpage extends \Ilch\Mapper
{
    /**
     * Get all startpages by locale.
     *
     * @param string $locale
     * @return array|StartpageModel[]
     */
    public function getStartpages($locale)
    {
        $startpageArray = $this->db()->select(['startpage.id', 'startpage.grid', 'startpage.box1', 'startpage.box2', 'startpage.box3', 'startpage.box4', 'startpage.background_selection', 'startpage.background', 'startpage.image', 'startpage.color', 'startpage.heading', 'startpage.class', 'startpage.boxshadow', 'startpage.background_grid', 'startpage.color_grid'])
            ->from(['startpage' => 'startpage'])
            ->join(['selfbox1' => 'boxes_content'], 'startpage.box1 = selfbox1.box_id', 'LEFT', ['box1_id' => 'selfbox1.box_id', 'box1_content' => 'selfbox1.content', 'box1_locale' => 'selfbox1.locale', 'box1_title' => 'selfbox1.title'])
            ->join(['selfbox2' => 'boxes_content'], 'startpage.box2 = selfbox2.box_id', 'LEFT', ['box2_id' => 'selfbox2.box_id', 'box2_content' => 'selfbox2.content', 'box2_locale' => 'selfbox2.locale', 'box2_title' => 'selfbox2.title'])
            ->join(['selfbox3' => 'boxes_content'], 'startpage.box3 = selfbox3.box_id', 'LEFT', ['box3_id' => 'selfbox3.box_id', 'box3_content' => 'selfbox3.content', 'box3_locale' => 'selfbox3.locale', 'box3_title' => 'selfbox3.title'])
            ->join(['selfbox4' => 'boxes_content'], 'startpage.box4 = selfbox4.box_id', 'LEFT', ['box4_id' => 'selfbox4.box_id', 'box4_content' => 'selfbox4.content', 'box4_locale' => 'selfbox4.locale', 'box4_title' => 'selfbox4.title'])
            ->join(['modulebox1' => 'modules_boxes_content'], 'startpage.box1 = modulebox1.key', 'LEFT', ['modulebox1_key' => 'modulebox1.key', 'modulebox1_module' => 'modulebox1.module', 'modulebox1_locale' => 'modulebox1.locale', 'modulebox1_name' => 'modulebox1.name'])
            ->join(['modulebox2' => 'modules_boxes_content'], 'startpage.box2 = modulebox2.key', 'LEFT', ['modulebox2_key' => 'modulebox2.key', 'modulebox2_module' => 'modulebox2.module', 'modulebox2_locale' => 'modulebox2.locale', 'modulebox2_name' => 'modulebox2.name'])
            ->join(['modulebox3' => 'modules_boxes_content'], 'startpage.box3 = modulebox3.key', 'LEFT', ['modulebox3_key' => 'modulebox3.key', 'modulebox3_module' => 'modulebox3.module', 'modulebox3_locale' => 'modulebox3.locale', 'modulebox3_name' => 'modulebox3.name'])
            ->join(['modulebox4' => 'modules_boxes_content'], 'startpage.box4 = modulebox4.key', 'LEFT', ['modulebox4_key' => 'modulebox4.key', 'modulebox4_module' => 'modulebox4.module', 'modulebox4_locale' => 'modulebox4.locale', 'modulebox4_name' => 'modulebox4.name'])
            ->where(['modulebox1.locale' => $locale, 'modulebox2.locale' => $locale, 'modulebox3.locale' => $locale, 'modulebox4.locale' => $locale])
            ->execute()
            ->fetchRows();

        if (empty($startpageArray)) {
            return [];
        }

        $startpages = [];
        foreach ($startpageArray as $startpageRow) {
            $startpageModel = new StartpageModel();
            $startpageModel->setId($startpageRow['id']);
            $startpageModel->setGrid($startpageRow['grid']);

            $moduleBoxModel = new BoxModel();
            if (!empty($startpageRow['modulebox1.key'])) {
                $moduleBoxModel->setKey($startpageRow['modulebox1.key']);
                $moduleBoxModel->setModule($startpageRow['modulebox1.module']);
                $moduleBoxModel->setLocale($startpageRow['modulebox1.locale']);
                $moduleBoxModel->setName($startpageRow['modulebox1.name']);
            } else {
                $moduleBoxModel->setId($startpageRow['selfbox1.id']);
                $moduleBoxModel->setModule($startpageRow['selfbox1.module']);
                $moduleBoxModel->setLocale($startpageRow['selfbox1.locale']);
                $moduleBoxModel->setName($startpageRow['selfbox1.name']);
            }
            $startpageModel->setBox1($moduleBoxModel);

            $moduleBoxModel = new BoxModel();
            if (!empty($startpageRow['modulebox2.key'])) {
                $moduleBoxModel->setKey($startpageRow['modulebox2.key']);
                $moduleBoxModel->setModule($startpageRow['modulebox2.module']);
                $moduleBoxModel->setLocale($startpageRow['modulebox2.locale']);
                $moduleBoxModel->setName($startpageRow['modulebox2.name']);
            } else {
                $moduleBoxModel->setId($startpageRow['selfbox2.id']);
                $moduleBoxModel->setModule($startpageRow['selfbox2.module']);
                $moduleBoxModel->setLocale($startpageRow['selfbox2.locale']);
                $moduleBoxModel->setName($startpageRow['selfbox2.name']);
            }
            $startpageModel->setBox2($moduleBoxModel);

            $moduleBoxModel = new BoxModel();
            if (!empty($startpageRow['modulebox3.key'])) {
                $moduleBoxModel->setKey($startpageRow['modulebox3.key']);
                $moduleBoxModel->setModule($startpageRow['modulebox3.module']);
                $moduleBoxModel->setLocale($startpageRow['modulebox3.locale']);
                $moduleBoxModel->setName($startpageRow['modulebox3.name']);
            } else {
                $moduleBoxModel->setId($startpageRow['selfbox3.id']);
                $moduleBoxModel->setModule($startpageRow['selfbox3.module']);
                $moduleBoxModel->setLocale($startpageRow['selfbox3.locale']);
                $moduleBoxModel->setName($startpageRow['selfbox3.name']);
            }
            $startpageModel->setBox3($moduleBoxModel);

            $moduleBoxModel = new BoxModel();
            if (!empty($startpageRow['modulebox4.key'])) {
                $moduleBoxModel->setKey($startpageRow['modulebox4.key']);
                $moduleBoxModel->setModule($startpageRow['modulebox4.module']);
                $moduleBoxModel->setLocale($startpageRow['modulebox4.locale']);
                $moduleBoxModel->setName($startpageRow['modulebox4.name']);
            } else {
                $moduleBoxModel->setId($startpageRow['selfbox4.id']);
                $moduleBoxModel->setModule($startpageRow['selfbox4.module']);
                $moduleBoxModel->setLocale($startpageRow['selfbox4.locale']);
                $moduleBoxModel->setName($startpageRow['selfbox4.name']);
            }
            $startpageModel->setBox4($moduleBoxModel);

            $startpageModel->setBackgroundSelection($startpageRow['background_selection']);
            $startpageModel->setBackground($startpageRow['background']);
            $startpageModel->setImage($startpageRow['image']);
            $startpageModel->setColor($startpageRow['color']);
            $startpageModel->setHeading($startpageRow['heading']);
            $startpageModel->setClass($startpageRow['class']);
            $startpageModel->setBoxShadow($startpageRow['boxshadow']);
            $startpageModel->setBackgroundGrid($startpageRow['background_grid']);
            $startpageModel->setColorGrid($startpageRow['color_grid']);
            $startpages[] = $startpageModel;
        }

        return $startpages;
    }

    /**
     * Get a startpage by id and locale.
     *
     * @param int $id
     * @param string $locale
     * @return StartpageModel|null
     */
    public function getStartpage($id, $locale)
    {
        $startpageRow = $this->db()->select(['startpage.id', 'startpage.grid', 'startpage.box1', 'startpage.box2', 'startpage.box3', 'startpage.box4', 'startpage.background_selection', 'startpage.background', 'startpage.image', 'startpage.color', 'startpage.heading', 'startpage.class', 'startpage.boxshadow', 'startpage.background_grid', 'startpage.color_grid'])
            ->from(['startpage' => 'startpage'])
            ->join(['selfbox1' => 'boxes_content'], 'startpage.box1 = selfbox1.box_id', 'LEFT', ['selfbox1_id' => 'selfbox1.box_id', 'selfbox1_content' => 'selfbox1.content', 'selfbox1_locale' => 'selfbox1.locale', 'selfbox1_title' => 'selfbox1.title'])
            ->join(['selfbox2' => 'boxes_content'], 'startpage.box2 = selfbox2.box_id', 'LEFT', ['selfbox2_id' => 'selfbox2.box_id', 'selfbox2_content' => 'selfbox2.content', 'selfbox2_locale' => 'selfbox2.locale', 'selfbox2_title' => 'selfbox2.title'])
            ->join(['selfbox3' => 'boxes_content'], 'startpage.box3 = selfbox3.box_id', 'LEFT', ['selfbox3_id' => 'selfbox3.box_id', 'selfbox3_content' => 'selfbox3.content', 'selfbox3_locale' => 'selfbox3.locale', 'selfbox3_title' => 'selfbox3.title'])
            ->join(['selfbox4' => 'boxes_content'], 'startpage.box4 = selfbox4.box_id', 'LEFT', ['selfbox4_id' => 'selfbox4.box_id', 'selfbox4_content' => 'selfbox4.content', 'selfbox4_locale' => 'selfbox4.locale', 'selfbox4_title' => 'selfbox4.title'])
            ->join(['modulebox1' => 'modules_boxes_content'], 'startpage.box1 = modulebox1.key', 'LEFT', ['modulebox1_key' => 'modulebox1.key', 'modulebox1_module' => 'modulebox1.module', 'modulebox1_locale' => 'modulebox1.locale', 'modulebox1_name' => 'modulebox1.name'])
            ->join(['modulebox2' => 'modules_boxes_content'], 'startpage.box2 = modulebox2.key', 'LEFT', ['modulebox2_key' => 'modulebox2.key', 'modulebox2_module' => 'modulebox2.module', 'modulebox2_locale' => 'modulebox2.locale', 'modulebox2_name' => 'modulebox2.name'])
            ->join(['modulebox3' => 'modules_boxes_content'], 'startpage.box3 = modulebox3.key', 'LEFT', ['modulebox3_key' => 'modulebox3.key', 'modulebox3_module' => 'modulebox3.module', 'modulebox3_locale' => 'modulebox3.locale', 'modulebox3_name' => 'modulebox3.name'])
            ->join(['modulebox4' => 'modules_boxes_content'], 'startpage.box4 = modulebox4.key', 'LEFT', ['modulebox4_key' => 'modulebox4.key', 'modulebox4_module' => 'modulebox4.module', 'modulebox4_locale' => 'modulebox4.locale', 'modulebox4_name' => 'modulebox4.name'])
            ->where(['startpage.id' => $id, 'modulebox1.locale' => $locale, 'modulebox2.locale' => $locale, 'modulebox3.locale' => $locale, 'modulebox4.locale' => $locale])
            ->execute()
            ->fetchAssoc();

        if (empty($startpageRow)) {
            return null;
        }

        $startpageModel = new StartpageModel();
        $startpageModel->setId($startpageRow['id']);
        $startpageModel->setGrid($startpageRow['grid']);

        $moduleBoxModel = new BoxModel();
        if (!empty($startpageRow['modulebox1_key'])) {
            $moduleBoxModel->setKey($startpageRow['modulebox1_key']);
            $moduleBoxModel->setModule($startpageRow['modulebox1_module']);
            $moduleBoxModel->setLocale($startpageRow['modulebox1_locale']);
            $moduleBoxModel->setName($startpageRow['modulebox1_name']);
        } else {
            $moduleBoxModel->setId($startpageRow['selfbox1_id']);
            $moduleBoxModel->setModule($startpageRow['selfbox1_module']);
            $moduleBoxModel->setLocale($startpageRow['selfbox1_locale']);
            $moduleBoxModel->setName($startpageRow['selfbox1_name']);
        }
        $startpageModel->setBox1($moduleBoxModel);

        $moduleBoxModel = new BoxModel();
        if (!empty($startpageRow['modulebox2_key'])) {
            $moduleBoxModel->setKey($startpageRow['modulebox2_key']);
            $moduleBoxModel->setModule($startpageRow['modulebox2_module']);
            $moduleBoxModel->setLocale($startpageRow['modulebox2_locale']);
            $moduleBoxModel->setName($startpageRow['modulebox2_name']);
        } else {
            $moduleBoxModel->setId($startpageRow['selfbox2_id']);
            $moduleBoxModel->setModule($startpageRow['selfbox2_module']);
            $moduleBoxModel->setLocale($startpageRow['selfbox2_locale']);
            $moduleBoxModel->setName($startpageRow['selfbox2_name']);
        }
        $startpageModel->setBox2($moduleBoxModel);

        $moduleBoxModel = new BoxModel();
        if (!empty($startpageRow['modulebox3_key'])) {
            $moduleBoxModel->setKey($startpageRow['modulebox3_key']);
            $moduleBoxModel->setModule($startpageRow['modulebox3_module']);
            $moduleBoxModel->setLocale($startpageRow['modulebox3_locale']);
            $moduleBoxModel->setName($startpageRow['modulebox3_name']);
        } else {
            $moduleBoxModel->setId($startpageRow['selfbox3_id']);
            $moduleBoxModel->setModule($startpageRow['selfbox3_module']);
            $moduleBoxModel->setLocale($startpageRow['selfbox3_locale']);
            $moduleBoxModel->setName($startpageRow['selfbox3_name']);
        }
        $startpageModel->setBox3($moduleBoxModel);

        $moduleBoxModel = new BoxModel();
        if (!empty($startpageRow['modulebox4_key'])) {
            $moduleBoxModel->setKey($startpageRow['modulebox4_key']);
            $moduleBoxModel->setModule($startpageRow['modulebox4_module']);
            $moduleBoxModel->setLocale($startpageRow['modulebox4_locale']);
            $moduleBoxModel->setName($startpageRow['modulebox4_name']);
        } else {
            $moduleBoxModel->setId($startpageRow['selfbox4_id']);
            $moduleBoxModel->setModule($startpageRow['selfbox4_module']);
            $moduleBoxModel->setLocale($startpageRow['selfbox4_locale']);
            $moduleBoxModel->setName($startpageRow['selfbox4_name']);
        }
        $startpageModel->setBox4($moduleBoxModel);

        $startpageModel->setBackgroundSelection($startpageRow['background_selection']);
        $startpageModel->setBackground($startpageRow['background']);
        $startpageModel->setImage($startpageRow['image']);
        $startpageModel->setColor($startpageRow['color']);
        $startpageModel->setHeading($startpageRow['heading']);
        $startpageModel->setClass($startpageRow['class']);
        $startpageModel->setBoxShadow($startpageRow['boxshadow']);
        $startpageModel->setBackgroundGrid($startpageRow['background_grid']);
        $startpageModel->setColorGrid($startpageRow['color_grid']);

        return $startpageModel;
    }

    /**
     * Return a slimmed down list of the startpages (id, grid, heading and class).
     *
     * @param array $where
     * @return array|StartpageModel[]
     */
    public function getStartPagesList($where = [])
    {
        $startpageRows = $this->db()->select(['id', 'grid', 'heading', 'class'])
            ->from('startpage')
            ->where($where)
            ->execute()
            ->fetchRows();

        if (empty($startpageRows)) {
            return [];
        }

        $startpages = [];
        foreach ($startpageRows as $startpageRow) {
            $startpageModel = new StartpageModel();

            $startpageModel->setId($startpageRow['id']);
            $startpageModel->setGrid($startpageRow['grid']);
            $startpageModel->setHeading($startpageRow['heading']);
            $startpageModel->setClass($startpageRow['class']);
            $startpages[] = $startpageModel;
        }

        return $startpages;
    }

    /**
     * Save startpage to database.
     *
     * @param StartpageModel $startpage
     */
    public function save(StartpageModel $startpage)
    {
        $fields = [
            'id' => $startpage->getId(),
            'grid' => $startpage->getGrid(),
            'box1' => $startpage->getBox1(),
            'box2' => $startpage->getBox2(),
            'box3' => $startpage->getBox3(),
            'box4' => $startpage->getBox4(),
            'background_selection' => $startpage->getBackgroundSelection(),
            'background' => $startpage->getBackground(),
            'image' => $startpage->getImage(),
            'color' => $startpage->getColor(),
            'heading' => $startpage->getHeading(),
            'class' => $startpage->getClass(),
            'boxshadow' => $startpage->getBoxShadow(),
            'background_grid' => $startpage->getBackgroundGrid(),
            'color_grid' => $startpage->getColorGrid(),
        ];

        if ($startpage->getId()) {
            $this->db()->update('startpage')
                ->values($fields)
                ->where(['id' => $startpage->getId()])
                ->execute();
        } else {
            $this->db()->insert('startpage')
                ->values($fields)
                ->execute();
        }
    }

    /**
     * Delete startpage by id.
     *
     * @param int $id
     */
    public function delete($id)
    {
        $this->db()->delete('startpage')
            ->where(['id' => $id])
            ->execute();
    }
}
