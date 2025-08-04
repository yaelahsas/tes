<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dayun - Chat Application</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#3B82F6',
                        secondary: '#10B981',
                        accent: '#F59E0B',
                        danger: '#EF4444'
                    }
                }
            }
        };
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100 h-screen overflow-hidden">
    <!-- Splash Screen -->
    <div id="splashScreen" class="fixed inset-0 z-50 bg-white">
        <!-- Image Only Container -->
        <div class="w-full h-full flex items-center justify-center">
            <img src="<?= base_url('gambar/dayun.png') ?>" alt="Dayun AI Assistant" 
                 class="max-w-full max-h-full w-auto h-auto object-contain"
                 style="max-height: 90vh; max-width: 90vw;">
        </div>
    </div>

    <!-- Main Chat Interface -->
    <div id="chatInterface" class="hidden flex flex-col h-full max-w-md mx-auto bg-white shadow-lg">
        <!-- Header -->
        <div class="bg-primary text-white p-4 flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                    <i class="fas fa-comments text-lg"></i>
                </div>
                <div>
                    <h1 class="text-lg font-semibold">Dayun Chat</h1>
                    <p class="text-sm text-blue-100">RSUD Genteng</p>
                </div>
            </div>
            <div class="flex items-center space-x-2">
                <div class="w-3 h-3 bg-secondary rounded-full animate-pulse"></div>
                <span class="text-sm">Online</span>
            </div>
        </div>

        <!-- Chat Messages Container -->
        <div id="chatContainer" class="flex-1 overflow-y-auto p-4 space-y-4 bg-gray-50">
            <!-- Welcome Message -->
            <div class="flex justify-center">
                <div class="bg-blue-100 text-blue-800 px-4 py-2 rounded-full text-sm">
                    Selamat datang di Dayun Chat! 🤖
                </div>
            </div>
            
            <!-- Sample Messages -->
            <div class="flex justify-start">
                <div class="max-w-xs lg:max-w-md">
                    <div class="bg-white rounded-lg shadow-sm p-3 border">
                        <div class="text-gray-800">Halo! Saya <strong>Dayun</strong> AI Assistant RSUD Genteng. Ada yang bisa saya bantu mengenai informasi rumah sakit?</div>
                        <div class="flex items-center justify-between mt-2">
                            <span class="text-xs text-gray-500">AI Assistant</span>
                            <span class="text-xs text-gray-400">10:30</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Message Input -->
        <div class="bg-white border-t border-gray-200 p-4">
            <form id="chatForm" class="flex items-center space-x-3">
                <div class="flex-1 relative">
                    <input 
                        type="text" 
                        id="messageInput" 
                        placeholder="Ketik pesan Anda..." 
                        class="w-full px-4 py-3 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                        required
                    >
                    <button 
                        type="button" 
                        id="emojiBtn"
                        class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600"
                    >
                        <i class="far fa-smile"></i>
                    </button>
                </div>
                <button 
                    type="submit" 
                    id="sendBtn"
                    class="bg-primary text-white p-3 rounded-full hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 transition-colors duration-200"
                >
                    <i class="fas fa-paper-plane"></i>
                </button>
            </form>
        </div>

    </div>

    <!-- Loading Overlay -->
    <div id="loadingOverlay" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 flex items-center space-x-3">
            <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-primary"></div>
            <span class="text-gray-700">Mengirim pesan...</span>
        </div>
    </div>

    <script>
        class DayunChat {
            constructor() {
                this.chatContainer = document.getElementById('chatContainer');
                this.messageInput = document.getElementById('messageInput');
                this.chatForm = document.getElementById('chatForm');
                this.sendBtn = document.getElementById('sendBtn');
                this.typingIndicator = null; // Will be created dynamically
                this.loadingOverlay = document.getElementById('loadingOverlay');
                this.webhookUrl = 'https://n8n.rsudgenteng.id/webhook/get-whatsapp';
                
                this.init();
            }

            init() {
                this.chatForm.addEventListener('submit', (e) => this.handleSubmit(e));
                this.messageInput.addEventListener('keypress', (e) => {
                    if (e.key === 'Enter' && !e.shiftKey) {
                        e.preventDefault();
                        this.handleSubmit(e);
                    }
                });
                
                // Auto-scroll to bottom
                this.scrollToBottom();
            }

            async handleSubmit(e) {
                e.preventDefault();
                
                const message = this.messageInput.value.trim();
                if (!message) return;

                // Add user message to chat immediately
                this.addMessage(message, 'user');
                this.messageInput.value = '';
                
                // Show typing indicator immediately (no loading overlay)
                this.showTypingIndicator(true);

                try {
                    // Send to n8n webhook (no artificial delay)
                    const response = await this.sendToWebhook(message);
                    
                    // Hide typing indicator and show response immediately
                    this.showTypingIndicator(false);
                    
                    if (response && response.message) {
                        this.addMessage(response.message, 'admin');
                    } else {
                        this.addMessage('Terima kasih atas pesan Anda. Tim kami akan segera merespons.', 'admin');
                    }
                    
                } catch (error) {
                    console.error('Error sending message:', error);
                    
                    // Hide typing indicator
                    this.showTypingIndicator(false);
                    
                    // Show user-friendly error message
                    let errorMessage = 'Maaf, terjadi kesalahan saat mengirim pesan.';
                    if (error.message.includes('Failed to fetch')) {
                        errorMessage = 'Tidak dapat terhubung ke server. Periksa koneksi internet Anda.';
                    } else if (error.message.includes('HTTP error')) {
                        errorMessage = 'Server sedang mengalami gangguan. Silakan coba lagi nanti.';
                    } else if (error.message.includes('timeout')) {
                        errorMessage = 'Response terlalu lama. Server mungkin sedang sibuk.';
                    }
                    
                    this.addMessage(errorMessage + ' Silakan coba lagi.', 'system');
                }
            }

            async sendToWebhook(message) {
                // Generate random ID
                const randomId = 'dayun_' + Math.random().toString(36).substr(2, 9) + '_' + Date.now();
                
                const payload = {
                    id: randomId,
                    message: message
                };

                console.log('Sending to webhook:', this.webhookUrl, payload);

                try {
                    const controller = new AbortController();
                    const timeoutId = setTimeout(() => controller.abort(), 15000); // 5 second timeout for better UX

                    const response = await fetch(this.webhookUrl, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json, text/plain, */*'
                        },
                        body: JSON.stringify(payload),
                        signal: controller.signal
                    });

                    clearTimeout(timeoutId);

                    console.log('Webhook response status:', response.status);
                    console.log('Webhook response headers:', Object.fromEntries(response.headers.entries()));

                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }

                    // Get response text first
                    const responseText = await response.text();
                    console.log('Webhook response text:', responseText);
                    
                    // If response is empty, return success
                    if (!responseText || responseText.trim() === '') {
                        return { success: true, message: 'Pesan berhasil dikirim ke tim RSUD Genteng' };
                    }
                    
                    // Try to parse as JSON
                    const contentType = response.headers.get('content-type') || '';
                    if (contentType.includes('application/json')) {
                        try {
                            const jsonResponse = JSON.parse(responseText);
                            console.log('Parsed JSON response:', jsonResponse);
                            
                            // Check if response is array with output property
                            if (Array.isArray(jsonResponse) && jsonResponse.length > 0 && jsonResponse[0].output) {
                                return { success: true, message: jsonResponse[0].output };
                            }
                            // Check if response has output property directly
                            else if (jsonResponse.output) {
                                return { success: true, message: jsonResponse.output };
                            }
                            // Check if response has message property
                            else if (jsonResponse.message) {
                                return { success: true, message: jsonResponse.message };
                            }
                            // Fallback to default message
                            else {
                                return { success: true, message: 'Pesan berhasil dikirim ke tim RSUD Genteng' };
                            }
                        } catch (jsonError) {
                            console.warn('Failed to parse JSON response:', jsonError);
                            return { success: true, message: 'Pesan berhasil dikirim ke tim RSUD Genteng' };
                        }
                    } else {
                        // Return success with custom message
                        return { success: true, message: 'Pesan berhasil dikirim ke tim RSUD Genteng' };
                    }
                } catch (error) {
                    console.error('Webhook error details:', error);
                    
                    if (error.name === 'AbortError') {
                        throw new Error('Request timeout - server tidak merespons');
                    }
                    
                    throw error;
                }
            }

            addMessage(message, sender) {
                const messageDiv = document.createElement('div');
                const now = new Date();
                const timeString = now.toLocaleTimeString('id-ID', { 
                    hour: '2-digit', 
                    minute: '2-digit' 
                });

                if (sender === 'user') {
                    messageDiv.className = 'flex justify-end';
                    messageDiv.innerHTML = `
                        <div class="max-w-xs lg:max-w-md">
                            <div class="bg-primary text-white rounded-lg shadow-sm p-3">
                                <p>${this.escapeHtml(message)}</p>
                                <div class="flex items-center justify-between mt-2">
                                    <span class="text-xs text-blue-100">Anda</span>
                                    <span class="text-xs text-blue-200">${timeString}</span>
                                </div>
                            </div>
                        </div>
                    `;
                } else if (sender === 'admin') {
                    messageDiv.className = 'flex justify-start';
                    messageDiv.innerHTML = `
                        <div class="max-w-xs lg:max-w-md">
                            <div class="bg-white rounded-lg shadow-sm p-3 border">
                                <div class="text-gray-800">${this.formatMessage(message)}</div>
                                <div class="flex items-center justify-between mt-2">
                                    <span class="text-xs text-gray-500">AI Assistant</span>
                                    <span class="text-xs text-gray-400">${timeString}</span>
                                </div>
                            </div>
                        </div>
                    `;
                } else {
                    messageDiv.className = 'flex justify-center';
                    messageDiv.innerHTML = `
                        <div class="bg-red-100 text-red-800 px-4 py-2 rounded-full text-sm">
                            ${this.escapeHtml(message)}
                        </div>
                    `;
                }

                this.chatContainer.appendChild(messageDiv);
                this.scrollToBottom();
            }

            showLoading(show) {
                this.loadingOverlay.classList.toggle('hidden', !show);
            }

            showTypingIndicator(show) {
                if (show) {
                    // Create typing indicator if it doesn't exist
                    if (!this.typingIndicator) {
                        this.typingIndicator = document.createElement('div');
                        this.typingIndicator.className = 'flex justify-start typing-indicator';
                        this.typingIndicator.innerHTML = `
                            <div class="max-w-xs lg:max-w-md">
                                <div class="bg-white rounded-lg shadow-sm p-3 border">
                                    <div class="flex items-center space-x-3">
                                        <div class="flex space-x-1">
                                            <div class="w-2 h-2 bg-primary rounded-full animate-bounce"></div>
                                            <div class="w-2 h-2 bg-primary rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
                                            <div class="w-2 h-2 bg-primary rounded-full animate-bounce" style="animation-delay: 0.4s"></div>
                                        </div>
                                        <span class="text-sm text-gray-500">AI Assistant sedang mengetik...</span>
                                    </div>
                                    <div class="flex items-center justify-between mt-2">
                                        <span class="text-xs text-gray-500">AI Assistant</span>
                                        <span class="text-xs text-gray-400">...</span>
                                    </div>
                                </div>
                            </div>
                        `;
                    }
                    
                    // Add to chat container
                    this.chatContainer.appendChild(this.typingIndicator);
                    this.scrollToBottom();
                } else {
                    // Remove typing indicator from chat
                    if (this.typingIndicator && this.typingIndicator.parentNode) {
                        this.typingIndicator.parentNode.removeChild(this.typingIndicator);
                    }
                }
            }

            scrollToBottom() {
                setTimeout(() => {
                    this.chatContainer.scrollTop = this.chatContainer.scrollHeight;
                }, 100);
            }

            escapeHtml(text) {
                const div = document.createElement('div');
                div.textContent = text;
                return div.innerHTML;
            }

            formatMessage(text) {
                // Convert markdown-like formatting to HTML
                let formatted = text
                    // Bold text **text** to <strong>text</strong>
                    .replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>')
                    // Bullet points * item to • item
                    .replace(/^\*\s+(.+)$/gm, '• $1')
                    // Line breaks
                    .replace(/\n/g, '<br>');
                
                return formatted;
            }
        }

        // Initialize chat when DOM is loaded
        document.addEventListener('DOMContentLoaded', () => {
            // Show splash screen for 3 seconds
            setTimeout(() => {
                // Hide splash screen with fade effect
                const splashScreen = document.getElementById('splashScreen');
                const chatInterface = document.getElementById('chatInterface');
                
                splashScreen.style.opacity = '0';
                splashScreen.style.transition = 'opacity 0.5s ease-out';
                
                setTimeout(() => {
                    splashScreen.classList.add('hidden');
                    chatInterface.classList.remove('hidden');
                    
                    // Initialize chat after interface is shown
                    new DayunChat();
                }, 500);
            }, 3000);
        });
    </script>
</body>
</html>
