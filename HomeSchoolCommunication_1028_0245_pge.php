<?php
// 代码生成时间: 2025-10-28 02:45:48
class HomeSchoolCommunication {

    /**
     * @var array The messages to be sent or received.
     */
    private $messages = [];

    /**
     * Send a message to the school.
     *
     * @param string $message The message to be sent.
     * @return bool Returns true on success, false on failure.
     */
    public function sendMessage($message) {
        try {
            // Validate the message
            if (empty($message)) {
                throw new Exception('Message cannot be empty.');
            }

            // Simulate sending the message
            $this->messages[] = $message;

            return true;
        } catch (Exception $e) {
            // Handle errors
            // Log error or display error message to user
            // For simplicity, we'll just return false
            return false;
        }
    }

    /**
     * Receive messages from the school.
     *
     * @return array Returns an array of messages.
     */
    public function receiveMessages() {
        // Check if there are any messages
        if (empty($this->messages)) {
            return [];
        }

        // Return a copy of the messages to prevent modification
        return $this->messages;
    }

    /**
     * Clear all messages.
     *
     * @return void
     */
    public function clearMessages() {
        $this->messages = [];
    }
}
