<?php
// 代码生成时间: 2025-10-07 01:39:20
class TextSummaryGenerator
{
    private $text;
    private $summary;
    private $wordsCount;

    /**
     * Constructor for the TextSummaryGenerator class.
     *
     * @param string $text The text to be summarized.
     */
    public function __construct($text)
    {
        $this->text = $text;
        $this->wordsCount = $this->countWords($text);
    }

    /**
     * Count the number of words in the text.
     *
     * @param string $text The text to count words from.
     * @return int The number of words in the text.
     */
    private function countWords($text)
    {
        return str_word_count($text);
    }

    /**
     * Generate a summary of the text.
     *
     * @param int $summaryLength The desired length of the summary in words.
     * @return string The generated summary.
     * @throws Exception If the summary length is not a positive integer.
     */
    public function generateSummary($summaryLength)
    {
        if (!is_int($summaryLength) || $summaryLength <= 0) {
            throw new Exception("Summary length must be a positive integer.");
        }

        $summary = '';
        $wordCount = 0;
        $words = explode(' ', $this->text);

        foreach ($words as $word) {
            $summary .= $word . ' ';
            $wordCount++;
            if ($wordCount == $summaryLength) {
                break;
            }
        }

        return rtrim($summary); // Remove trailing space
    }
}

// Example usage:
try {
    $text = "This is a sample text that we want to summarize.";
    $summaryGenerator = new TextSummaryGenerator($text);
    $summary = $summaryGenerator->generateSummary(5);
    echo "Summary: " . $summary;
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
