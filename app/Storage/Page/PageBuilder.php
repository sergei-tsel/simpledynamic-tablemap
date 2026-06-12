<?php

declare(strict_types=1);

namespace App\Storage\Page;

use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Collection;
use Simpledynamic\Base\Model\Builder;
use stdClass;

/**
 * Билдер сущности "Страница"
 */
class PageBuilder extends Builder
{
    public function __construct(
        private readonly DatabaseManager $manager,
    ) {
    }

    /**
     * Найти страницу
     */
    public function find(?int $pageId = null): ?stdClass
    {
        if ($pageId === null) {
            return null;
        }

        $param = [];

        $param['page_id'] = $pageId;

        return $this->manager->query()
            ->from('pages')
            ->where($param)
            ->first();
    }

    /**
     * Найти страницы
     *
     * @param int[] $pageIds
     */
    public function findMany(array $pageIds = [], ?int $userId = null): Collection
    {
        if ($pageIds === [] && $userId === null) {
            return new Collection();
        }

        $query = $this->manager->query()
            ->from('pages');

        if ($pageIds !== []) {
            $query = $query->whereIn('page_id', $pageIds);
        }

        if ($userId !== null) {
            $query = $query->where('user_id', $userId);
        }

        return $query->get();
    }

    /**
     * Создать страницу
     */
    public function create(array $page): int
    {
        return $this->manager->query()->from('pages')->insertGetId([
            'user_id'        => $page['userId'],
            'page_id'        => $page['pageId'],
            'title'          => $page['title'],
            'description'    => $page['description'],
            'layout'         => $page['layout'],
            'early_dated_at' => $page['earlyDatedAt'],
            'late_dated_at'  => $page['lateDatedAt'],
        ]);
    }

    /**
     * Изменить страницу
     */
    public function update(array $page): void
    {
        $this->manager->query()->from('pages')->update([
            'user_id'        => $page['userId'],
            'page_id'        => $page['pageId'],
            'title'          => $page['title'],
            'description'    => $page['description'],
            'layout'         => $page['loyaut'],
            'early_dated_at' => $page['earlyDatedAt'],
            'late_dated_at'  => $page['lateDatedAt'],
        ]);
    }

    /**
     * Удалить страницу
     */
    public function delete(array $page): void
    {
        $this->manager->query()
            ->from('pages')
            ->where('id', $page['id'])
            ->delete();
    }
}
