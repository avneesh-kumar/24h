@php $uniqueId = uniqid('fm_'); @endphp
<div class="file-manager-component" data-on-select="{{ $onSelect ?? '' }}" data-start-dir="{{ $startDir ?? '/' }}" data-allow-multi="{{ $allowMulti ?? 'false' }}">
    <button type="button" class="bg-red-600 text-white px-4 py-2 rounded shadow file-manager-open-btn">
        <i class="fas fa-upload mr-2"></i> Upload / Select File
    </button>
    <div class="file-manager-modal fixed inset-0 bg-black/70 z-50 flex items-center justify-center hidden" id="file-manager-modal-root-{{ $uniqueId }}">
        <div class="bg-gray-900 dark:bg-gray-900 light:bg-white rounded-2xl p-8 w-full max-w-4xl relative file-manager-modal-content shadow-2xl border border-gray-700 dark:border-gray-700 light:border-gray-200 transition-colors duration-300">
            <div class="absolute top-4 right-4 flex gap-2 items-center z-10">
                <button id="file-manager-theme-toggle-{{ $uniqueId }}" class="bg-gray-700 dark:bg-gray-700 light:bg-gray-200 hover:bg-gray-600 dark:hover:bg-gray-600 light:hover:bg-gray-300 text-white dark:text-white light:text-gray-900 rounded-full p-2 shadow transition" title="Toggle dark/light mode">
                    <i class="fas fa-moon" id="file-manager-theme-dark-icon-{{ $uniqueId }}" style="display:none;"></i>
                    <i class="fas fa-sun" id="file-manager-theme-light-icon-{{ $uniqueId }}" style="display:none;"></i>
                </button>
                <button class="text-white hover:bg-red-600 hover:text-white rounded-full p-2 transition file-manager-close-btn bg-transparent"><i class="fas fa-times fa-lg"></i></button>
            </div>
            <h2 class="text-2xl font-bold text-white dark:text-white light:text-gray-900 mb-6 flex items-center gap-3"><i class="fas fa-folder-open text-red-400"></i> File Manager</h2>
            <div class="mb-6 flex flex-wrap gap-3 items-center bg-gray-800/80 p-4 rounded-xl shadow-inner">
                <form class="flex gap-2 items-center file-manager-upload-form" enctype="multipart/form-data">
                    <label class="flex items-center gap-2 cursor-pointer bg-gray-700 hover:bg-gray-600 text-white px-3 py-2 rounded-lg shadow transition">
                        <i class="fas fa-upload"></i> <span>Upload</span>
                        <input type="file" class="hidden file-manager-file-input" multiple>
                    </label>
                    <button class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg shadow transition" type="submit">Upload</button>
                </form>
                <form class="flex gap-2 items-center file-manager-url-form">
                    <input type="url" class="rounded-lg px-3 py-2 text-black w-56 focus:ring-2 focus:ring-red-400 file-manager-url-input" placeholder="Paste image/file URL">
                    <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow transition" type="submit">From URL</button>
                </form>
                <form class="flex gap-2 items-center file-manager-folder-form">
                    <input type="text" class="rounded-lg px-3 py-2 text-black w-40 focus:ring-2 focus:ring-green-400 file-manager-folder-input" placeholder="New folder">
                    <button class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg shadow transition" type="submit">Create Folder</button>
                </form>
                <button class="ml-auto bg-gray-700 hover:bg-gray-600 text-white px-4 py-2 rounded-lg shadow file-manager-up-btn transition flex items-center gap-2"><i class="fas fa-level-up-alt"></i> Up</button>
            </div>
            <div class="file-manager-error bg-red-700/90 text-white rounded-lg p-3 mb-4 text-center font-semibold shadow hidden"></div>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-6 mb-6 file-manager-list min-h-[200px]">
                <!-- Folders and files will be rendered here by JS -->
            </div>
            <div class="flex justify-end gap-3 mt-4">
                <button class="bg-gray-700 hover:bg-gray-600 text-white px-5 py-2 rounded-lg shadow file-manager-cancel-btn transition">Cancel</button>
                <button class="bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded-lg shadow file-manager-select-btn transition font-bold">Select</button>
            </div>
            <!-- Preview Modal -->
            <div class="file-manager-preview-modal fixed inset-0 bg-black/80 z-50 hidden">
                <div class="flex items-center justify-center min-h-screen">
                    <div class="bg-gray-900 rounded-2xl p-8 max-w-lg w-full relative shadow-2xl border border-gray-700">
                        <button class="absolute top-4 right-4 text-white hover:bg-red-600 hover:text-white rounded-full p-2 transition file-manager-preview-close"><i class="fas fa-times fa-lg"></i></button>
                        <div class="file-manager-preview-content flex justify-center items-center min-h-[200px]"></div>
                        <div class="text-xs text-gray-400 mt-4 file-manager-preview-name text-center"></div>
                    </div>
                </div>
            </div>
            <!-- Rename Modal -->
            <div class="file-manager-rename-modal fixed inset-0 bg-black/80 z-50 hidden">
                <div class="flex items-center justify-center min-h-screen">
                    <div class="bg-gray-900 rounded-2xl p-8 max-w-xs w-full relative shadow-2xl border border-gray-700">
                        <button class="absolute top-4 right-4 text-white hover:bg-red-600 hover:text-white rounded-full p-2 transition file-manager-rename-close"><i class="fas fa-times fa-lg"></i></button>
                        <form class="file-manager-rename-form">
                            <div class="mb-4 text-white text-lg">Rename <span class="file-manager-rename-target font-bold"></span></div>
                            <input type="text" class="w-full rounded-lg px-3 py-2 text-black mb-4 focus:ring-2 focus:ring-blue-400 file-manager-rename-input" placeholder="New name">
                            <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg w-full shadow transition" type="submit">Rename</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
