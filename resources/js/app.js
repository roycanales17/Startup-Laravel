import './bootstrap';

import Prism from 'prismjs';

// Core language deps
import 'prismjs/components/prism-markup';
import 'prismjs/components/prism-markup-templating';
import 'prismjs/components/prism-php';

// Extra languages
import 'prismjs/components/prism-javascript';
import 'prismjs/components/prism-css';
import 'prismjs/components/prism-bash';

// Plugins
import 'prismjs/plugins/toolbar/prism-toolbar';
import 'prismjs/plugins/copy-to-clipboard/prism-copy-to-clipboard';

// Theme
import 'prismjs/themes/prism-tomorrow.css';

window.Prism = Prism;

document.addEventListener('DOMContentLoaded', () => {
    Prism.highlightAll();
});

document.addEventListener('livewire:navigated', () => {
    Prism.highlightAll();
});
