<script setup>
    import docsearch from '@docsearch/js';

    import '@docsearch/css';

    docsearch({
    container: '#docsearch',
    appId: 'JZ1I2ATO6A',
    indexName: 'nxu-tzgg-search',
    apiKey: '954996764c75fe9c9a57b759763e10b4',
    });
</script>

<template>
    <div id="docsearch"></div>
</template>

<style>
    #docsearch {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
    }
    @media screen and (min-width: 768px) {
        #docsearch > button {
            width: 500px;
            height: 50px;
            font-size: 1.5em;
            padding: 0 1em;
        }

        #docsearch .DocSearch-Button-Placeholder {
            margin-left: 0.5em;
        }
    }
</style>