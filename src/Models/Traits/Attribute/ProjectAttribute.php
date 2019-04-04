<?php

namespace Csteamengine\ProjectManager\Models\Traits\Attribute;

/**
 * Trait ProjectAttribute.
 */
trait ProjectAttribute
{

    /**
     * @return string
     */
    public function getStatusLabelAttribute()
    {
        if ($this->isActive()) {
            return "<span class='badge badge-success'>".__('labels.general.active').'</span>';
        }

        return "<span class='badge badge-danger'>".__('labels.general.inactive').'</span>';
    }

    /**
     * @return string
     */
    public function getShowButtonAttribute()
    {
        return '<a href="'.route('frontend.projects.show', $this).'" target="_blank" data-toggle="tooltip" data-placement="top" title="'.__('buttons.general.crud.show').'" class="btn btn-success"><i class="fas fa-eye"></i></a>';
    }

    /**
     * @return string
     */
    public function getEditButtonAttribute()
    {
        return '<a href="'.route('admin.projects.edit', $this).'" data-toggle="tooltip" data-placement="top" title="'.__('buttons.general.crud.edit').'" class="btn btn-primary"><i class="fas fa-edit"></i></a>';
    }

    /**
     * @return string
     */
    public function getDeleteButtonAttribute()
    {
        return '<a href="'.route('admin.projects.destroy', $this).'" 
            data-toggle="tooltip" 
            data-method="delete"
            data-trans-button-cancel="'.__('buttons.general.cancel').'"
            data-trans-button-confirm="'.__('buttons.general.crud.delete').'"
            data-trans-title="'.__('strings.backend.general.are_you_sure').'"
            data-placement="top" 
            title="'.__('buttons.general.crud.delete').'" 
            class="btn btn-danger"><i class="fas fa-trash"></i></a>';

    }

    /**
     * @return string
     */
    public function getDeletePermanentlyButtonAttribute()
    {
        return '<a href="'.route('admin.projects.delete-permanently', $this).'" name="confirm_item" class="btn btn-danger"><i class="fas fa-trash" data-toggle="tooltip" data-placement="top" title="'.__('buttons.backend.access.users.delete_permanently').'"></i></a> ';
    }

    /**
     * @return string
     */
    public function getRestoreButtonAttribute()
    {
        return '<a href="'.route('admin.projects.restore', $this).'" name="confirm_item" class="btn btn-info"><i class="fas fa-sync" data-toggle="tooltip" data-placement="top" title="'.__('buttons.backend.access.projects.restore_project').'"></i></a> ';
    }

    /**
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        if ($this->trashed()) {
            return '
				<div class="btn-group" role="group" aria-label="'.__('labels.backend.access.projects.project_actions').'">
				  '.$this->restore_button.'
				  '.$this->delete_permanently_button.'
				</div>';
        }

        return '
    	<div class="btn-group" role="group" aria-label="'.__('labels.backend.access.projects.project_actions').'">
		  '.$this->edit_button.'
		  '.$this->show_button.'
          '.$this->delete_button.'
		</div>';
    }
}
