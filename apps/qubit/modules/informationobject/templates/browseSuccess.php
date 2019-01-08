<?php if (isset($pager) && $pager->getNbResults() || sfConfig::get('app_enable_institutional_scoping')): ?>
  <?php decorate_with('layout_2col') ?>
<?php else: ?>
  <?php decorate_with('layout_1col') ?>
<?php endif; ?>

<?php use_helper('Date') ?>

<?php slot('title') ?>
  <?php echo get_partial('default/printPreviewBar') ?>

  <div class="multiline-header">
    <?php echo image_tag('/images/icons-large/icon-archival.png', array('alt' => '')) ?>
    <h1 aria-describedby="results-label">
      <?php if (isset($pager) && $pager->getNbResults()): ?>
        <?php echo __('Showing %1% results', array('%1%' => $pager->getNbResults())) ?>
      <?php else: ?>
        <?php echo __('No results found') ?>
      <?php endif; ?>
    </h1>
    <span class="sub" id="results-label"><?php echo sfConfig::get('app_ui_label_informationobject') ?></span>
  </div>
<?php end_slot() ?>

<?php if (isset($pager) && $pager->getNbResults() || sfConfig::get('app_enable_institutional_scoping')): ?>

  <?php slot('sidebar') ?>

<?php echo __('Cool animal pal') ?>

    <section id="facets">

      <div class="visible-phone facets-header">
        <a class="x-btn btn-wide">
          <i class="fa fa-filter"></i>
          <?php echo __('Filters') ?>
        </a>
      </div>

      <div class="content">

        <?php if ($sf_user->getAttribute('search-realm') && sfConfig::get('app_enable_institutional_scoping')): ?>
          <?php include_component('repository', 'holdingsInstitution', array('resource' => QubitRepository::getById($sf_user->getAttribute('search-realm')))) ?>
        <?php endif; ?>

        <h2><?php echo sfConfig::get('app_ui_label_facetstitle') ?></h2>

        <?php echo get_partial('search/aggregation', array(
          'id' => '#facet-languages',
          'label' => __('Language'),
          'name' => 'languages',
          'aggs' => $aggs,
          'filters' => $search->filters)) ?>

        <?php echo get_partial('search/aggregation', array(
          'id' => '#facet-collection',
          'label' => __('Part of'),
          'name' => 'collection',
          'aggs' => $aggs,
          'filters' => $search->filters)) ?>

        <?php if (sfConfig::get('app_multi_repository')): ?>
          <?php echo get_partial('search/aggregation', array(
            'id' => '#facet-repository',
            'label' => sfConfig::get('app_ui_label_repository'),
            'name' => 'repos',
            'aggs' => $aggs,
            'filters' => $search->filters)) ?>
        <?php endif; ?>

        <?php echo get_partial('search/aggregation', array(
          'id' => '#facet-names',
          'label' => sfConfig::get('app_ui_label_creator'),
          'name' => 'creators',
          'aggs' => $aggs,
          'filters' => $search->filters)) ?>

        <?php echo get_partial('search/aggregation', array(
          'id' => '#facet-names',
          'label' => sfConfig::get('app_ui_label_name'),
          'name' => 'names',
          'aggs' => $aggs,
          'filters' => $search->filters)) ?>

        <?php echo get_partial('search/aggregation', array(
          'id' => '#facet-places',
          'label' => sfConfig::get('app_ui_label_place'),
          'name' => 'places',
          'aggs' => $aggs,
          'filters' => $search->filters)) ?>

        <?php echo get_partial('search/aggregation', array(
          'id' => '#facet-subjects',
          'label' => sfConfig::get('app_ui_label_subject'),
          'name' => 'subjects',
          'aggs' => $aggs,
          'filters' => $search->filters)) ?>

        <?php echo get_partial('search/aggregation', array(
          'id' => '#facet-genres',
          'label' => sfConfig::get('app_ui_label_genre'),
          'name' => 'genres',
          'aggs' => $aggs,
          'filters' => $search->filters)) ?>

        <?php echo get_partial('search/aggregation', array(
          'id' => '#facet-levelOfDescription',
          'label' => __('Level of description'),
          'name' => 'levels',
          'aggs' => $aggs,
          'filters' => $search->filters)) ?>

        <?php echo get_partial('search/aggregation', array(
          'id' => '#facet-mediaTypes',
          'label' => sfConfig::get('app_ui_label_mediatype'),
          'name' => 'mediatypes',
          'aggs' => $aggs,
          'filters' => $search->filters)) ?>

      </div>

    </section>

  <?php end_slot() ?>

