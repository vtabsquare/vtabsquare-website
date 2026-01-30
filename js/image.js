"use strict";
let configs, gform;
class Jitems {
    static get(key) {
        if (!this.caches[key]) {
            this.caches[key] = Array.from(configs.context.querySelectorAll("[data-jitem='" + key + "']"));
        }
        return this.caches[key][0];
    }
    static getAll(key) {
        if (!this.caches[key]) {
            this.caches[key] = Array.from(configs.context.querySelectorAll("[data-jitem='" + key + "']"));
        }
        return this.caches[key];
    }
    static init() {
        this.caches = Object.create(null);
    }
}
class Confirm {
    static handler(e) {
        const elm = e.target;
        let action = "", callback;
        if (elm.tagName === "BUTTON") {
            action = elm.getAttribute("data-action") || "";
        }
        switch (action) {
            case "confirm":
                callback = this.callback;
                this.hide();
                this.callback = null;
                if (callback) {
                    callback();
                }
                break;
            case "cancel":
                this.hide();
                this.callback = null;
                break;
        }
    }
    static hide() {
        Jitems.get("confirm").classList.add("d-none");
    }
    static add(callback) {
        this.callback = callback;
    }
    static init() {
        Jitems.get("confirm").addEventListener("click", (e) => this.handler(e));
    }
    static show(msg) {
        if (Jitems.get("confirm-msg").textContent !== msg) {
            Jitems.get("confirm-msg").textContent = msg;
        }
        Jitems.get("confirm").classList.remove("d-none");
        Jitems.get("confirm").scrollIntoView({
            behavior: "smooth",
            block: "end"
        });
    }
}
class PaginationFrg {
    static getBtnFrg() {
        const btnFrg = document.createElement("button");
        btnFrg.setAttribute("type", "button");
        btnFrg.setAttribute("class", "page-link");
        return btnFrg;
    }
    static getItemFrg(page, isActive) {
        const listFrg = this.listElm.cloneNode(true), btnFrg = this.btnElm.cloneNode(true);
        btnFrg.textContent = String(page);
        listFrg.appendChild(btnFrg);
        if (isActive) {
            listFrg.classList.add("active");
        }
        return listFrg;
    }
    static getListFrg() {
        const listFrg = document.createElement("li");
        listFrg.setAttribute("class", "page-item mb-2");
        return listFrg;
    }
    static get(totalPage, currentPage) {
        const frg = document.createDocumentFragment(), sideLinksCount = 2, totalLinks = sideLinksCount * 2;
        let paginationStart = 1, paginationEnd;
        if (currentPage > sideLinksCount) {
            paginationStart = currentPage - sideLinksCount;
        }
        paginationEnd = paginationStart + totalLinks;
        if (paginationEnd > totalPage) {
            paginationStart -= paginationEnd - totalPage;
            if (paginationStart < 1) {
                paginationStart = 1;
            }
            paginationEnd = totalPage;
        }
        if (currentPage > 2) {
            frg.appendChild(this.getItemFrg("Start", false));
        }
        if (currentPage > 1) {
            frg.appendChild(this.getItemFrg("Previous", false));
        }
        paginationStart -= 1;
        while (++paginationStart <= paginationEnd) {
            frg.appendChild(this.getItemFrg(paginationStart, paginationStart === currentPage));
        }
        if (currentPage < totalPage) {
            frg.appendChild(this.getItemFrg("Next", false));
        }
        if (totalPage > totalLinks + 1 && currentPage + 1 < totalPage) {
            frg.appendChild(this.getItemFrg("End", false));
        }
        return frg;
    }
    static init() {
        this.btnElm = this.getBtnFrg();
        this.listElm = this.getListFrg();
    }
}
class Pagination {
    static getPage(page) {
        let currentPage;
        switch (page) {
            case "Start":
                currentPage = 1;
                break;
            case "Previous":
                currentPage = configs.currentPage - 1;
                break;
            case "Next":
                currentPage = configs.currentPage + 1;
                break;
            case "End":
                currentPage = configs.totalPage;
                break;
            default:
                currentPage = Number(page);
        }
        if (!currentPage || currentPage < 1) {
            currentPage = 1;
        }
        if (currentPage > configs.totalPage) {
            currentPage = configs.totalPage;
        }
        return currentPage;
    }
    static handler(e) {
        const elm = e.target;
        if (configs.lock || elm.tagName !== "BUTTON") {
            return;
        }
        configs.currentPage = this.getPage(elm.textContent || "");
        Items.get();
    }
    static build() {
        for (const elm of Array.from(Jitems.get("pagination").children)) {
            elm.remove();
        }
        if (configs.totalPage > 1) {
            Jitems.get("pagination").appendChild(PaginationFrg.get(configs.totalPage, configs.currentPage));
        }
        Jitems.get("footer").classList.remove("d-none");
    }
    static get() {
        configs.lock = true;
        gform
            .request("get", configs.url + "/total", true)
            .data(Items.getInputs())
            .on("progress", gform.progress)
            .send()
            .then((response) => {
            const { errors, data } = response;
            configs.lock = false;
            if (errors) {
                gform.error(errors, configs.context);
                return;
            }
            if (!data || !("total" in data)) {
                return;
            }
            configs.totalItems = Number(data.total);
            Jitems.get("total").textContent = String(configs.totalItems);
            configs.totalPage = Math.ceil(configs.totalItems / configs.listCount);
            this.build();
        });
    }
    static init() {
        PaginationFrg.init();
        Jitems.get("pagination").addEventListener("click", (e) => this.handler(e));
    }
}
class Items {
    static onLoad() {
        const elmsList = ["loading", "noitems", "items", "footer"];
        for (const e of elmsList) {
            Jitems.get(e).classList.add("d-none");
        }
    }
    static onSuccess(content) {
        if (!content) {
            Jitems.get("noitems").classList.remove("d-none");
            return;
        }
        Jitems.get("items").innerHTML = content;
        Jitems.get("items").classList.remove("d-none");
        if (configs.totalPage) {
            Pagination.build();
        }
        else {
            Pagination.get();
        }
    }
    static get() {
        configs.lock = true;
        gform
            .request("get", configs.url, true)
            .data(this.getInputs())
            .on("progress", gform.progress)
            .send()
            .then((response) => {
            const { errors, data } = response;
            configs.lock = false;
            this.onLoad();
            if (errors) {
                gform.error(errors, configs.context);
                return;
            }
            let content = "";
            if (data && "content" in data && typeof data.content === "string") {
                content = data.content;
            }
            this.onSuccess(content);
        });
    }
    static getInputs() {
        const uinputs = {
            count: configs.listCount,
            page: configs.currentPage
        };
        return uinputs;
    }
}
class ListCount {
    static handler() {
        const listCountElm = Jitems.get("listcount");
        if (configs.lock) {
            listCountElm.value = String(configs.listCount);
            return;
        }
        configs.listCount = Number(listCountElm.value);
        configs.currentPage = 1;
        configs.totalPage = Math.ceil(configs.totalItems / configs.listCount);
        Items.get();
    }
    static init() {
        Jitems.get("listcount").addEventListener("change", () => this.handler());
    }
}
class InsertImage {
    static getImageUrl(elm) {
        const itemElm = elm.closest(".browse-image"), imageElm = itemElm.querySelector("img");
        return imageElm.src;
    }
    static insert(elm) {
        configs.postMessage("insertimage", { url: this.getImageUrl(elm) });
        configs.postMessage("hidebrowseimagemodal");
    }
}
class DeleteImage {
    static deleteImage(elm) {
        const itemElm = elm.closest(".browse-image"), imageSrc = this.getImageUrl(itemElm);
        configs.lock = true;
        itemElm.remove();
        gform
            .request("delete", configs.url + "/" + imageSrc)
            .on("progress", gform.progress)
            .send()
            .then((response) => {
            const { errors } = response;
            configs.lock = false;
            if (errors) {
                gform.error(errors, configs.context);
                return;
            }
            this.updatePagination();
            Items.get();
        });
    }
    static getImageUrl(itemElm) {
        const imageElm = itemElm.querySelector("img");
        return imageElm.src.split("/").pop() || "";
    }
    static updatePagination() {
        configs.totalItems -= 1;
        configs.totalPage = Math.ceil(configs.totalItems / configs.listCount);
        if (configs.currentPage > 1 && configs.currentPage > configs.totalPage) {
            configs.currentPage -= 1;
        }
    }
    static delete(elm) {
        Confirm.add(() => this.deleteImage(elm));
        Confirm.show("Confirm delete");
    }
}
class UploadImage {
    static uploadImage(file) {
        return new Promise((callback) => {
            gform
                .request("post", configs.url)
                .data({ image: file })
                .on("progress", gform.progress)
                .upload(true)
                .send()
                .then((response) => {
                const { errors, data } = response;
                if (errors) {
                    configs.postMessage("showerrors", { errors });
                    return;
                }
                let url = "";
                if (data && "url" in data && typeof data.url === "string") {
                    url = data.url;
                }
                callback(url);
            });
        });
    }
    static async upload(files, size, types) {
        for (const file of files) {
            const config = {
                error: (e) => configs.postMessage("showerrors", { errors: e }),
                file,
                size,
                types
            };
            if (!gform.isValidFile(config)) {
                return;
            }
        }
        for (const file of files) {
            const url = await this.uploadImage(file);
            configs.postMessage("insertimage", { url });
        }
        Items.get();
    }
}
class BrowseImage {
    static handler(e) {
        const elm = e.target;
        if (configs.lock || elm.tagName !== "BUTTON") {
            return;
        }
        switch (elm.getAttribute("data-action")) {
            case "insert":
                InsertImage.insert(elm);
                break;
            case "delete":
                DeleteImage.delete(elm);
                break;
        }
    }
    static init() {
        Jitems.get("items").addEventListener("click", (e) => this.handler(e));
    }
}
class BrowseImageBtn {
    static getBtnFrg() {
        const btnFrg = document.createElement("button");
        btnFrg.setAttribute("type", "button");
        btnFrg.setAttribute("class", "btn btn-primary");
        btnFrg.textContent = "Browse image";
        return btnFrg;
    }
    static handler() {
        configs.postMessage("hideinsertimagemodal");
        configs.postMessage("showbrowseimagemodal");
        Items.get();
    }
    static init() {
        this.btnElm = this.getBtnFrg();
        this.btnElm.addEventListener("click", () => this.handler());
        configs.postMessage("addbrowseimagebutton", { elm: this.btnElm });
    }
}
class Configs {
    static init() {
        configs = {
            context: document.body,
            listCount: 5,
            url: "",
            currentPage: 1,
            lock: false,
            totalItems: 0,
            totalPage: 0,
            postMessage() { }
        };
    }
    static normalize() {
        if (configs.url.substr(-1) === "/") {
            configs.url = configs.url.substr(0, configs.url.length - 1);
        }
    }
}
class ImageManager {
    init(uconfigs) {
        if (Configs.initialized) {
            return;
        }
        gform = new GForm();
        Configs.initialized = true;
        Configs.init();
        if (uconfigs) {
            Object.assign(configs, uconfigs);
        }
        Configs.normalize();
        Jitems.init();
        Confirm.init();
        Pagination.init();
        ListCount.init();
        BrowseImageBtn.init();
        BrowseImage.init();
        Jitems.get("listcount").value = String(configs.listCount);
    }
    upload(files, size, types) {
        UploadImage.upload(files, size, types);
    }
}
function gimage() {
    return new ImageManager();
}
function init() {
    window.GImage = gimage;
}
init();
