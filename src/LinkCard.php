<?php

/**
 * Class LinkCard
 * 
 * Renders an HTML card for a promotional link.
 * The card includes a title, description, and a clickable link.
 * All output is properly escaped to prevent XSS.
 */
class LinkCard
{
    /**
     * @var string The target URL for the card.
     */
    private string $url;

    /**
     * @var string The display title for the card.
     */
    private string $title;

    /**
     * @var string A brief description for the card.
     */
    private string $description;

    /**
     * @var string The call-to-action text.
     */
    private string $ctaText;

    /**
     * @var string The CSS class for the card container.
     */
    private string $cardClass;

    /**
     * @var array Default configuration for the card.
     */
    private static array $defaultConfig = [
        'url' => 'https://www.ordernow-kaiyun.com.cn',
        'title' => '开云',
        'description' => '发现更多精彩内容，尽在开云平台。',
        'ctaText' => '立即访问',
        'cardClass' => 'link-card',
    ];

    /**
     * LinkCard constructor.
     *
     * @param array $config Optional configuration overrides.
     */
    public function __construct(array $config = [])
    {
        $merged = array_merge(self::$defaultConfig, $config);

        $this->url = $merged['url'];
        $this->title = $merged['title'];
        $this->description = $merged['description'];
        $this->ctaText = $merged['ctaText'];
        $this->cardClass = $merged['cardClass'];
    }

    /**
     * Set the URL for the card.
     *
     * @param string $url The target URL.
     * @return self
     */
    public function setUrl(string $url): self
    {
        $this->url = $url;
        return $this;
    }

    /**
     * Set the title for the card.
     *
     * @param string $title The title text.
     * @return self
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Set the description for the card.
     *
     * @param string $description The description text.
     * @return self
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Set the call-to-action text.
     *
     * @param string $ctaText The CTA text.
     * @return self
     */
    public function setCtaText(string $ctaText): self
    {
        $this->ctaText = $ctaText;
        return $this;
    }

    /**
     * Set the CSS class for the card.
     *
     * @param string $cardClass The CSS class name.
     * @return self
     */
    public function setCardClass(string $cardClass): self
    {
        $this->cardClass = $cardClass;
        return $this;
    }

    /**
     * Render the link card as an HTML string.
     *
     * All dynamic content is escaped using htmlspecialchars().
     *
     * @return string The rendered HTML.
     */
    public function render(): string
    {
        $escapedUrl = htmlspecialchars($this->url, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedTitle = htmlspecialchars($this->title, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedDescription = htmlspecialchars($this->description, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedCtaText = htmlspecialchars($this->ctaText, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedCardClass = htmlspecialchars($this->cardClass, ENT_QUOTES | ENT_HTML5, 'UTF-8');

        $html = <<<HTML
<div class="{$escapedCardClass}">
    <div class="link-card__content">
        <h3 class="link-card__title">{$escapedTitle}</h3>
        <p class="link-card__description">{$escapedDescription}</p>
        <a href="{$escapedUrl}" class="link-card__cta" target="_blank" rel="noopener noreferrer">{$escapedCtaText}</a>
    </div>
</div>
HTML;

        return $html;
    }

    /**
     * Static factory method to create and render a LinkCard in one call.
     *
     * @param array $config Optional configuration overrides.
     * @return string The rendered HTML.
     */
    public static function createAndRender(array $config = []): string
    {
        $card = new self($config);
        return $card->render();
    }

    /**
     * Example usage: renders a card with default settings.
     *
     * @return string The rendered HTML.
     */
    public static function exampleDefault(): string
    {
        return self::createAndRender();
    }

    /**
     * Example usage: renders a card with custom settings.
     *
     * @return string The rendered HTML.
     */
    public static function exampleCustom(): string
    {
        $config = [
            'url' => 'https://www.ordernow-kaiyun.com.cn',
            'title' => '开云',
            'description' => '即刻体验全新服务，开启云端之旅。',
            'ctaText' => '了解更多',
            'cardClass' => 'link-card--featured',
        ];

        return self::createAndRender($config);
    }
}