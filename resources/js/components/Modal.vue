<template>
  <!-- Modal -->
  <div class="modal modal-active">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">{{ title }}</h5>
          <button type="button" class="close" @click="$emit('close')">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <slot></slot>
        </div>
        <!-- <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">
            Close
          </button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div> -->
      </div>
    </div>
  </div>
</template>
<style>
.modal-active {
  background-color: rgba(0, 0, 0, 0.5);
  display: block;
}
</style>
<script>
export default {
  props: ["id", "title", "body"],
  data() {
    return {
      showRoomModal: false
    };
  }
};
</script>
