<?php
/**
 * @package     Mautic
 * @copyright   2014 Mautic, NP. All rights reserved.
 * @author      Mautic
 * @link        http://mautic.com
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */
if ($tmpl == 'index')
$view->extend('MauticPointBundle:Point:index.html.php');
?>

    <?php if (count($items)): ?>
    <div class="panel panel-default bdr-t-wdh-0">
        <div class="table-responsive scrollable body-white padding-sm page-list">
            <table class="table table-hover table-striped table-bordered point-list" id="pointTable">
                <thead>
                <tr>
                    <th class="col-point-actions pl-20">
                        <div class="checkbox-inline custom-primary">
                            <label class="mb-0 pl-10">
                                <input type="checkbox" id="customcheckbox-one0" value="1" data-toggle="checkall" data-target="#pointTable">
                                <span></span>
                            </label>
                        </div>
                    </th>
                    <?php
                    echo $view->render('MauticCoreBundle:Helper:tableheader.html.php', array(
                        'sessionVar' => 'point',
                        'orderBy'    => 'p.name',
                        'text'       => 'mautic.point.thead.name',
                        'class'      => 'col-point-name',
                        'default'    => true
                    ));

                    echo $view->render('MauticCoreBundle:Helper:tableheader.html.php', array(
                        'sessionVar' => 'point',
                        'orderBy'    => 'p.description',
                        'text'       => 'mautic.point.thead.description',
                        'class'      => 'col-point-description'
                    ));

                    echo '<th class="col-point-action">' . $view['translator']->trans('mautic.point.thead.action') . '</th>';

                    echo $view->render('MauticCoreBundle:Helper:tableheader.html.php', array(
                        'sessionVar' => 'point',
                        'orderBy'    => 'p.id',
                        'text'       => 'mautic.point.thead.id',
                        'class'      => 'col-point-id'
                    ));
                    ?>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($items as $item): ?>
                    <tr>
                        <td>
                            <?php
                            echo $view->render('MauticCoreBundle:Helper:actions.html.php', array(
                                'item'      => $item,
                                'edit'      => $permissions['point:points:edit'],
                                'clone'     => $permissions['point:points:create'],
                                'delete'    => $permissions['point:points:delete'],
                                'routeBase' => 'point',
                                'menuLink'  => 'mautic_point_index',
                                'langVar'   => 'point'
                            ));
                            ?>
                        </td>
                        <td>
                            <?php echo $view->render('MauticCoreBundle:Helper:publishstatus.html.php',array(
                                'item'       => $item,
                                'model'      => 'point'
                            )); ?>
                            <a href="<?php echo $view['router']->generate('mautic_point_action',
                                array("objectAction" => "view", "objectId" => $item->getId())); ?>"
                               data-toggle="ajax">
                                <?php echo $item->getName(); ?>
                            </a>
                        </td>
                        <td class="visible-md visible-lg"><?php echo $item->getDescription(); ?></td>
                        <?php
                        $type   = $item->getType();
                        $action = (isset($actions[$type])) ? $actions[$type]['label'] : '';
                        ?>
                        <td class="visible-md visible-lg"><?php echo $view['translator']->trans($action); ?></td>
                        <td class="visible-md visible-lg"><?php echo $item->getId(); ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="panel-footer">
            <?php echo $view->render('MauticCoreBundle:Helper:pagination.html.php', array(
            "totalItems"      => count($items),
            "page"            => $page,
            "limit"           => $limit,
            "menuLinkId"      => 'mautic_point_index',
            "baseUrl"         => $view['router']->generate('mautic_point_index'),
            'sessionVar'      => 'point'
        )); ?>
        </div>
    </div>
    <?php else: ?>
        <?php echo $view->render('MauticCoreBundle:Default:noresults.html.php'); ?>
    <?php endif; ?>