<?php endif; ?>

<?php slot('before-content') ?>

  <section class="header-options">

    <?php if (isset($repos)): ?>
      <span class="search-filter">
        <?php echo render_title($repos) ?>
        <?php $params = $sf_data->getRaw('sf_request')->getGetParameters() ?>
        <?php unset($params['repos']) ?>
        <a href="<?php echo url_for(array('module' => 'informationobject', 'action' => 'browse') + $params) ?>" class="remove-filter"><i class="fa fa-times"></i></a>
      </span>
    <?php endif; ?>

    <?php if (isset($collection)): ?>
      <span class="search-filter">
        <?php echo render_title($collection) ?>
        <?php $params = $sf_data->getRaw('sf_request')->getGetParameters() ?>
        <?php unset($params['collection']) ?>
        <a href="<?php echo url_for(array('module' => 'informationobject', 'action' => 'browse') + $params) ?>" class="remove-filter"><i class="fa fa-times"></i></a>
      </span>
    <?php endif; ?>

    <?php if (isset($creators)): ?>
      <span class="search-filter">
        <?php echo render_title($creators) ?>
        <?php $params = $sf_data->getRaw('sf_request')->getGetParameters() ?>
        <?php unset($params['creators']) ?>
        <a href="<?php echo url_for(array('module' => 'informationobject', 'action' => 'browse') + $params) ?>" class="remove-filter"><i class="fa fa-times"></i></a>
      </span>
    <?php endif; ?>

    <?php if (isset($names)): ?>
      <span class="search-filter">
        <?php echo render_title($names) ?>
        <?php $params = $sf_data->getRaw('sf_request')->getGetParameters() ?>
        <?php unset($params['names']) ?>
        <a href="<?php echo url_for(array('module' => 'informationobject', 'action' => 'browse') + $params) ?>" class="remove-filter"><i class="fa fa-times"></i></a>
      </span>
    <?php endif; ?>

    <?php if (isset($places)): ?>
      <span class="search-filter">
        <?php echo render_title($places) ?>
        <?php $params = $sf_data->getRaw('sf_request')->getGetParameters() ?>
        <?php unset($params['places']) ?>
        <a href="<?php echo url_for(array('module' => 'informationobject', 'action' => 'browse') + $params) ?>" class="remove-filter"><i class="fa fa-times"></i></a>
      </span>
    <?php endif; ?>

    <?php if (isset($levels)): ?>
      <span class="search-filter">
        <?php echo render_title($levels) ?>
        <?php $params = $sf_data->getRaw('sf_request')->getGetParameters() ?>
        <?php unset($params['levels']) ?>
        <a href="<?php echo url_for(array('module' => 'informationobject', 'action' => 'browse') + $params) ?>" class="remove-filter"><i class="fa fa-times"></i></a>
      </span>
    <?php endif; ?>

    <?php if (isset($subjects)): ?>
      <span class="search-filter">
        <?php echo render_title($subjects) ?>
        <?php $params = $sf_data->getRaw('sf_request')->getGetParameters() ?>
        <?php unset($params['subjects']) ?>
        <a href="<?php echo url_for(array('module' => 'informationobject', 'action' => 'browse') + $params) ?>" class="remove-filter"><i class="fa fa-times"></i></a>
      </span>
    <?php endif; ?>

    <?php if (isset($mediatypes)): ?>
      <span class="search-filter">
        <?php echo render_title($mediatypes) ?>
        <?php $params = $sf_data->getRaw('sf_request')->getGetParameters() ?>
        <?php unset($params['mediatypes']) ?>
        <a href="<?php echo url_for(array('module' => 'informationobject', 'action' => 'browse') + $params) ?>" class="remove-filter"><i class="fa fa-times"></i></a>
      </span>
    <?php endif; ?>

    <?php if (isset($copyrightStatus)): ?>
      <span class="search-filter">
        <?php echo render_title($copyrightStatus) ?>
        <?php $params = $sf_data->getRaw('sf_request')->getGetParameters() ?>
        <?php unset($params['copyrightStatus']) ?>
        <a href="<?php echo url_for(array('module' => 'informationobject', 'action' => 'browse') + $params) ?>" class="remove-filter"><i class="fa fa-times"></i></a>
      </span>
    <?php endif; ?>

    <?php if (isset($materialType)): ?>
      <span class="search-filter">
        <?php echo render_title($materialType) ?>
        <?php $params = $sf_data->getRaw('sf_request')->getGetParameters() ?>
        <?php unset($params['materialType']) ?>
        <a href="<?php echo url_for(array('module' => 'informationobject', 'action' => 'browse') + $params) ?>" class="remove-filter"><i class="fa fa-times"></i></a>
      </span>
    <?php endif; ?>

    <?php if (isset($sf_request->onlyMedia)): ?>
      <span class="search-filter">
        <?php if (filter_var($sf_request->onlyMedia, FILTER_VALIDATE_BOOLEAN)): ?>
          <?php echo __('With digital objects') ?>
        <?php else: ?>
          <?php echo __('Without digital objects') ?>
        <?php endif; ?>
        <?php $params = $sf_data->getRaw('sf_request')->getGetParameters() ?>
        <?php unset($params['onlyMedia']) ?>
        <a href="<?php echo url_for(array('module' => 'informationobject', 'action' => 'browse') + $params) ?>" class="remove-filter"><i class="fa fa-times"></i></a>
      </span>
    <?php endif; ?>

    <?php if ($topLod): ?>
      <span class="search-filter">
        <?php echo __('Only top-level descriptions') ?>
        <?php $params = $sf_data->getRaw('sf_request')->getGetParameters() ?>
        <?php $params['topLod'] = 0 ?>
        <a href="<?php echo url_for(array('module' => 'informationobject', 'action' => 'browse') + $params) ?>" class="remove-filter"><i class="fa fa-times"></i></a>
      </span>
    <?php endif; ?>

    <?php if (isset($sf_request->languages)): ?>
      <span class="search-filter">
        <?php echo ucfirst(sfCultureInfo::getInstance($sf_user->getCulture())->getLanguage($sf_request->languages)) ?>
        <?php $params = $sf_data->getRaw('sf_request')->getGetParameters() ?>
        <?php unset($params['languages']) ?>
        <a href="<?php echo url_for(array('module' => 'informationobject', 'action' => 'browse') + $params) ?>" class="remove-filter"><i class="fa fa-times"></i></a>
      </span>
    <?php endif; ?>

    <?php if (isset($dateRange)): ?>
      <span class="search-filter">
        <?php echo $dateRange ?>
        <?php $params = $sf_data->getRaw('sf_request')->getGetParameters() ?>
        <?php unset($params['startDate']) ?>
        <?php unset($params['endDate']) ?>
        <a href="<?php echo url_for(array('module' => 'informationobject', 'action' => 'browse') + $params) ?>" class="remove-filter"><i class="fa fa-times"></i></a>
      </span>
    <?php endif; ?>

    <?php if (isset($findingAidStatusTag)): ?>
      <span class="search-filter">
        <?php echo render_value_inline($findingAidStatusTag) ?>
        <?php $params = $sf_data->getRaw('sf_request')->getGetParameters() ?>
        <?php unset($params['findingAidStatus']) ?>
        <a href="<?php echo url_for(array('module' => 'informationobject', 'action' => 'browse') + $params) ?>" class="remove-filter"><i class="fa fa-times"></i></a>
      </span>
    <?php endif; ?>

    <?php if (isset($ancestor)): ?>
      <span class="search-filter">
        <?php echo render_title($ancestor) ?>
        <?php $params = $sf_data->getRaw('sf_request')->getGetParameters() ?>
        <?php unset($params['ancestor']) ?>
        <a href="<?php echo url_for(array('module' => 'informationobject', 'action' => 'browse') + $params) ?>" class="remove-filter"><i class="fa fa-times"></i></a>
      </span>
    <?php endif; ?>
  </section>