// FileManagerComponent: Plain JS implementation
(function(){
    const routeIndex = "{{ route('admin.filemanager.index') }}";
    const routeUpload = "{{ route('admin.filemanager.upload') }}";
    const routeUploadUrl = "{{ route('admin.filemanager.upload-url') }}";
    const routeCreateFolder = "{{ route('admin.filemanager.create-folder') }}";
    const routeRename = "{{ url('admin/filemanager/rename') }}";
    const routeDelete = "{{ url('admin/filemanager/delete') }}";
    const csrf = "{{ csrf_token() }}";
    // Helper: find closest parent with class
    function closest(el, cls) {
        while (el && !el.classList.contains(cls)) el = el.parentElement;
        return el;
    }
    // FileManager class
    class FileManager {
        constructor(root) {
            this.root = root;
            this.onSelect = window[root.dataset.onSelect] || null;
            this.currentDir = root.dataset.startDir || '/';
            this.allowMulti = root.dataset.allowMulti === 'true';
            this.selected = [];
            this.folders = [];
            this.files = [];
            this.error = '';
            // Elements
            this.openBtn = root.querySelector('.file-manager-open-btn');
            this.modal = root.querySelector('.file-manager-modal');
            this.modalContent = root.querySelector('.file-manager-modal-content');
            this.uploadForm = root.querySelector('.file-manager-upload-form');
            this.fileInput = root.querySelector('.file-manager-file-input');
            this.urlForm = root.querySelector('.file-manager-url-form');
            this.urlInput = root.querySelector('.file-manager-url-input');
            this.folderForm = root.querySelector('.file-manager-folder-form');
            this.folderInput = root.querySelector('.file-manager-folder-input');
            this.upBtn = root.querySelector('.file-manager-up-btn');
            this.errorBox = root.querySelector('.file-manager-error');
            this.list = root.querySelector('.file-manager-list');
            this.cancelBtn = root.querySelector('.file-manager-cancel-btn');
            this.selectBtn = root.querySelector('.file-manager-select-btn');
            this.closeBtn = root.querySelector('.file-manager-close-btn');
            // Preview
            this.previewModal = root.querySelector('.file-manager-preview-modal');
            this.previewContent = root.querySelector('.file-manager-preview-content');
            this.previewName = root.querySelector('.file-manager-preview-name');
            this.previewClose = root.querySelector('.file-manager-preview-close');
            // Rename
            this.renameModal = root.querySelector('.file-manager-rename-modal');
            this.renameForm = root.querySelector('.file-manager-rename-form');
            this.renameInput = root.querySelector('.file-manager-rename-input');
            this.renameTargetSpan = root.querySelector('.file-manager-rename-target');
            this.renameClose = root.querySelector('.file-manager-rename-close');
            // State
            this.renameTarget = null;
            this.previewFile = null;
            // Bind events (with null checks)
            if (this.openBtn) this.openBtn.addEventListener('click', ()=>this.open());
            if (this.closeBtn) this.closeBtn.addEventListener('click', ()=>this.close());
            if (this.cancelBtn) this.cancelBtn.addEventListener('click', ()=>this.close());
            if (this.selectBtn) this.selectBtn.addEventListener('click', ()=>this.selectFiles());
            if (this.upBtn) this.upBtn.addEventListener('click', ()=>this.goUp());
            if (this.uploadForm) this.uploadForm.addEventListener('submit', e=>{e.preventDefault();this.uploadFile();});
            if (this.urlForm) this.urlForm.addEventListener('submit', e=>{e.preventDefault();this.uploadFromUrl();});
            if (this.folderForm) this.folderForm.addEventListener('submit', e=>{e.preventDefault();this.createFolder();});
            if (this.previewClose) this.previewClose.addEventListener('click', ()=>this.hidePreview());
            if (this.renameClose) this.renameClose.addEventListener('click', ()=>this.hideRename());
            if (this.renameForm) this.renameForm.addEventListener('submit', e=>{e.preventDefault();this.doRename();});
            // Modal close on outside click
            if (this.modal) this.modal.addEventListener('click', e=>{if(e.target===this.modal)this.close();});
            if (this.previewModal) this.previewModal.addEventListener('click', e=>{if(e.target===this.previewModal)this.hidePreview();});
            if (this.renameModal) this.renameModal.addEventListener('click', e=>{if(e.target===this.renameModal)this.hideRename();});
            // Keyboard esc
            document.addEventListener('keydown', e=>{
                if(this.modal && this.modal.classList.contains('hidden')) return;
                if(e.key==='Escape') this.close();
            });
            // Init
            this.load();
        }
        showError(msg) {
            this.errorBox.textContent = msg;
            this.errorBox.style.display = msg ? '' : 'none';
        }
        open() {
            this.modal.classList.remove('hidden');
            this.load();
        }
        close() {
            this.modal.classList.add('hidden');
            this.selected = [];
        }
        async load() {
            this.showError('');
            const res = await fetch(`${routeIndex}?dir=${encodeURIComponent(this.currentDir)}`);
            const data = await res.json();
            this.folders = data.folders;
            this.files = data.files.map(f => ({...f, isImage: /\.(jpg|jpeg|png|webp|gif)$/i.test(f.name)}));
            this.selected = [];
            this.renderList();
        }
        renderList() {
            this.list.innerHTML = '';
            // Folders
            this.folders.forEach(folder => {
                const div = document.createElement('div');
                div.className = 'p-4 bg-gradient-to-br from-yellow-400/10 to-gray-800/80 rounded-xl cursor-pointer flex flex-col items-center group file-manager-folder shadow hover:scale-105 hover:ring-2 hover:ring-yellow-400 transition';
                div.innerHTML = `<i class=\"fas fa-folder text-yellow-400 text-4xl mb-3 drop-shadow\"></i><span class=\"text-sm text-yellow-200 font-semibold break-all text-center\">${folder.name}</span><div class=\"mt-3 flex gap-2 opacity-0 group-hover:opacity-100 transition\"><button class=\"text-xs text-blue-400 hover:underline file-manager-rename-folder\">Rename</button><button class=\"text-xs text-red-400 hover:underline file-manager-delete-folder\">Delete</button></div>`;
                div.addEventListener('dblclick', ()=>this.openFolder(folder.path));
                div.querySelector('.file-manager-rename-folder').addEventListener('click', (e) => { e.stopPropagation(); this.rename('folder', folder); });
                div.querySelector('.file-manager-delete-folder').addEventListener('click', (e) => { e.stopPropagation(); this.remove('folder', folder); });
                this.list.appendChild(div);
            });
            // Files
            this.files.forEach(file => {
                const div = document.createElement('div');
                div.className = 'p-4 bg-gradient-to-br from-gray-700/60 to-gray-900/90 rounded-xl flex flex-col items-center group relative file-manager-file shadow hover:scale-105 hover:ring-2 hover:ring-red-400 transition';
                if(this.isSelected(file)) div.classList.add('ring-2','ring-red-500');
                div.innerHTML = `${file.isImage?`<img src=\"${file.url}\" class=\"h-24 w-full object-contain mb-3 rounded shadow-lg border border-gray-800 bg-white\">`:`<i class='fas fa-file text-gray-400 text-4xl mb-3'></i>`}<span class=\"text-sm text-gray-200 font-semibold break-all text-center\">${file.name}</span><div class=\"mt-3 flex gap-2 opacity-0 group-hover:opacity-100 transition\"><button class=\"text-xs text-blue-400 hover:underline file-manager-rename-file\">Rename</button><button class=\"text-xs text-red-400 hover:underline file-manager-delete-file\">Delete</button><button class=\"text-xs text-green-400 hover:underline file-manager-copy-url\">Copy URL</button></div><button class=\"absolute top-2 right-2 text-xs text-gray-400 hover:text-white file-manager-preview-btn\"><i class=\"fas fa-eye\"></i></button>`;
                div.addEventListener('click', ()=>this.toggleSelect(file));
                div.querySelector('.file-manager-rename-file').addEventListener('click', (e) => { e.stopPropagation(); this.rename('file', file); });
                div.querySelector('.file-manager-delete-file').addEventListener('click', (e) => { e.stopPropagation(); this.remove('file', file); });
                div.querySelector('.file-manager-copy-url').addEventListener('click', (e) => { e.stopPropagation(); this.copyUrl(file.url); });
                div.querySelector('.file-manager-preview-btn').addEventListener('click', (e) => { e.stopPropagation(); this.preview(file); });
                this.list.appendChild(div);
            });
        }
        async uploadFile() {
            this.showError('');
            const files = this.fileInput.files;
            if (!files.length) return this.showError('No file selected.');
            for (let i = 0; i < files.length; i++) {
                const form = new FormData();
                form.append('file', files[i]);
                form.append('dir', this.currentDir);
                const res = await fetch(routeUpload, {method:'POST', body:form, headers:{'X-CSRF-TOKEN':csrf}});
                const data = await res.json();
                if (data.error) { this.showError(data.error); return; }
            }
            this.load();
        }
        async uploadFromUrl() {
            this.showError('');
            const url = this.urlInput.value;
            if (!url) return this.showError('Enter a URL.');
            const res = await fetch(routeUploadUrl, {method:'POST', body:JSON.stringify({url:url, dir:this.currentDir}), headers:{'Content-Type':'application/json','X-CSRF-TOKEN':csrf}});
            const data = await res.json();
            if (data.error) return this.showError(data.error);
            this.urlInput.value = '';
            this.load();
        }
        async createFolder() {
            this.showError('');
            const name = this.folderInput.value;
            if (!name) return this.showError('Enter folder name.');
            const res = await fetch(routeCreateFolder, {method:'POST', body:JSON.stringify({name:name, dir:this.currentDir}), headers:{'Content-Type':'application/json','X-CSRF-TOKEN':csrf}});
            const data = await res.json();
            if (data.error) return this.showError(data.error);
            this.folderInput.value = '';
            this.load();
        }
        goUp() {
            if (this.currentDir === '/' || this.currentDir === '') return;
            this.currentDir = this.currentDir.replace(/\/?[^\/]+\/?$/, '') || '/';
            this.load();
        }
        openFolder(path) {
            this.currentDir = path;
            this.load();
        }
        preview(file) {
            this.previewFile = file;
            this.previewModal.classList.remove('hidden');
            this.previewContent.innerHTML = file.isImage ? `<img src="${file.url}" class="w-full rounded shadow mb-2">` : `<div class="text-white">Preview not available. <a href="${file.url}" target="_blank" class="underline">Download</a></div>`;
            this.previewName.textContent = file.name;
        }
        hidePreview() {
            this.previewModal.classList.add('hidden');
            this.previewFile = null;
        }
        copyUrl(url) {
            navigator.clipboard.writeText(url);
            alert('URL copied!');
        }
        rename(type, target) {
            this.renameTarget = {...target, type};
            this.renameInput.value = target.name;
            this.renameTargetSpan.textContent = target.name;
            this.renameModal.classList.remove('hidden');
        }
        hideRename() {
            this.renameModal.classList.add('hidden');
            this.renameTarget = null;
        }
        async doRename() {
            if (!this.renameInput.value) return;
            const res = await fetch(routeRename, {method:'POST', body:JSON.stringify({type:this.renameTarget.type, path:this.renameTarget.path, name:this.renameInput.value, dir:this.currentDir}), headers:{'Content-Type':'application/json','X-CSRF-TOKEN':csrf}});
            const data = await res.json();
            if (data.error) { this.showError(data.error); return; }
            this.hideRename();
            this.load();
        }
        async remove(type, target) {
            if (!confirm('Are you sure?')) return;
            const res = await fetch(routeDelete, {method:'POST', body:JSON.stringify({type, path:target.path, dir:this.currentDir}), headers:{'Content-Type':'application/json','X-CSRF-TOKEN':csrf}});
            const data = await res.json();
            if (data.error) { this.showError(data.error); return; }
            this.load();
        }
        toggleSelect(file) {
            if (!this.allowMulti) {
                this.selected = [file];
            } else {
                const idx = this.selected.findIndex(f => f.path === file.path);
                if (idx > -1) this.selected.splice(idx, 1);
                else this.selected.push(file);
            }
            this.renderList();
        }
        isSelected(file) {
            return this.selected.find(f => f.path === file.path);
        }
        selectFiles() {
            if (this.onSelect && typeof this.onSelect === 'function') {
                this.onSelect(this.selected.length ? this.selected : []);
            }
            this.close();
        }
    }
    // Auto-init all file manager components
    document.addEventListener('DOMContentLoaded', function(){
        document.querySelectorAll('.file-manager-component').forEach(el=>{
            el._fileManager = new FileManager(el);
        });
    });
    // Expose for manual trigger: window.FileManager.open(selector)
    window.FileManager = {
        open: function(selector) {
            const el = typeof selector==='string' ? document.querySelector(selector) : selector;
            if(el && el._fileManager) el._fileManager.open();
        }
    };
    // Theme toggle logic
    function setFileManagerTheme_{{ $uniqueId }}(mode) {
        const root = document.getElementById('file-manager-modal-root-{{ $uniqueId }}');
        const darkIcon = document.getElementById('file-manager-theme-dark-icon-{{ $uniqueId }}');
        const lightIcon = document.getElementById('file-manager-theme-light-icon-{{ $uniqueId }}');
        if (!root || !darkIcon || !lightIcon) return;
        if (mode === 'light') {
            root.classList.remove('dark');
            root.classList.add('light');
            localStorage.setItem('fileManagerTheme', 'light');
            darkIcon.classList.remove('hidden'); // Show moon (switch to dark)
            lightIcon.classList.add('hidden');   // Hide sun
        } else {
            root.classList.remove('light');
            root.classList.add('dark');
            localStorage.setItem('fileManagerTheme', 'dark');
            darkIcon.classList.add('hidden');    // Hide moon
            lightIcon.classList.remove('hidden'); // Show sun (switch to light)
        }
    }
    document.addEventListener('DOMContentLoaded', function(){
        // Theme toggle button
        const themeToggle = document.getElementById('file-manager-theme-toggle-{{ $uniqueId }}');
        if (themeToggle) {
            // Set initial theme
            const saved = localStorage.getItem('fileManagerTheme');
            setFileManagerTheme_{{ $uniqueId }}(saved === 'light' ? 'light' : 'dark');
            themeToggle.addEventListener('click', function() {
                const root = document.getElementById('file-manager-modal-root-{{ $uniqueId }}');
                if (root.classList.contains('light')) setFileManagerTheme_{{ $uniqueId }}('dark');
                else setFileManagerTheme_{{ $uniqueId }}('light');
            });
        }
    });
})();
