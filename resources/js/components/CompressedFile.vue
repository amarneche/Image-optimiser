<template>

    <tr>
        <td>{{ name}} </td>
        <td> {{oldSizeFormatted}}</td>
        <td>{{newSizeFormatted}}</td>
        <td>{{ saving }}</td>

        <td>
            <div v-if="isCompressed" > 
                <button class="btn btn-danger" @click="download" >
                    Download 
                </button>
            </div>
            <div v-else >
               <div class="progress">
                <div class="progress-bar progress-bar-striped bg-danger " role="progressbar" :style="{width: progress + '%' }"  aria-valuemin="0" aria-valuemax="100">
                     {{progress}} % 
                </div>
                </div>
            </div>

        </td>
    </tr>


</template>



<script>

export default {
    mounted(){
        this.submit();
        this.oldSize=this.file.size;
        this.name=this.file.name;
    },
    data(){

        return {
            isCompressed:false,
            progress:0,
            exension: null,
            hashName: null,
            name: null,
            newSize: null,
            oldSize: null,
        }
    },
    computed :{
        saving(){
            if(this.newSize & this.oldSize){
                return Math.floor( this.newSize / this.oldSize *100 ) + '%';
            }
        },
        oldSizeFormatted(){
            if(this.oldSize)
                return this.convertToHumans(this.oldSize);
        },
        newSizeFormatted(){
            if(this.newSize)
                return this.convertToHumans(this.newSize);
        },
        savingFormatted(){
            if(this.newSize && this.oldSize){
                if(this.oldSize > this.newSize){
                    return this.convertToHumans( this.oldSize-this.newSize );
                }
            }
        }



    }
    ,
    props :['file','quality','format' ],
    methods: {
        convertToHumans(size){
            let units=['B','KB','MB','GB'];
            let exponent= this.getBaseLog(size,1024);
            console.log(exponent);
            console.log(size);
            
            return Math.fround(size/Math.pow(1024,exponent)).toFixed(2) + " " + units[exponent] ;

        },
        getBaseLog(x,y){
            return Math.floor(Math.log(x)/Math.log(y));
        }
        ,
        submit(){
           
            if(this.format && this.quality){

                let fd= new FormData;
                fd.append("files[0]", this.file);
                fd.append("format", this.format);
                fd.append("quality", this.quality);

                axios.post("/api/compress/", fd ,{
                    onUploadProgress: progressEvent=>  this.progress =Math.round((progressEvent.loaded * 100) / progressEvent.total)
                } )
                .then( (res)=>{
                    this.isCompressed=true;
                    this.name= res.data.response[0].name;
                    this.exension= res.data.response[0].exension;
                    this.hashName= res.data.response[0].hashName;
                    this.newSize= res.data.response[0].newSize;
                    
                    console.log(res);
                } )
                .catch((err)=>{

                } )


            }
            return false;
        },
        download(){
            axios.get(`/storage/${this.hashName}`, {responseType: 'blob'} )
            .then((res)=>{
               console.log(res);
               let url = window.URL.createObjectURL( new Blob([res.data]));
               let link = document.createElement('a');
               link.href=url;
               link.setAttribute("download",this.name);
               link.click();
            } )
            .catch((err)=>{
                console.log(err);
            });
        }
    }
   

}
</script>