<?php end_slot() ?>

<?php slot('content') ?>

  <?php echo get_partial('search/advancedSearch', array(
    'criteria'     => $search->criteria,
    'template'     => $template,
    'form'         => $form,
    'show'         => $showAdvanced,
    'topLod'       => $topLod,
    'rangeType'    => $rangeType,
    'hiddenFields' => $hiddenFields)) ?>

  <?php if (isset($pager) && $pager->getNbResults()): ?>

    <section class="browse-options">
      <?php echo get_partial('default/printPreviewButton') ?>

      <?php if (sfConfig::get('app_treeview_show_browse_hierarchy_page', 'no') === 'yes'): ?>
        <a href="<?php echo url_for(array('module' => 'browse', 'action' => 'hierarchy')) ?>">
          <i class="fa fa-sitemap"></i>
          Hierarchy
        </a>
      <?php endif; ?>

      <?php if ($sf_user->isAuthenticated()): ?>
        <a href="<?php echo url_for(array_merge($sf_data->getRaw('sf_request')->getParameterHolder()->getAll(), array('module' => 'informationobject', 'action' => 'exportCsv'))) ?>">
          <i class="fa fa-upload"></i>
          <?php echo __('Export CSV') ?>
        </a>
      <?php endif; ?>

      <span>
        <?php echo get_partial('default/viewPicker', array('view' => $view, 'cardView' => $cardView,
          'tableView' => $tableView, 'module' => 'informationobject')) ?>
      </span>

      <div class="pickers">
        <?php echo get_partial('default/sortPickers', array(
          'options' => array(
            'lastUpdated'   => __('Date modified'),
            'alphabetic'    => __('Title'),
            'relevance'     => __('Relevance'),
            'identifier'    => __('Identifier'),
            'referenceCode' => __('Reference code'),
            'startDate'     => __('Start date'),
            'endDate'       => __('End date')))) ?>
      </div>
    </section>

    <div id="content" class="browse-content">
      <?php if (!isset($sf_request->onlyMedia) && isset($aggs['digitalobjects']) && 0 < $aggs['digitalobjects']['doc_count']): ?>
        <div class="search-result media-summary">
          <p>
            <?php echo __('%1% results with digital objects', array(
              '%1%' => $aggs['digitalobjects']['doc_count'])) ?>
            <?php $params = $sf_data->getRaw('sf_request')->getGetParameters() ?>
            <?php unset($params['page']) ?>
            <a href="<?php echo url_for(array('module' => 'informationobject', 'action' => 'browse') + $params + array('onlyMedia' => true)) ?>">
              <i class="fa fa-search"></i>
              <?php echo __('Show results with digital objects') ?>
            </a>
          </p>
        </div>
      <?php endif; ?>

      <?php if ($view === $tableView): ?>
        <?php echo get_partial('informationobject/tableViewResults', array('pager' => $pager, 'selectedCulture' => $selectedCulture)) ?>
      <?php elseif ($view === $cardView): ?>
        <?php echo get_partial('informationobject/cardViewResults', array('pager' => $pager, 'selectedCulture' => $selectedCulture)) ?>
      <?php endif; ?>
    </div>

  <?php endif; ?>

<?php end_slot() ?>

<?php if (isset($pager)): ?>
  <?php slot('after-content') ?>
    <?php echo get_partial('default/pager', array('pager' => $pager)) ?>
  <?php end_slot() ?>
<?php endif; ?>
