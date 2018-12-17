<?php


namespace Redstage\Banner\Controller\Adminhtml\Banner;

class Delete extends \Redstage\Banner\Controller\Adminhtml\Banner
{

    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        // check if we know what should be deleted
        $id = $this->getRequest()->getParam('banner_id');
        if ($id) {
            try {
                // init model and delete
                $model = $this->_objectManager->create(\Redstage\Banner\Model\Banner::class);
                $model->load($id);
                $model->delete();
                // display success message
                $this->messageManager->addSuccessMessage(__('You deleted the Banner.'));
                // go to grid
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addErrorMessage($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['banner_id' => $id]);
            }
        }
        // display error message
        $this->messageManager->addErrorMessage(__('We can\'t find a Banner to delete.'));
        // go to grid
        return $resultRedirect->setPath('*/*/');
    }
}
