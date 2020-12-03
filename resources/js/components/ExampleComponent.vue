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
          <button class="btn btn-warning">Favorito</button>
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
    };
  },
  computed: {},
  watch: {
    arrayNewsLastest() {
      var news = {
        title: "",
        url: "",
      };
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
    deMenorAMayor(elem1, elem2) {return elem1-elem2;},
    getNewsLastest() {
      axios
        .get(
          "https://hacker-news.firebaseio.com/v0/showstories.json?print=pretty"
        )
        .then((response) => {
          this.arrayNewsLastest = response.data;
          console.log(this.arrayNewsLastest.sort(this.deMenorAMayor));
          var rev = this.arrayNewsLastest.sort(this.deMenorAMayor);
          console.log('revers'+rev);
          this.arrayNewsLastest.reverse();
          this.arrayNewsLastest.splice(9,this.arrayNewsLastest.length-10);
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
