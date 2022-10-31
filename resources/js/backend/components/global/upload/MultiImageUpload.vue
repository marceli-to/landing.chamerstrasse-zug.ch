<template>
  <div>
    <div class="form-row">
      <label for="document">{{labelNew}}</label>
      <vue-dropzone
        ref="dropzone"
        id="dropzone"
        :options="dropzoneConfig"
        @vdropzone-complete="afterUpload"
      ></vue-dropzone>
      <span class="bubble is-restriction">{{labelRestrictions}}</span>
    </div>
    <div class="form-row" v-if="assets.length">
      <label>{{labelExisting}}</label>
      <div :class="[sortable ? 'has-sortable-images' : 'has-images', 'dropzone-existing-assets']">
        <div>
          <!-- <draggable 
            :disabled="true"
            @end="updateOrder"
            ghost-class="draggable-ghost"
            tag="div">        -->
            <figure
              :class="[asset.publish == 0 ? 'is-disabled' : '', 'dz-existing-asset is-image']"
              v-for="asset in assets"
              :key="asset.id"
            >
              <a :href="imageUri('large', asset.name)" target="_blank" class="dz-file-preview">
                <img :src="imageUri('thumbnail', asset.name)" height="300" width="300">
                <div class="dz-file-preview__caption" v-if="asset.caption">{{ asset.caption | truncate(20, '...') }}</div>
              </a>
              <div class="dz-toolbar">
                <a
                  href="javascript:;"
                  :class="[asset.publish == 1 ? 'icon-eye' : 'icon-eye-off', 'icon-mini']"
                  @click.prevent="toggle(asset,$event)">
                </a>
                <a
                  href="javascript:;"
                  class="icon-edit icon-mini"
                  @click.prevent="showForm($event)"
                ></a>
                <a 
                  :href="imageUri('large', asset.name)" 
                  target="_blank" 
                  class="icon-external-link icon-mini">
                </a>
                <a
                  href="javascript:;"
                  class="icon-trash icon-mini"
                  @click.prevent="deleteUpload(asset.name,$event)">
                </a>
                <a href @click.prevent="showCropper(asset.name)">Crop</a>
              </div>
              <div class="overlay-asset">
                <div>
                  <div class="overlay-grid">
                    <div>
                      <img :src="imageUri('large', asset.name)" height="300" width="300">
                      <figcaption>{{asset.caption}}</figcaption>
                    </div>
                    <div>
                      <div class="form-row">
                        <label>Name:</label>
                        <div>{{asset.name}}</div>
                      </div>
                      <div class="form-row">
                        <label>Caption:</label>
                        <input type="text" v-model="asset.caption" class="is-caption">
                      </div>
                      <div class="form-row-button">
                        <a
                          href="javascript:;"
                          class="btn-secondary"
                          @click.prevent="hideForm($event)"
                        >Save</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div :class="[hasCropper ? 'is-visible': '', 'overlay-crop']">
                <a href="javascript:;"
                    @click.prevent="hideCropper()"
                    class="icon-close-overlay">
                </a>
                <div>
                  <span class="cropper-info">Neue Grösse:<br>{{ cropW }}px x {{ cropH }}px</span>
                  <div v-if="loader">Loading image...</div>
                  <cropper
                    :src="cropImg"
                    :stencilProps="{
                      aspectRatio: 4/3,
                      linesClassnames: {
                        default: 'line',
                      },
                      handlersClassnames: {
                        default: 'handler'
                      }
                    }"
                    @change="change"
                  ></cropper>
                  <div class="form-buttons">
                    <a href="javascript:;" class="btn-secondary" @click.prevent="crop($event)">Speichern</a>
                    <a href @click.prevent="hideCropper()">Abbrechen</a>
                  </div>
                </div>
              </div>
            </figure>
          <!-- </draggable>  -->
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import vue2Dropzone from "vue2-dropzone";
import draggable from 'vuedraggable';
import dropzoneConfig from "@/config/dropzoneconfig.js";
import { Cropper } from "vue-advanced-cropper";

export default {

  components: {
    vueDropzone: vue2Dropzone,
    draggable: draggable,
    Cropper
  },

  props: {
    labelNew: String,
    labelExisting: String,
    labelRestrictions: String,
    assets: Array,
    assetType: String,
    acceptedFiles: String,
    maxFiles: Number,
    maxFilesize: Number,
    uploadUrl: String,
    hasUrl: Boolean,
    sortable: Boolean,
  },

  data() {
    return {
      coords: {},
      cropW: null,
      cropH: null,
      cropImg: null,
      hasCropper: false,
      loader: false,
      
      dropzoneConfig: dropzoneConfig,
      css_classes: {
        visible: 'is-visible'
      }
    };
  },

  created() {
    this.dropzoneConfig.url = this.uploadUrl;
    this.dropzoneConfig.acceptedFiles = this.acceptedFiles;
    this.dropzoneConfig.maxFiles = this.maxFiles;
    this.dropzoneConfig.maxFilesize = this.maxFilesize;
  },

  methods: {

    change({ coordinates, canvas }) {
      this.coords.h = coordinates.height;
      this.coords.w = coordinates.width;
      this.coords.y = coordinates.top;
      this.coords.x = coordinates.left;

      this.cropW = Math.floor(coordinates.width);
      this.cropH = Math.floor(coordinates.height);
    },

    afterUpload(asset) {
      this.$refs.dropzone.removeFile(asset);
      this.$parent.afterUpload(asset);
    },

    deleteUpload(asset,event) {
      this.$parent.deleteUpload(asset,event);
    },

    toggle(asset,event) {
      this.$parent.toggleAsset(asset,event);
    },
    
    showForm(e) {
      let editForm = e.target.parentNode.nextElementSibling;
      editForm.classList.toggle(this.css_classes.visible);
    },

    hideForm(e) {
      let editForm= e.target.parentNode.parentNode.parentNode.parentNode.parentNode;
      editForm.classList.remove(this.css_classes.visible);
    },

    updateOrder() {
      let assets = this.assets.map(function(asset, index) {
          asset.order = index;
          return asset;
      });

      console.log(assets);
      return;

      // if (this.debounce) return;

      // this.debounce = setTimeout(function(categories) {
      //   this.debounce = false 
      //   let uri = `/api/category/order`;
      //   this.axios.post(uri, {categories: categories}).then((response) => {
      //     this.$router.push({name: 'categories'});
      //   });
      // }.bind(this, categories), 1000);
      // this.$notify({type: 'success', text: 'Reihenfolge angepasst'});
    },

    imageUri(size = 'small', asset) {
      return `/images/${size}/${asset}`;
    },

    showCropper(img) {
      this.loader = true;
      this.hasCropper = true;

      this.axios.get(this.imageUri('original', img)).then(response => {
        this.cropImg = this.imageUri('original', img);
        this.loader = false;
      });
      
    },

    hideCropper() {
      this.hasCropper = false;
      this.cropImg = null;  
    },

  }
};
</script>
<style>
.cropper {
  max-height: 700px;
  background: transparent;
  padding-top: 80px;
}
.cropper-info {
  display: block; 
  margin-bottom: 10px; 
  text-align: left;
}
.line {
	border-style: dashed;
	border-color: #5cb85c;
}
.handler {
  background-color: #5cb85c;
}
.vue-advanced-cropper__image {
  opacity: 0.5 !important;
}
</style>
