<?php

declare(strict_types=1);

namespace App\Storage\Page;

use Illuminate\Support\Carbon;
use Simpledynamic\Base\Model\Model;
use stdClass;

/**
 * Модель сущности "Страница"
 *
 * @property ?int        $id
 * @property int         $userId
 * @property int|null    $pageId
 * @property string      $title
 * @property string|null $description
 * @property array|null  $layout
 * @property Carbon|null $earlyDatedAt
 * @property Carbon|null $lateDatedAt
 * @property ?Carbon     $createdAt
 * @property ?Carbon     $updatedAt
 */
class PageModel extends Model
{
    public protected(set) ?int $id;

    public int $userId;

    public ?int $pageId;

    public string $title;

    public ?string $description;

    public ?array $layout;

    public ?Carbon $earlyDatedAt;

    public ?Carbon $lateDatedAt;

    public protected(set) ?Carbon $createdAt;

    public protected(set) ?Carbon $updatedAt;

    /**
     * @param stdClass|array{
     *     id?:             int,
     *     user_id:         int,
     *     page_id?:        ?int,
     *     title:           string,
     *     description?:    ?string,
     *     layout?:         ?array|string,
     *     early_dated_at?: ?string,
     *     late_dated_at?:  ?string,
     *     created_at?:     string,
     *     updated_at?:     string,
     * } $attributes
     */
    public function __construct(stdClass|array $attributes)
    {
        if ($attributes instanceof stdClass) {
            /**
             * @var array{
             *     id?:             int,
             *     user_id:         int,
             *     page_id?:        ?int,
             *     title:           string,
             *     description?:    ?string,
             *     layout?:         ?array|string,
             *     early_dated_at?: ?string,
             *     late_dated_at?:  ?string,
             *     created_at?:     string,
             *     updated_at?:     string,
             * } $attributes
             */
            $attributes = (array) $attributes;
        }

        $this->id           = $attributes['id'] ?? null;
        $this->userId       = $attributes['user_id'];
        $this->pageId       = $attributes['page_id'] ?? null;
        $this->title        = $attributes['title'];
        $this->description  = $attributes['description'] ?? null;
        $this->layout       = isset($attributes['layout'])
            ? match (true) {
                is_array($attributes['layout'])                                          => $attributes['layout'],
                is_string($attributes['layout']) && json_validate($attributes['layout']) => (array) json_decode($attributes['layout']),
                default                                                                  => [],
            }
        : [];
        $this->earlyDatedAt = Carbon::parse($attributes['early_dated_at'] ?? null);
        $this->lateDatedAt  = Carbon::parse($attributes['late_dated_at'] ?? null);
        $this->createdAt    = Carbon::parse($attributes['created_at'] ?? null);
        $this->updatedAt    = Carbon::parse($attributes['updated_at'] ?? null);
    }
}
