<table class="table table-striped no-margin">

    <thead>
        <tr>
            <th style="width: 90%;"><?php echo lang('patient'); ?></th>
            <th style="width: 10%;"><?php echo lang('options'); ?></th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($user_patients as $user_patient) { ?>
        <tr>
            <td><?php echo $user_patient->patient_name; ?></td>
            <td>
                <?php if ($id) { ?>
                <a class="" href="<?php echo site_url('users/delete_user_client/' . $id . '/' . $user_patient->user_patient_id); ?>">
                    <i class="icon-remove"></i>
                </a>
                <?php } ?>
            </td>
        </tr>
        <?php } ?>
    </tbody>

</table>