<?php

declare(strict_types=1);

namespace NeonWebId\Layouts;

use NeonWebId\Common\Abstracts\RenderAbstract;

use function ob_start;

class Section extends RenderAbstract
{
    private string $id = '';

    private string $title = '';

    private string $icon = '';

    private string $description = '';

    private array $headerActions = [];

    private array $footerActions = [];

    private bool $collapsible = false;

    private bool $collapsed = false;

    private bool $aside = false;

    private function __construct(string $title = '')
    {
        $this->title = $title;
    }

    public static function make(string $title = ''): self
    {
        return new self($title);
    }

    public function id(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function title(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function icon(string $icon): self
    {
        $this->icon = $icon;
        return $this;
    }

    public function description(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function headerActions(array $headerActions): self
    {
        $this->headerActions = $headerActions;
        return $this;
    }

    public function footerActions(array $footerActions): self
    {
        $this->footerActions = $footerActions;
        return $this;
    }

    public function collapsible(): self
    {
        $this->collapsible = true;
        return $this;
    }

    public function collapsed(): self
    {
        $this->collapsed = true;
        return $this;
    }

    public function aside(): self
    {
        $this->aside = true;
        return $this;
    }

    public function render(): string
    {
        ob_start();
        ?>
        <section class="section">
            <header class="section-header">
                <h2 class="section-title"><?= $this->title ?></h2>
                <?php if ($this->icon): ?>
                    <i class="section-icon <?= $this->icon ?>"></i>
                <?php endif; ?>
                <?php if ($this->description): ?>
                    <p class="section-description"><?= $this->description ?></p>
                <?php endif; ?>
                <?php if ($this->headerActions): ?>
                    <div class="section-actions">
                        <?php foreach ($this->headerActions as $action): ?>
                            <?= $action ?>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                <?php if ($this->collapsible): ?>
                    <button class="section-toggle" aria-expanded="<?= $this->collapsed ? 'false' : 'true' ?>">
                        <i class="section-toggle-icon"></i>
                    </button>
                <?php endif; ?>
            </header>
            <?php if ($content = parent::render()) : ?>
                <div class="section-content">
                    <?= $content ?>
                </div>
            <?php endif; ?>
            <?php if ($this->footerActions): ?>
                <footer class="section-footer">
                    <?php foreach ($this->footerActions as $action): ?>
                        <?= $action ?>
                    <?php endforeach; ?>
                </footer>
            <?php endif; ?>
        </section>
        <?php
        return ob_get_clean();
    }
}