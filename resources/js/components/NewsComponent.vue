<template>
  <div>
    <div v-for="item in arrayNews" v-bind:key="item.id">
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
              @click="newFavorite(item)"
              class="btn btn-warning"
            >
              Favorito
            </button>

        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      arrayNewsLastest: [],
      arrayNews: [],
      loading: true,
      errored: false,
      news:{
        title: "",
        url: "",
        isFavorite:""
      }
    };
  },
  computed: {},
  watch: {
    arrayNewsLastest() {
      this.arrayNewsLastest.forEach((element) => {
        axios
          .get(
            "https://hacker-news.firebaseio.com/v0/item/" +
              element +
              ".json?print=pretty"
          )
          .then((response) => {
            this.arrayNews.push(response.data);
          });
      });
    },
  },
  methods: {
    deMayorAMenor(elem1, elem2) {
      return elem2 - elem1;
    },
    newFavorite(item) {
      axios
        .post("/favorites/new", {
          title: item.title,
          url: item.url,
        })
        .then(function (response) {
          console.log(response);
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    getNewsLastest() {
      axios
        .get(
          "https://hacker-news.firebaseio.com/v0/showstories.json?print=pretty"
        )
        .then((response) => {
          this.arrayNewsLastest = response.data;
          console.log(this.arrayNewsLastest.sort(this.deMayorAMenor));
          var rev = this.arrayNewsLastest.sort(this.deMayorAMenor);
          this.arrayNewsLastest.reverse();
          this.arrayNewsLastest.splice(9, this.arrayNewsLastest.length - 10);
        })
        .catch((error) => {
          console.log(error);
          this.errored = true;
        })
        .finally(() => (this.loading = false));
    },
  },
  mounted() {
    this.getNewsLastest();
  },
};
</script>
