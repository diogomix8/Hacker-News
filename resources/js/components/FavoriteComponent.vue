<template>
  <div>
    <div v-for="item in favorites" v-bind:key="item.id">
      <div v-if="item.is_favorite == 1">
        <div class="card border-dark">
          <div class="card-body text-dark">
            <div class="card-header">
              <span>New</span>
            </div>
            <h3 class="card-title">
              <strong>{{ item.title }}</strong>
            </h3>
            <a href="{ item.url }" target="_blank">{{ item.url }}</a>
          </div>
          <div class="card-footer">
            <button
              type="button"
              @click="deleteFavorite(item.title)"
              class="btn btn-danger"
            >
              Ya no me gusta
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    favorites: {
      type: Object,
    },
  },
  data() {
    return {};
  },
  methods: {
    deleteFavorite(item) {
      axios
        .get("/favorites/delete", {
          params: {
            title: item,
          },
        })
        .then(function (response) {
          console.log(response);
        })
        .catch(function (error) {
          console.log(error);
        })
        .then(function () {});
    },
    getFavorites() {
      axios
        .get("/favorites")
        .then(function (response) {
          // handle success
          console.log(response);
        })
        .catch(function (error) {
          // handle error
          console.log(error);
        })
        .then(function () {
          // always executed
        });
    },
  },
};
</script>