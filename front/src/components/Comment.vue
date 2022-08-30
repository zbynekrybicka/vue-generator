<template>
  <div class="card mt-3 col-12 col-sm-6 offset-sm-3">
    <div class="card-body">
        <!--img :src="profile" class="rounded-circle float-start me-3"-->
        <a href="#" @click.prevent=""><b>{{ comment.author }}</b></a><br>
        {{ comment.created }}
    </div>
    <div class="card-body">
      <p class="card-text" v-html="comment.content.replace('\n','<br />')" />
    </div>
    <Video :video="comment.video" v-if="comment.video" />
    <Image :image="comment.image" v-if="comment.image" />
    <Youtube :video="comment.youtube" v-if="comment.youtube" />
  
    <Likes :likes="comment.likes" :commentId="comment.id" />
  </div>
</template>

<script>
import Video from "./Video.vue"
import Image from "./Image.vue"
import Youtube from "./Youtube.vue"
import Likes from "./Likes.vue"

export default {
	components: { Video, Image, Youtube, Likes,  },
	props: [ "comment", ],
	emits: [  ],
	data() {
		return {
		}
	},
	methods: {
	},
	computed: {
	},
	watch: {
	},
}

</script>