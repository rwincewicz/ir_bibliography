<?php
/**
 * This function alters the scholar record form to include functionality
 * for islandora_bookmark
 *
 * @param array $form_state
 * @param array $form
 * @param string $form_id
 *
 * @todo
 *
 * @return drupal form array
 *
 */
function scholar_record_form_alter(&$form, &$form_state, $form_id) {

    $form['#tree'] == TRUE;

    $form['pid'] = array(
        '#type' => 'hidden',
        '#value' => $pid,
    );

    if(islandora_bookmark_pid_find($pid) == FALSE) {
        $form['citation_do'] = array(
            '#type' => 'textfield',
            '#value' => 'add',
        );

        $form['submit'] = array(
            '#type' => 'submit',
            '#value' => t('Add'),
        );
    }
    else {
        $form['citation_do'] = array(
            '#type' => 'hidden',
            '#value' => 'remove',
        );

        $form['submit'] = array(
            '#type' => 'submit',
            '#value' => t('Remove ' . $pid),
        );
    }

    $form['#redirect'] = MENU_SCHOLAR_RECORD . $pid;
    return $form;

}

/**
 * This function renders the drupal form on the scholar record based on user permissions
 *
 * @param string $pid
 *
 * @todo
 *
 * @return rendered drupal form
 */
function islandora_bookmark_scholar_page($pid) {
    if(user_access(PERM_ISLANDORA_BOOKMARK_CREATE)) {
        $form = drupal_get_form('islandora_bookmark_citation_form', $pid);
        //var_dump($form);
        return $form;//$form;
    }

}


/**
 * This function renders the drupal form on the scholar record based on user permissions
 *
 * @param string $pid
 *
 * @todo
 *
 * @return
 */
function islandora_bookmark_citation_form_sumbit($form_id, $form) {
    drupal_set_message('testing...');
}
