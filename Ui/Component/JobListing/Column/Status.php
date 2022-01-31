<?php

declare(strict_types=1);

namespace Akeneo\Connector\Ui\Component\JobListing\Column;

use Akeneo\Connector\Api\Data\JobInterface;
use Magento\Ui\Component\Listing\Columns\Column;

/**
 * Class Status
 *
 * @package   Akeneo\Connector\Ui\Component\AkeneoJobListing\Column
 * @author    Agence Dn'D <contact@dnd.fr>
 * @copyright 2004-present Agence Dn'D
 * @license   https://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://www.dnd.fr/
 */
class Status extends Column
{
    /**
     * Description prepareDataSource function
     *
     * @param mixed[][] $dataSource
     *
     * @return mixed[][]
     */
    public function prepareDataSource(array $dataSource): array {

        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                $item['raw_status'] = $item['status'];
                $item['status'] = $this->getLabel($item['status']);
            }
        }

        return $dataSource;
    }

    /**
     * Description getLabel function
     *
     * @param string $status
     *
     * @return string
     */
    private function getLabel(string $status): string
    {
        /** @var string $class */
        $class = '';
        /** @var string $text */
        $text = '';
        switch ($status) {
            case JobInterface::JOB_SUCCESS:
                $class = 'grid-severity-notice';
                $text  = __('Success');
                break;
            case JobInterface::JOB_ERROR:
                $class = 'grid-severity-critical';
                $text  = __('Error');
                break;
            case JobInterface::JOB_PROCESSING:
                $class = 'grid-severity-processing';
                $text  = __('Processing');
                break;
            case JobInterface::JOB_PENDING:
                $class = 'grid-severity-pending';
                $text  = __('Pending');
                break;
            case JobInterface::JOB_SCHEDULED:
                $class = 'grid-severity-minor';
                $text  = __('Scheduled');
                break;
        }

        return '<span class="' . $class . '"><span>' . $text . '</span></span>';
    }
}
